<?php


namespace App\Http\Livewire;
use Livewire\Component;

use App\Models\Client;

class SearchClients extends Component
{
    public $search = '';
    public $resoult = [];

    public function render()
    {
        $resoult = Client::where('Name', 'like', '%' . $this->search . '%')->get();
        return view('livewire.search-clients', compact('resoult'));
    }
}
