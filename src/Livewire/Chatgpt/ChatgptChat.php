<?php

namespace Darvis\Manta\Livewire\Chatgpt;

use Darvis\Manta\Services\Openai;
use Darvis\Manta\Services\OpenAIService;
use Livewire\Component;
use Illuminate\Support\Facades\Http;

class ChatgptChat extends Component
{
    public $messages = [];
    public $messageText = '';

    public array $breadcrumb = [];

    public function mount()
    {
        $this->getBreadcrumb();
    }

    protected $rules = [
        'messageText' => 'required|max:255',
    ];

    public function sendMessage()
    {
        $this->validate();

        // Voeg het gebruikersbericht toe aan de berichtenlijst
        $this->messages[] = ['user' => 'Jij', 'message' => $this->messageText];

        // Stuur het bericht naar de OpenAI API en ontvang het antwoord
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
        ])->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-3.5-turbo', // Of 'gpt-4' afhankelijk van de versie die je gebruikt
            'messages' => [
                ['role' => 'user', 'content' => $this->messageText],
            ],
        ]);

        $responseMessage = $response->json('choices.0.message.content');


        // Voeg het antwoord van de API toe aan de berichtenlijst
        $this->messages[] = ['user' => 'ChatGPT', 'message' => $responseMessage];

        // Maak het invoerveld leeg
        $this->messageText = '';
    }

    public function render()
    {
        return view('livewire.manta.chatgpt.chatgpt-chat');
    }

    public function getBreadcrumb()
    {
        $this->breadcrumb = [
            ["title" => 'Dashboard', "url" => route('cms.dashboard')],
            ["title" => "ChatGPT",],
        ];
    }
}
