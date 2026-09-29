<?php

namespace App\Http\Controllers\cruds;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\PasswordRequest;
use App\Http\Requests\Cruds\AdminRequest;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    use ImageUploadTrait;

    public function show(Request $request)
    {
        $admin = $request->user();
        return view('cruds.admins.show', compact('admin'));
    }

    public function update(AdminRequest $request)
    {
        $admin = $request->user();

        $data = $request->validated();

        $admin->update($data);

        if ($request->has('remove_image')) {
            if ($admin->image->path !== 'default/admin.png') {
                $this->deleteImage($admin->image);
            }
        } else if ($request->has('image')) {
            if ($admin->image->path !== 'default/admin.png') {
                $this->deleteImage($admin->image);
            }
            $username = strtok($admin->email, '@') . '.' . $data['image']->getClientOriginalExtension();
            $this->addImage($data['image'], $admin, 'admins', $username);
        }

        return redirect()->back()->with('updated', __('validation.updated'));
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'last_password' => ['required', 'current_password'],
        ]);
        $admin = $request->user();
        Auth::logout();
        $admin->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return Redirect::to('/');
    }

    ################################################################

    public function updatePassword(PasswordRequest $request)
    {
        $admin = $request->user();
        $data = $request->validated();

        if (Hash::check($data['current_password'], $admin->password)) {
            $admin->update(['password' => Hash::make($data['password'])]);
            return redirect()->back()->with('password', __('validation.password_updated'));
        }

        return redirect()->back()->with('password_error', __('validation.password_error'));
    }
}
