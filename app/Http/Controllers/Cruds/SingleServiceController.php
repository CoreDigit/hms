<?php

namespace App\Http\Controllers\Cruds;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cruds\SingleServiceRequest;
use App\Models\Cruds\Service;
use App\Models\Cruds\SingleService;
use App\Models\Cruds\SingleServiceTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SingleServiceController extends Controller
{
    public function index()
    {
        $singleServices = match (auth()->guard()->name) {
            'admin' => SingleService::latest()->get(),
            'patient' => SingleService::active()->latest()->get(),
        };
        return view('cruds.single-services.index', compact('singleServices'));
    }

    public function store(SingleServiceRequest $request)
    {
        $data = $request->validated();
        try {
            DB::beginTransaction();

            $service = Service::create([
                'type' => 'single',
                'price' => $data['price'],
            ]);

            SingleService::create([
                'service_id' => $service->id,
                'name' => $data['name'],
                'description' => $data['description'],
            ]);

            DB::commit();
            return redirect()->route('single-services.index')->with('created', __('validation.created'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('create_error', __('validation.create_error'));
        }
    }

    public function update(SingleServiceRequest $request, SingleService $singleService)
    {
        $data = $request->validated();
        try {
            DB::beginTransaction();

            $singleService->service->update([
                'price' => $data['price'],
            ]);

            $singleService->update($data);

            DB::commit();
            return redirect()->route('single-services.index')->with('updated', __('validation.updated'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('update_error', __('validation.update_error'));
        }
    }

    public function destroy(SingleService $singleService)
    {
        try {
            $service = $singleService->service;
            $service->delete();
            // $singleService->delete(); // this just delete singleService itself without deleting form service table
            return redirect()->route('single-services.index')->with('deleted', __('validation.deleted'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('delete_error', __('validation.delete_error'));
        }
    }

    ################################################################

    public function destroyGroup(SingleServiceRequest $request)
    {
        $data = $request->validated();
        try {
            foreach ($data["single_service_ids"] as $single_service_id) {
                $service = SingleService::find($single_service_id)->service;
                $service->delete();
            }
            return redirect()->route('single-services.index')->with('deleted', __('validation.deleted'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('delete_error', __('validation.delete_error'));
        }
    }

    public function activate(SingleService $singleService)
    {
        try {
            $singleService->service->update(['status' => true]);
            return redirect()->route('single-services.index')->with('activated', __('validation.activated'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('active_error', __('validation.active_error'));
        }
    }

    public function inactivate(SingleService $singleService)
    {
        try {
            $singleService->service->update(['status' => false]);
            return redirect()->route('single-services.index')->with('inactivated', __('validation.inactivated'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('inactive_error', __('validation.inactive_error'));
        }
    }
}

/**
 * Note: I have manually stored the translation untill solve the problem.
 * Problem: Arabic attributes (name, description) doesn't store automatically.
 * Also: I added ('locale', 'single_service_id') in Translation Model.
 * 
 * *** Prolbme solved: YOU MUST PUT fillable WITH translatedAttributes TOOOOOOOOOOOOOOOOO
 */
