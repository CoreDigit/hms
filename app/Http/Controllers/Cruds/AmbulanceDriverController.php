<?php

namespace App\Http\Controllers\Cruds;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\PasswordRequest;
use App\Http\Requests\Cruds\AmbulanceDriverRequest;
use App\Models\Users\AmbulanceDriver;
use App\Traits\ImageUploadTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AmbulanceDriverController extends Controller
{
    use ImageUploadTrait;

    public function index()
    {
        $ambulanceDrivers = AmbulanceDriver::orderBy('updated_at', 'desc')->get();
        return view('cruds.ambulanceDrivers.index', compact('ambulanceDrivers'));
    }

    public function create()
    {
        return view('cruds.ambulanceDrivers.create');
    }

    public function store(AmbulanceDriverRequest $request)
    {
        $data = $request->validated();
        try {
            DB::beginTransaction();
            AmbulanceDriver::create($data);

            DB::commit();
            return redirect()->route('ambulanceDrivers.index')->with('created', __('validation.created'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('create_error', __('validation.create_error'));
        }
    }

    public function show(AmbulanceDriver $ambulanceDriver)
    {
        return view('cruds.ambulanceDrivers.show', compact('ambulanceDriver'));
    }

    public function edit(AmbulanceDriver $ambulanceDriver)
    {
        return view('cruds.ambulanceDrivers.edit', compact('ambulanceDriver'));
    }

    public function update(AmbulanceDriverRequest $request, AmbulanceDriver $ambulanceDriver)
    {
        $data = $request->validated();
        try {
            DB::beginTransaction();
            $ambulanceDriver->update($data);

            DB::commit();
            return redirect()->route('ambulanceDrivers.index')->with('updated', __('validation.updated'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('update_error', __('validation.update_error'));
        }
    }

    public function destroy(AmbulanceDriver $ambulanceDriver)
    {
        try {
            $ambulanceDriver->delete();
            return redirect()->route('ambulanceDrivers.index')->with('deleted', __('validation.deleted'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('delete_error', __('validation.delete_error'));
        }
    }

    ################################################################

    public function activate(AmbulanceDriver $ambulanceDriver)
    {
        try {
            $ambulanceDriver->update(['status' => true]);
            return redirect()->route('ambulanceDrivers.index')->with('activated', __('validation.activated'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('active_error', __('validation.active_error'));
        }
    }

    public function inactivate(AmbulanceDriver $ambulanceDriver)
    {
        try {
            $ambulanceDriver->update(['status' => false]);
            return redirect()->route('ambulanceDrivers.index')->with('inactivated', __('validation.inactivated'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('inactive_error', __('validation.inactive_error'));
        }
    }
}
