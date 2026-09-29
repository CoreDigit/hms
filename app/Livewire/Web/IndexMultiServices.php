<?php

namespace App\Livewire\Web;

use App\Models\Cruds\MultiService;
use Livewire\Attributes\Layout;
use Livewire\Component;

class IndexMultiServices extends Component
{
    public $search;

    #[Layout('frontend.pages.multi-services')]
    public function render()
    {
        $multiServices = MultiService::search($this->search)->paginate(9);
        $count['multiServices'] = MultiService::count();
        return view('livewire.web.index-multi-services', compact('multiServices', 'count'));
    }
}
