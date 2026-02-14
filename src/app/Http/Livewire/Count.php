<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Count extends Component
{

    public $count = 4;

    public function setCount($value){
        $this->count = $value;
    }

    public function starClass($i){
        return $i <= $this->count ? 'filled' : '';
    }

    public function render()
    {
        return view('livewire.count');
    }
}
