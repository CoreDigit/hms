<?php

namespace App\Http\Controllers\Cruds;

use App\Http\Controllers\Controller;
use App\Models\Cruds\Role;
use App\Models\Cruds\Permission;
use App\Models\Cruds\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class RolePermissionController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->get();
        $permissions = Permission::all()->groupBy('module');

        return view('cruds.roles_permissions.index', compact('roles', 'permissions'));
    }

    public function storeRole(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:roles,name|max:255',
            'label' => 'required|string|max:255',
        ]);

        $role = Role::create([
            'name' => strtolower(str_replace(' ', '_', $request->name)),
            'label' => $request->label,
            'description' => $request->description,
        ]);

        if ($request->has('permissions')) {
            $role->permissions()->sync($request->permissions);
        }

        return redirect()->back()->with('success', "Role '{$role->label}' created successfully!");
    }

    public function updateRolePermissions(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $permissions = $request->input('permissions', []);

        $role->permissions()->sync($permissions);

        AuditLog::create([
            'user_type' => 'admin',
            'user_id' => Auth::id() ?? 1,
            'action' => 'updated',
            'module' => 'roles_permissions',
            'record_id' => $role->id,
            'description' => "Updated permissions matrix for Role '{$role->label}'",
            'ip_address' => $request->ip(),
        ]);

        return redirect()->back()->with('success', "Permissions updated for role '{$role->label}'!");
    }
}
