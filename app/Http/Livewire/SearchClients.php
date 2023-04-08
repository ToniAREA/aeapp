<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Client;

class SearchClients extends Component
{
    use WithPagination;

    public $searchTerm;
    public function render()
    {
        $searchTerm = '%' . $this->searchTerm . '%';
        return view('livewire.search-clients', [
            'resoults' => Client::where('name', 'like', $searchTerm)->paginate(2)
        ]);

    }
}
