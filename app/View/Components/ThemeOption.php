<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ThemeOption extends Component
{
    public $id;
    public $bgColor;
    public $contentBgColor;
    public $highlightColor;
    public $checked;

    public function __construct($id, $bgColor, $contentBgColor, $highlightColor, $checked = false)
    {
        $this->id = $id;
        $this->bgColor = $bgColor;
        $this->contentBgColor = $contentBgColor;
        $this->highlightColor = $highlightColor;
        $this->checked = $checked;
    }

    public function render()
    {
        return view('components.posts.theme-option');
    }
}
