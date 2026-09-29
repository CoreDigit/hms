<?php

namespace App\Http\Controllers\Cruds;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\PasswordRequest;
use App\Http\Requests\Cruds\DoctorRequest;
use App\Models\Cruds\Department;
use App\Models\Users\Doctor;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class DoctorController extends Controller
{
    use ImageUploadTrait;

    public function index(Request $request)
    {
        if (auth()->guard('patient')->check()) {
            $patient = $request->user();
            $doctors = $patient->doctors;
        } else {
            $doctors = Doctor::orderBy('updated_at', 'desc')->get();
        }
        return view('cruds.doctors.index', compact('doctors'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('cruds.doctors.create', compact('departments'));
    }

    public function store(DoctorRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        try {
            DB::beginTransaction();
            $doctor = Doctor::create($data);

            if (isset($data['image'])) {
                $username = strtok($doctor->email, '@') . '.' . $data['image']->getClientOriginalExtension();
                $this->addImage($data['image'], $doctor, 'doctors', $username);
            }

            DB::commit();
            return redirect()->route('doctors.index')->with('created', __('validation.created'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('create_error', __('validation.create_error'));
        }
    }

    public function show(Request $request, Doctor $doctor)
    {
        if (auth()->guard('doctor')->check()) {
            $doctor = $request->user();
        }

        $departments = Department::all();
        return view('cruds.doctors.show', compact('doctor', 'departments'));
    }

    public function edit(Doctor $doctor)
    {
        $departments = Department::all();
        return view('cruds.doctors.edit', compact('doctor', 'departments'));
    }

    public function update(DoctorRequest $request, Doctor $doctor)
    {
        if (auth()->guard('doctor')->check()) {
            $doctor = $request->user();
        }

        $data = $request->validated();
        try {
            DB::beginTransaction();
            $doctor->update($data);

            if ($request->has('remove_image')) {
                if ($doctor->image->path !== 'default/doctor.png') {
                    $this->deleteImage($doctor->image);
                }
            } else if ($request->has('image')) {
                if ($doctor->image->path !== 'default/doctor.png') {
                    $this->deleteImage($doctor->image);
                }
                $username = strtok($doctor->email, '@') . '.' . $data['image']->getClientOriginalExtension();
                $this->addImage($data['image'], $doctor, 'doctors', $username);
            }

            DB::commit();
            return redirect()->route(auth()->guard('doctor')->check() ? 'doctor.show' : 'doctors.index')->with('updated', __('validation.updated'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('update_error', __('validation.update_error'));
        }
    }

    public function destroy(Request $request, Doctor $doctor)
    {
        $request->validate([
            'last_password' => ['required'],
        ]);
        if (auth()->guard('doctor')->check()) {
            $request->validate([
                'last_password' => ['current_password'],
            ]);
            $doctor = $request->user();
            Auth::logout();
            $doctor->delete();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return Redirect::to('/');
        }
        if (Hash::check($request->last_password, auth()->user()->password)) {
            $doctor->delete();
            return redirect()->route('doctors.index')->with('deleted', __('validation.deleted'));
        }
        return redirect()->back()->with('password_error', __('validation.password_error'));
    }

    ################################################################

    public function updatePassword(PasswordRequest $request, Doctor $doctor)
    {
        if (auth()->guard('doctor')->check()) {
            $doctor = $request->user();
        }

        $data = $request->validated();
        if (Hash::check($data['current_password'], $doctor->password)) {
            $doctor->update(['password' => Hash::make($data['password'])]);
            return auth()->guard('doctor')->check() ?
                redirect()->route('doctor.show')->with('password', __('validation.password_updated')) :
                redirect()->route('doctors.show', $doctor->id)->with('password', __('validation.password_updated'));
        }
        return redirect()->back()->with('password_error', __('validation.password_error'));
    }

    public function activate(Doctor $doctor)
    {
        try {
            $doctor->update(['status' => true]);
            return redirect()->route('doctors.index')->with('activated', __('validation.activated'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('active_error', __('validation.active_error'));
        }
    }

    public function inactivate(Doctor $doctor)
    {
        try {
            $doctor->update(['status' => false]);
            return redirect()->route('doctors.index')->with('inactivated', __('validation.inactivated'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('inactive_error', __('validation.inactive_error'));
        }
    }

    ################################### Web #######################################

    public function webIndex()
    {
        $doctors = Doctor::paginate(8);
        return view('frontend.pages.doctors', compact('doctors'));
    }

    public function webShow(Doctor $doctor)
    {
        return view('frontend.pages.doctor', compact('doctor'));
    }
}
