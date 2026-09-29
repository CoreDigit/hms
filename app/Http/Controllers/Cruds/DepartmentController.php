<?php

namespace App\Http\Controllers\Cruds;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cruds\DepartmentRequest;
use App\Models\Cruds\Department;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::latest()->get();
        return view('cruds.departments.index', compact('departments'));
    }

    public function store(DepartmentRequest $request)
    {
        $data = $request->validated();
        try {
            DB::beginTransaction();
            Department::create($data);
            DB::commit();
            return redirect()->route('departments.index')->with('created', __('validation.created'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('create_error', __('validation.create_error'));
        }
    }

    public function update(DepartmentRequest $request, Department $department)
    {
        $data = $request->validated();
        try {
            DB::beginTransaction();

            $department->update($data);

            DB::commit();
            return redirect()->route('departments.index')->with('updated', __('validation.updated'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('update_error', __('validation.update_error'));
        }
    }

    public function destroy(Department $department)
    {
        try {
            $department->delete();

            return redirect()->route('departments.index')->with('deleted', __('validation.deleted'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('delete_error', __('validation.delete_error'));
        }
    }

    ################################################################

    public function destroyGroup(DepartmentRequest $request)
    {
        $data = $request->validated();
        foreach ($data["department_ids"] as $department_id) {
            Department::destroy($department_id);
        }
        try {

            return redirect()->route('departments.index')->with('deleted', __('validation.deleted'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('delete_error', __('validation.delete_error'));
        }
    }

    ################################### Web #######################################

    public function webIndex()
    {
        $departments = Department::all();
        return view('frontend.pages.departments', compact('departments'));
    }

    public function webShow(Department $department)
    {
        $departmentDoctors = $department->doctors;
        return view('frontend.pages.department', compact('department', 'departmentDoctors'));
    }
}
