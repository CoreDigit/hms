<?php

namespace App\Livewire\Web;

use App\Models\Cruds\SingleService;
use Livewire\Attributes\Layout;
use Livewire\Component;

class IndexSingleServices extends Component
{
    public $search;

    #[Layout('frontend.pages.single-services')]
    public function render()
    {
        $singleServices = SingleService::search($this->search)->paginate(9);
        $count['singleServices'] = SingleService::count();
        return view('livewire.web.index-single-services', compact('singleServices', 'count'));
    }
}
