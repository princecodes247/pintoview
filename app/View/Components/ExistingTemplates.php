<?php

namespace App\View\Components;

use App\Models\EmbedCode;
use App\Models\Template;
use Illuminate\View\Component;

class ExistingTemplates extends Component
{
    public $templates;

    public function __construct()
    {
        $this->templates = Template::where('user_id', auth()->id())->get();
        // $this->embedCodes = EmbedCode::all();
    }

    public function render()
    {
        return view('components.posts.existing-templates');
    }
}
