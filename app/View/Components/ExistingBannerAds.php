<?php

namespace App\View\Components;

use App\Models\BannerAd;
use Illuminate\View\Component;

class ExistingBannerAds extends Component
{
    public $bannerAds;

    public function __construct()
    {
        $this->bannerAds = BannerAd::where('user_id', auth()->id())->get();
        // $this->bannerAds = BannerAd::all();
    }

    public function render()
    {
        return view('components.embeds.existing-banner-ads');
    }
}
