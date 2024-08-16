<?php

namespace App\View\Components;

use App\Models\ButtonAd;
use Illuminate\View\Component;

class ExistingButtonAds extends Component
{
    public $buttonAds;

    public function __construct()
    {
        $this->buttonAds = ButtonAd::where('user_id', auth()->id())->get();
    }

    public function render()
    {
        return view('components.embeds.existing-button-ads');
    }
}
