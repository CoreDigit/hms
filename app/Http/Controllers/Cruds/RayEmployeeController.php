<?php

namespace App\Http\Controllers\Cruds;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\PasswordRequest;
use App\Http\Requests\Cruds\RayEmployeeRequest;
use App\Models\Users\RayEmployee;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class RayEmployeeController extends Controller
{
    use ImageUploadTrait;

    public function index()
    {
        $rayEmployees = RayEmployee::orderBy('updated_at', 'desc')->get();
        return view('cruds.rayEmployees.index', compact('rayEmployees'));
    }

    public function create()
    {
        return view('cruds.rayEmployees.create');
    }

    public function store(RayEmployeeRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        try {
            DB::beginTransaction();
            $rayEmployee = RayEmployee::create($data);

            if (isset($data['image'])) {
                $username = strtok($rayEmployee->email, '@') . '.' . $data['image']->getClientOriginalExtension();
                $this->addImage($data['image'], $rayEmployee, 'rayEmployees', $username);
            }

            DB::commit();
            return redirect()->route('rayEmployees.index')->with('created', __('validation.created'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('create_error', __('validation.create_error'));
        }
    }

    public function show(Request $request, RayEmployee $rayEmployee)
    {
        if (auth()->guard('rayEmployee')->check()) {
            $rayEmployee = $request->user();
        }
        return view('cruds.rayEmployees.show', compact('rayEmployee'));
    }

    public function edit(RayEmployee $rayEmployee)
    {
        return view('cruds.rayEmployees.edit', compact('rayEmployee'));
    }

    public function update(RayEmployeeRequest $request, RayEmployee $rayEmployee)
    {
        if (auth()->guard('rayEmployee')->check()) {
            $rayEmployee = $request->user();
        }

        $data = $request->validated();
        try {
            DB::beginTransaction();
            $rayEmployee->update($data);

            if ($request->has('remove_image')) {
                if ($rayEmployee->image->path !== 'default/rayEmployee.png') {
                    $this->deleteImage($rayEmployee->image);
                }
            } else if ($request->has('image')) {
                if ($rayEmployee->image->path !== 'default/rayEmployee.png') {
                    $this->deleteImage($rayEmployee->image);
                }
                $username = strtok($rayEmployee->email, '@') . '.' . $data['image']->getClientOriginalExtension();
                $this->addImage($data['image'], $rayEmployee, 'rayEmployees', $username);
            }

            DB::commit();
            return auth()->guard('admin')->check() ?
                redirect()->route('rayEmployees.show', $rayEmployee->id)->with('updated', __('validation.updated')) :
                redirect()->route('rayEmployee.show')->with('updated', __('validation.updated'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('update_error', __('validation.update_error'));
        }
    }

    public function destroy(Request $request, RayEmployee $rayEmployee)
    {
        $request->validate([
            'last_password' => ['required'],
        ]);
        if (auth()->guard('rayEmployee')->check()) {
            $request->validate([
                'last_password' => ['current_password'],
            ]);
            $rayEmployee = $request->user();
            Auth::logout();
            $rayEmployee->delete();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return Redirect::to('/');
        }
        if (Hash::check($request->last_password, auth()->user()->password)) {
            $rayEmployee->delete();
            return redirect()->route('rayEmployees.index')->with('deleted', __('validation.deleted'));
        }
        return redirect()->back()->with('password_error', __('validation.password_error'));
    }

    ################################################################

    public function updatePassword(PasswordRequest $request, RayEmployee $rayEmployee)
    {
        if (auth()->guard('rayEmployee')->check()) {
            $rayEmployee = $request->user();
        }

        $data = $request->validated();
        if (Hash::check($data['current_password'], $rayEmployee->password)) {
            $rayEmployee->update(['password' => Hash::make($data['password'])]);
            return auth()->guard('admin')->check() ?
                redirect()->route('rayEmployees.show', $rayEmployee->id)->with('password', __('validation.password_updated')) :
                redirect()->route('rayEmployee.show')->with('password', __('validation.password_updated'));
        }
        return redirect()->back()->with('password_error', __('validation.password_error'));
    }

    public function activate(RayEmployee $rayEmployee)
    {
        try {
            $rayEmployee->update(['status' => true]);
            return redirect()->route('rayEmployees.index')->with('activated', __('validation.activated'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('active_error', __('validation.active_error'));
        }
    }

    public function inactivate(RayEmployee $rayEmployee)
    {
        try {
            $rayEmployee->update(['status' => false]);
            return redirect()->route('rayEmployees.index')->with('inactivated', __('validation.inactivated'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('inactive_error', __('validation.inactive_error'));
        }
    }
}
