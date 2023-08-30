<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Team;
use Illuminate\Support\Facades\Auth;

class Products extends Component
{
    public $products;
    public $user;

    public $team;
    public function render()
    {
        $this->products = Product::all();
        $this->user = Auth::user();

        $this->team = Team::find($this->user->current_team_id);

        $can_list = $this->user->can('product-list');

        //dd( $this->team->userHasPermission($this->user, 'product:read'));
        if ($can_list)
            return view('livewire.products');
        else
            abort(403, 'Forbidden');
    }
}
