<?php

namespace App\Http\Controllers\Cruds;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cruds\LabRequest;
use App\Models\Cruds\Lab;
use App\Traits\ImageUploadTrait;
use Illuminate\Support\Facades\DB;

class LabController extends Controller
{
    public function index($status = 'all')
    {
        $labs = match ($status) {
            'all' => Lab::latest()->get(),
            'pending' => Lab::where('status', 'pending')->latest()->get(),
            'in-progress' => Lab::where('status', 'in-progress')->latest()->get(),
            'completed' => Lab::where('status', 'completed')->latest()->get(),
            default => [],
        };

        return view('cruds.labs.index', compact('labs'));
    }
    /**
     * Lab Employee have no his own labs like docotor has his own patients... 
     * No, all labs will show in the index page
     * who will diagnosis the lab, he will store in the diagnosis
     */

    #####################################################

    use ImageUploadTrait;

    public function diagnosis(LabRequest $request, Lab $lab)
    {
        $data = $request->validated();
        try {
            DB::beginTransaction();
            
            $data['status'] = 'completed';
            $data['lab_employee_id'] = auth()->user()->id;
            $lab->update($data);
            
            // Lab images
            if (isset($data['images'])) {
                foreach ($lab->images as $image) {
                    $this->deleteImage($image);
                }
                foreach ($data['images'] as $image) {
                    $this->addImage($image, $lab, 'labs');
                }
            }

            DB::commit();
            return redirect()->route('labEmployee.labs.index', 'all')->with('updated', __('validation.updated'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('update_error', __('validation.update_error'));
        }
    }

    public function gallery(Lab $lab)
    {
        $images = $lab->images()->paginate(6);
        return view('cruds.labs.gallery', compact('images'));
    }
}
