<?php

namespace App\Http\Controllers\Cruds;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cruds\AmbulanceRequest;
use App\Models\Cruds\Ambulance;
use Illuminate\Support\Facades\DB;

class AmbulanceController extends Controller
{
    public function index()
    {
        $ambulances = Ambulance::latest()->get();
        return view('cruds.ambulances.index', compact('ambulances'));
    }

    public function store(AmbulanceRequest $request)
    {
        $data = $request->validated();
        try {
            DB::beginTransaction();

            Ambulance::create($data);

            DB::commit();
            return redirect()->route('ambulances.index')->with('created', __('validation.created'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('create_error', __('validation.create_error'));
        }
    }

    public function update(AmbulanceRequest $request, Ambulance $ambulance)
    {
        $data = $request->validated();
        try {
            DB::beginTransaction();

            $ambulance->update($data);

            DB::commit();
            return redirect()->route('ambulances.index')->with('updated', __('validation.updated'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('update_error', __('validation.update_error'));
        }
    }

    public function destroy(Ambulance $ambulance)
    {
        try {
            $ambulance->delete();

            return redirect()->route('ambulances.index')->with('deleted', __('validation.deleted'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('delete_error', __('validation.delete_error'));
        }
    }

    ################################################################

    public function destroyGroup(AmbulanceRequest $request)
    {
        $data = $request->validated();
        foreach ($data["ambulance_ids"] as $ambulance_id) {
            Ambulance::destroy($ambulance_id);
        }
        try {

            return redirect()->route('ambulances.index')->with('deleted', __('validation.deleted'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('delete_error', __('validation.delete_error'));
        }
    }

    public function activate(Ambulance $ambulance)
    {
        try {
            $ambulance->update(['status' => true]);
            return redirect()->route('ambulances.index')->with('activated', __('validation.activated'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('active_error', __('validation.active_error'));
        }
    }

    public function inactivate(Ambulance $ambulance)
    {
        try {
            $ambulance->update(['status' => false]);
            return redirect()->route('ambulances.index')->with('inactivated', __('validation.inactivated'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('inactive_error', __('validation.inactive_error'));
        }
    }

}
