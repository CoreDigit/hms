<?php

namespace App\Http\Controllers\Cruds;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cruds\RayRequest;
use App\Models\Cruds\Ray;
use App\Traits\ImageUploadTrait;
use Illuminate\Support\Facades\DB;

class RayController extends Controller
{
    public function index($status = 'all')
    {
        $rays = match ($status) {
            'all' => Ray::latest()->get(),
            'pending' => Ray::where('status', 'pending')->latest()->get(),
            'in-progress' => Ray::where('status', 'in-progress')->latest()->get(),
            'completed' => Ray::where('status', 'completed')->latest()->get(),
            default => [],
        };

        return view('cruds.rays.index', compact('rays'));
    }

    #####################################################

    use ImageUploadTrait;

    public function diagnosis(RayRequest $request, Ray $ray)
    {
        $data = $request->validated();
        try {
            DB::beginTransaction();

            $data['status'] = 'completed';
            $data['ray_employee_id'] = auth()->user()->id;
            $ray->update($data);

            // Ray images
            if (isset($data['images'])) {
                foreach ($ray->images as $image) {
                    $this->deleteImage($image);
                }
                foreach ($data['images'] as $image) {
                    if ($image->isValid() ) {
                        $this->addImage($image, $ray, 'rays');
                    }
                }
            }

            DB::commit();
            return redirect()->route('rayEmployee.rays.index', 'all')->with('updated', __('validation.updated'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('update_error', __('validation.update_error'));
        }
    }

    public function gallery(Ray $ray)
    {
        $images = $ray->images()->paginate(6);
        return view('cruds.rays.gallery', compact('images'));
    }
}
