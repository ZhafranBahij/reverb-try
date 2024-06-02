<?php

namespace App\Livewire;

use Livewire\Component;

class ChatComponent extends Component
{
    public $message;
    public function render()
    {
        return view('livewire.chat-component');
    }
}
