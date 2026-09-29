<?php

namespace App\Http\Controllers\Cruds;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cruds\MultiServiceRequest;
use App\Models\Cruds\MultiService;
use Illuminate\Support\Facades\DB;

class MultiServiceController extends Controller
{
    public function index()
    {
        $multiServices = match(auth()->guard()->name) {
            'admin' => MultiService::latest()->get(),
            'patient' => MultiService::active()->latest()->get(),
        };
        return view('cruds.multi-services.index', compact('multiServices'));
    }

    public function destroy(MultiService $multiService)
    {
        try {
            $service = $multiService->service;
            $service->delete();
            // $multiService->delete(); // this just delete multiservice itself without deleting form service table
            return redirect()->route('multi-services.index')->with('deleted', __('validation.deleted'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('delete_error', __('validation.delete_error'));
        }
    }

    ################################################################

    public function destroyGroup(MultiServiceRequest $request)
    {
        $data = $request->validated();
        try {
            foreach ($data["multi_service_ids"] as $multi_service_id) {
                $service = MultiService::find($multi_service_id)->service;
                $service->delete();
            }
            return redirect()->route('multi-services.index')->with('deleted', __('validation.deleted'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('delete_error', __('validation.delete_error'));
        }
    }

    public function activate(MultiService $multiService)
    {
        try {
            $multiService->service->update(['status' => true]);
            return redirect()->route('multi-services.index')->with('activated', __('validation.activated'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('active_error', __('validation.active_error'));
        }
    }

    public function inactivate(MultiService $multiService)
    {
        try {
            $multiService->service->update(['status' => false]);
            return redirect()->route('multi-services.index')->with('inactivated', __('validation.inactivated'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('inactive_error', __('validation.inactive_error'));
        }
    }
}
