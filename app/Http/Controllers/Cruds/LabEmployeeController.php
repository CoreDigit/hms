<?php

namespace App\Http\Controllers\Cruds;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\PasswordRequest;
use App\Http\Requests\Cruds\LabEmployeeRequest;
use App\Models\Users\LabEmployee;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class LabEmployeeController extends Controller
{
    use ImageUploadTrait;

    public function index()
    {
        $labEmployees = LabEmployee::orderBy('updated_at', 'desc')->get();
        return view('cruds.labEmployees.index', compact('labEmployees'));
    }

    public function create()
    {
        return view('cruds.labEmployees.create');
    }

    public function store(LabEmployeeRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        try {
            DB::beginTransaction();
            $labEmployee = LabEmployee::create($data);

            if (isset($data['image'])) {
                $username = strtok($labEmployee->email, '@') . '.' . $data['image']->getClientOriginalExtension();
                $this->addImage($data['image'], $labEmployee, 'labEmployees', $username);
            }

            DB::commit();
            return redirect()->route('labEmployees.index')->with('created', __('validation.created'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('create_error', __('validation.create_error'));
        }
    }

    public function show(Request $request, LabEmployee $labEmployee)
    {
        if (auth()->guard('labEmployee')->check()) {
            $labEmployee = $request->user();
        }
        return view('cruds.labEmployees.show', compact('labEmployee'));
    }

    public function edit(LabEmployee $labEmployee)
    {
        return view('cruds.labEmployees.edit', compact('labEmployee'));
    }

    public function update(LabEmployeeRequest $request, LabEmployee $labEmployee)
    {
        if (auth()->guard('labEmployee')->check()) {
            $labEmployee = $request->user();
        }

        $data = $request->validated();
        try {
            DB::beginTransaction();
            $labEmployee->update($data);

            if ($request->has('remove_image')) {
                if ($labEmployee->image->path !== 'default/labEmployee.png') {
                    $this->deleteImage($labEmployee->image);
                }
            } else if ($request->has('image')) {
                if ($labEmployee->image->path !== 'default/labEmployee.png') {
                    $this->deleteImage($labEmployee->image);
                }
                $username = strtok($labEmployee->email, '@') . '.' . $data['image']->getClientOriginalExtension();
                $this->addImage($data['image'], $labEmployee, 'labEmployees', $username);
            }

            DB::commit();
            return redirect()->route(auth()->guard('admin')->check() ? 'labEmployees.index' : 'labEmployee.show')->with('updated', __('validation.updated'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('update_error', __('validation.update_error'));
        }
    }

    public function destroy(Request $request, LabEmployee $labEmployee)
    {
        $request->validate([
            'last_password' => ['required'],
        ]);
        if (auth()->guard('labEmployee')->check()) {
            $request->validate([
                'last_password' => ['current_password'],
            ]);
            $labEmployee = $request->user();
            Auth::logout();
            $labEmployee->delete();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return Redirect::to('/');
        }
        if (Hash::check($request->last_password, auth()->user()->password)) {
            $labEmployee->delete();
            return redirect()->route('labEmployees.index')->with('deleted', __('validation.deleted'));
        }
        return redirect()->back()->with('password_error', __('validation.password_error'));
    }

    ################################################################

    public function updatePassword(PasswordRequest $request, LabEmployee $labEmployee)
    {
        if (auth()->guard('labEmployee')->check()) {
            $labEmployee = $request->user();
        }

        $data = $request->validated();
        if (Hash::check($data['current_password'], $labEmployee->password)) {
            $labEmployee->update(['password' => Hash::make($data['password'])]);
            return auth()->guard('admin')->check() ?
                redirect()->route('labEmployees.show', $labEmployee->id)->with('password', __('validation.password_updated')) :
                redirect()->route('labEmployee.show')->with('password', __('validation.password_updated'));
        }
        return redirect()->back()->with('password_error', __('validation.password_error'));
    }

    public function activate(LabEmployee $labEmployee)
    {
        try {
            $labEmployee->update(['status' => true]);
            return redirect()->route('labEmployees.index')->with('activated', __('validation.activated'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('active_error', __('validation.active_error'));
        }
    }

    public function inactivate(LabEmployee $labEmployee)
    {
        try {
            $labEmployee->update(['status' => false]);
            return redirect()->route('labEmployees.index')->with('inactivated', __('validation.inactivated'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('inactive_error', __('validation.inactive_error'));
        }
    }
}
