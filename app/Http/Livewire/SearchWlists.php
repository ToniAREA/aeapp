<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Wlist;

class SearchWlists extends Component
{
    use WithPagination;

    public $searchTerm;
    public function render()
    {
        $searchTerm = '%' . $this->searchTerm . '%';
        return view('livewire.search-wlists', [
            'resoults' => Wlist::where('id', 'like', $searchTerm)->orderBy('updated_at', 'desc')->paginate(10)
        ]);
    }
}
