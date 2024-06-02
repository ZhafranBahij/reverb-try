<?php

namespace App\Livewire;

use App\Events\MessageEvent;
use App\Models\Message;
use Livewire\Attributes\On;
use Livewire\Component;

class ChatComponent extends Component
{
    public $message;
    public $convos = [];

    // Every page display, this process will be started first
    public function mount(){
        $all_message = Message::all();
        foreach ($all_message as $key => $value) {
            $this->convos[] = [
                'username' => $value->user->name,
                'message' => $value->message,
            ];
        }
    }

    // submit the message
    public function submit(){
        MessageEvent::dispatch(auth()->user()->id, $this->message);
        $this->message = '';
    }

    // Using event to auto update conversation
    // format #[On('echo:channel-name,YourEvent')]
    #[On('echo:message-channel,MessageEvent')]
    public function listenForMessage($data){
        $this->convos[] = [
            'username' => $data['username'],
            'message' => $data['message'],
        ];
    }

    // Rendering the apge
    public function render()
    {
        return view('livewire.chat-component');
    }
}
