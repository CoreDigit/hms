<?php

namespace App\Http\Controllers\Cruds;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cruds\InsuranceRequest;
use App\Models\Cruds\Insurance;
use Illuminate\Support\Facades\DB;

class InsuranceController extends Controller
{
    public function index()
    {
        $insurances = Insurance::latest()->get();
        return view('cruds.insurances.index', compact('insurances'));
    }

    public function store(InsuranceRequest $request)
    {
        $data = $request->validated();
        try {
            DB::beginTransaction();

            Insurance::create($data);

            DB::commit();
            return redirect()->route('insurances.index')->with('created', __('validation.created'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('create_error', __('validation.create_error'));
        }
    }

    public function update(InsuranceRequest $request, Insurance $insurance)
    {
        $data = $request->validated();
        try {
            DB::beginTransaction();

            $insurance->update($data);

            DB::commit();
            return redirect()->route('insurances.index')->with('updated', __('validation.updated'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('update_error', __('validation.update_error'));
        }
    }

    public function destroy(Insurance $insurance)
    {
        try {
            $insurance->delete();

            return redirect()->route('insurances.index')->with('deleted', __('validation.deleted'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('delete_error', __('validation.delete_error'));
        }
    }

    ################################################################

    public function destroyGroup(InsuranceRequest $request)
    {
        $data = $request->validated();
        foreach ($data["insurance_ids"] as $insurance_id) {
            Insurance::destroy($insurance_id);
        }
        try {

            return redirect()->route('insurances.index')->with('deleted', __('validation.deleted'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('delete_error', __('validation.delete_error'));
        }
    }

    public function activate(Insurance $insurance)
    {
        try {
            $insurance->update(['status' => true]);
            return redirect()->route('insurances.index')->with('activated', __('validation.activated'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('active_error', __('validation.active_error'));
        }
    }

    public function inactivate(Insurance $insurance)
    {
        try {
            $insurance->update(['status' => false]);
            return redirect()->route('insurances.index')->with('inactivated', __('validation.inactivated'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('inactive_error', __('validation.inactive_error'));
        }
    }

}
