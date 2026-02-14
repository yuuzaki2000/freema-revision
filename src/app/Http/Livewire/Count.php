<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Star;
use Illuminate\Support\Facades\Auth;

class Count extends Component
{

    public $count = 0;
    public $seller;
    public $product;

    public function mount($seller, $product){
        $this->seller = $seller;
        $this->product = $product;
    }

    public function setCount($value){
        $this->count = $value;
    }

    public function starClass($i){
        return $i <= $this->count ? 'filled' : '';
    }

    public function sendStar(){
        Star::create([
            'user_id' => $this->seller->id,
            'point' => $this->count,
            ]);
        
        return redirect()->route('item.index', $this->product->id);
    }

    public function render()
    {
        return view('livewire.count');
    }
}
