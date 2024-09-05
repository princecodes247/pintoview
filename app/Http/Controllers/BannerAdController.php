<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BannerAd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BannerAdController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        if (!auth()->user()->isPremium()) {
            return redirect()->route('pricing.index');
        } 
        $bannerAds = BannerAd::all();
        return view('banner-ads.index', compact('bannerAds'));
    }

    // Show the form for creating a new resource.
    public function create()
    {
        if (!auth()->user()->isPremium()) {
            return redirect()->route('pricing.index');
        } 
        return view('banner-ads.create');
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'placement' => 'required|in:header,footer',
            'direct_link' => 'url',
            'image' => 'required|url|max:255',
            'mobile_image' => 'nullable|url|max:255',
        ]);

        if (!auth()->user()->isPremium()) {
            return redirect()->route('pricing.index');
        } 

        // Delete the previous banner in that placement
        BannerAd::where('user_id', auth()->id())->where('placement', $request->placement)->delete();

        // Create the new banner
        BannerAd::create(array_merge($request->all(), ['user_id' => auth()->id()]));


        // Clear the cache for that placement

        $this->clearCache($request->placement);
        return redirect()->route('banner-ads.index')->with('success', 'Banner Ad created successfully.');
    }

    // Show the form for editing the specified resource.
    public function edit($id)
    {
        if (!auth()->user()->isPremium()) {
            return redirect()->route('pricing.index');
        } 
        $bannerAd = BannerAd::where('user_id', auth()->id())->findOrFail($id);
        return view('banner-ads.edit', compact('bannerAd'));
    }

    // Update the specified resource in storage.
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'placement' => 'required|in:header,footer',
            'direct_link' => 'url',
            'image' => 'required|string|max:255',
            'mobile_image' => 'nullable|string|max:255',
        ]);
        if (!auth()->user()->isPremium()) {
            return redirect()->route('pricing.index');
        } 
        $bannerAd = BannerAd::where('user_id', auth()->id())->where('id', $id)->first();
        if ($bannerAd) {
            $bannerAd->update($request->all());
        }
        $this->clearCache($request->placement);

        return redirect()->route('banner-ads.index')->with('success', 'Banner Ad updated successfully.');
    }

    // Redirect to the direct link of the specified banner ad.
    public function redirectToLink($id)
    {
        $bannerAd = BannerAd::findOrFail($id);

        if ($bannerAd->direct_link) {
            // Increase the views count for the banner ad
            // $bannerAd->increment('views');
            return redirect()->away($bannerAd->direct_link);
        }

        return redirect()->route('banner-ads.index')->with('error', 'No direct link found for this banner ad.');
    }

    // Remove the specified resource from storage.
    public function destroy($id)
    {
        if (!auth()->user()->isPremium()) {
            return redirect()->route('pricing.index');
        } 
        $bannerAd = BannerAd::where('user_id', auth()->id())->findOrFail($id);
        $bannerAd->delete();

        $this->clearCache($bannerAd->placement == 'header' || $bannerAd->placement == 'footer' ? "general" : $bannerAd->placement);

        return redirect()->route('banner-ads.index')->with('success', 'Banner Ad deleted successfully.');
    }

    private function clearCache($placement)
    {
        Cache::forget($placement . '_bannerAd');
    }
}
