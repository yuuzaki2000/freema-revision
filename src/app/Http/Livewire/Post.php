<?php

namespace App\Http\Livewire;

use Livewire\Component;


class Post extends Component
{
    public $product;
    public $contents;
    public $side_trades;
    public $content;
    public $message_id;

    public $editable;

    public function mount($product, $contents, $side_trades){
        $this->product = $product;
        $this->contents = $contents;
        $this->side_trades = $side_trades;
        $this->content = session('content','');

        $this->editable = false;
    }

    public function updatedContent($value){
        session()->put('content', $value);
    }

    public function changeToEditable(){
        $this->editable = true;
    }

    public function render()
    {
        return view('livewire.post');
    }
}
