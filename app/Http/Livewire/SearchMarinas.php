<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Marina;

class SearchMarinas extends Component
{
    use WithPagination;

    public $searchTerm;
    public function render()
    {
        $searchTerm = '%' . $this->searchTerm . '%';
        return view('livewire.search-marinas', [
            'resoults' => Marina::where('name', 'like', $searchTerm)->orderBy('updated_at', 'desc')->paginate(10)
        ]);
    }
}
