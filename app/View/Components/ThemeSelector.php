<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ThemeSelector extends Component
{
    public $selectedTheme;

    public function __construct()
    {
        $this->selectedTheme = auth()->user()->default_post_theme;

    }

    public function render()
    {
        return view('components.posts.theme-selector');
    }
}
