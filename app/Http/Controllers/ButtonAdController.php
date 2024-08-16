<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ButtonAd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ButtonAdController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        $buttonAds = ButtonAd::all();
        return view('button-ads.index', compact('buttonAds'));
    }

    // Show the form for creating a new resource.
    public function create()
    {
        return view('button-ads.create');
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'placement' => 'required|in:bottom,top',
            'direct_link' => 'required|url',
            'is_paused' => 'boolean',
        ]);

        ButtonAd::where('user_id', auth()->id())->where('placement', $request->placement)->delete();

        ButtonAd::create(array_merge($request->all(), ['user_id' => auth()->id()]));

        $this->clearCache($request->placement);

        return redirect()->route('button-ads.index')->with('success', 'Button Ad created successfully.');
    }

    // Show the form for editing the specified resource.
    public function edit($id)
    {
        $buttonAd = ButtonAd::findOrFail($id);
        return view('button-ads.edit', compact('buttonAd'));
    }

    public function pause($id)
    {
        $buttonAd = ButtonAd::findOrFail($id);
        $buttonAd->is_paused = !$buttonAd->is_paused;
        $buttonAd->save();

        $this->clearCache($buttonAd->placement);

        return redirect()->route('button-ads.index')->with('success', 'Button Ad status updated successfully.');
    }

    // Update the specified resource in storage.
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'placement' => 'required|in:bottom,top',
            'direct_link' => 'url',
            'is_paused' => 'boolean',
        ]);

        $buttonAd = ButtonAd::findOrFail($id);
        $buttonAd->update($request->all());

        $this->clearCache($request->placement);

        return redirect()->route('button-ads.index')->with('success', 'Button Ad updated successfully.');
    }

    // Remove the specified resource from storage.
    public function destroy($id)
    {
        $buttonAd = ButtonAd::findOrFail($id);
        $buttonAd->delete();

        $this->clearCache($buttonAd->placement);

        return redirect()->route('button-ads.index')->with('success', 'Button Ad deleted successfully.');
    }

    private function clearCache($placement)
    {
        Cache::forget($placement . '_buttonAd');
    }
}
