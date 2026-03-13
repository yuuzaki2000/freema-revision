<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Message;


class Seller extends Component
{
    public $product;
    public $side_trades;
    public $content;

    public $editable;
    public $message;

    public function mount($product, $side_trades){
        $this->product = $product;
        $this->side_trades = $side_trades;
        $this->content = session('content','');

        $this->editable = false;
    }

    public function updatedContent($value){
        session()->put('content', $value);
    }

    public function save($id, $updatedMessage){
        $message = Message::find($id);
        $message->update(['content' => $updatedMessage]);
    }

    public function render()
    {
        return view('livewire.seller');
    }
}

