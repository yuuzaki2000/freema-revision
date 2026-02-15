<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Test extends Component
{

    public $product;
    public $contents;
    public $side_trades;
    public $content;

    public function mount($product, $contents, $side_trades, $content){
        $this->product = $product;
        $this->contents = $contents;
        $this->side_trades = $side_trades;
        $this->content = $content;
    }

    public function updatedContent($value){
        session()->put('content', $value);
    }

    public function render()
    {
        return view('livewire.test');
    }
}
