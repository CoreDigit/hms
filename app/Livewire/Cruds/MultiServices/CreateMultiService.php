<?php

namespace App\Livewire\Cruds\MultiServices;

use App\Models\Cruds\MultiService;
use App\Models\Cruds\Service;
use App\Models\Cruds\SingleService;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Component;

class CreateMultiService extends Component
{
    public $createView = true;

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
        }
        else {
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

    public function store()
    {
        DB::beginTransaction();
        try {
            // store in services table
            $service = Service::create([
                'type' => 'multi',
                'price' => $this->total_with_tax,
            ]);
            
            // store in multi_services table
            $multiService = MultiService::create([
                'name' => $this->name,
                'description' => $this->description,
                'service_id' => $service->id,
                'total_price' => $this->total_before_discount,
                'discount_value' => $this->discount_value,
                'tax_rate' => $this->tax_rate,
            ]);
            
            // store in multi_service_single_service bivot table
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

    // #[Computed]
    // public function singleServices()
    // {
    //     return SingleService::all();
    // }

    #[Layout('cruds.multi-services.create')]
    public function render()
    {
        $singleServices = SingleService::all();
        return view('livewire.cruds.multi-services.create-multi-service', compact('singleServices'));
    }
}
