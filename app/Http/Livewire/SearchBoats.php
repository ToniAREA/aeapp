<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Boat;

class SearchBoats extends Component
{
    use WithPagination;

    public $searchTerm;
    public function render()
    {
        $searchTerm = '%' . $this->searchTerm . '%';
        return view('livewire.search-boats', [
            'resoults' => 
            Boat::
            where('name', 'like', $searchTerm)->
            orderBy('updated_at', 'desc')->
            paginate(10)
        ]);
    }
}
