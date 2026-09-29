<?php

namespace App\Livewire\Cruds\MultiServices;

use App\Models\Cruds\Service;
use App\Models\Cruds\SingleService;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use App\Models\Cruds\MultiService;
use Livewire\Attributes\Locked;
use Livewire\Component;

class UpdateMultiService extends Component
{
    #[Locked]
    public $id;

    public $createView = false;

    public $selectedSingleService, $selectedSingleServices = [];

    public $price;

    public $discount_value = 0, $tax_rate = 17, $total_before_discount, $total_after_discount, $total_with_tax;

    #[Rule('required|string|max:255')]
    public $name;

    #[Rule('nullable|string')]
    public $description;

    #[Rule('required|exists:single_services,id')]
    public $single_service_id;

    #[Rule('required|numeric|min:1|max:10')]
    public $quantity = 1;

    ############################################################3

    public function mount($id)
    {
        $this->id = $id;
        $multiService = MultiService::findOrFail($id);

        foreach ($multiService->singleServices as $singleService) {
            $this->selectedSingleServices[$singleService->id] = [
                'name' => $singleService->name,
                'price' => $singleService->service->price * $singleService->pivot->quantity,
                'quantity' => $singleService->pivot->quantity,
            ];
        }
        
        $this->name = $multiService->name ?? $multiService->translations->first()->name;
        $this->description = $multiService->description ?? $multiService->translations->first()->description;

        $this->total_before_discount = $multiService->total_price;
        $this->discount_value = $multiService->discount_value;
        $this->tax_rate = $multiService->tax_rate;
        $this->calculateTotals();
    }

    public function create()
    {
        $this->createView = true;
    }

    public function confirm()
    {
        $this->validate();
        if (isset($this->selectedSingleServices[$this->single_service_id])) {
            $this->selectedSingleServices[$this->single_service_id]['price'] += $this->price;
            $this->selectedSingleServices[$this->single_service_id]['quantity'] += $this->quantity;
        } else {
            $this->selectedSingleServices[$this->single_service_id] = [
                'name' => $this->selectedSingleService->name,
                'price' => $this->price,
                'quantity' => $this->quantity,
            ];
        }
        $this->calculateTotals();
        $this->createView = false;
        $this->reset(['single_service_id', 'quantity', 'price']);
    }

    public function update()
    {
        DB::beginTransaction();
        try {
            $multiService = MultiService::find($this->id);

            // store in services table
            $multiService->service->update([
                'price' => $this->total_with_tax,
            ]);

            // store in multi_services table
            $multiService->update([
                'name' => $this->name,
                'description' => $this->description,
                'total_price' => $this->total_before_discount,
                'discount_value' => $this->discount_value,
                'tax_rate' => $this->tax_rate,
            ]);

            // store in multi_service_single_service bivot table
            $multiService->singleServices()->detach();
            foreach ($this->selectedSingleServices as $id => $service) {
                $multiService->singleServices()->attach($id, ['quantity' => $service['quantity']]);
            }

            DB::commit();
            return redirect()->route('multi-services.index')->with('created', __('validation.created'));
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('create_error', __('validation.create_error'));
        }
    }

    public function updatedSingleServiceId()
    {
        $this->selectedSingleService = SingleService::find($this->single_service_id);
    }

    public function getServicePrice()
    {
        $this->validateOnly('single_service_id');
        $this->price = $this->quantity * $this->selectedSingleService->service->price;
    }

    public function calculateTotals()
    {
        $this->total_before_discount = 0;
        foreach ($this->selectedSingleServices as $service) {
            $this->total_before_discount += $service['price'];
        }
        $this->total_after_discount = $this->total_before_discount - $this->discount_value;
        $this->total_with_tax = $this->total_after_discount + ($this->tax_rate / 100) * $this->total_after_discount;
    }

    public function remove($single_service_id)
    {
        unset($this->selectedSingleServices[$single_service_id]);
        $this->createView = empty($this->selectedSingleServices);
        $this->calculateTotals();
    }

    public function removeAll()
    {
        $this->selectedSingleServices = [];
        $this->createView = true;
        $this->calculateTotals();
    }

    #[Layout('cruds.multi-services.edit')]
    public function render()
    {
        $singleServices = SingleService::all();
        return view('livewire.cruds.multi-services.update-multi-service', compact('singleServices'));
    }
}
