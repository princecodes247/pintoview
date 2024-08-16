<?php

namespace App\View\Components;

use App\Models\EmbedCode;
use Illuminate\View\Component;

class ExistingEmbedCodes extends Component
{
    public $embedCodes;

    public function __construct()
    {
        $this->embedCodes = EmbedCode::where('user_id', auth()->id())->get();
        // $this->embedCodes = EmbedCode::all();
    }

    public function render()
    {
        return view('components.embeds.existing-embed-codes');
    }
}
