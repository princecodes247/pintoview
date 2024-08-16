<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\EmbedCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class EmbedCodeController extends Controller
{
    public function index()
    {
        $embedCodes = EmbedCode::where('user_id', auth()->id());
        return view('embeds.show', compact('embedCodes'));
    }

    public function api()
    {
        return view('api-tokens.show');
    }

    public function create()
    {
        return view('embed-codes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        EmbedCode::where('user_id', auth()->id())->delete();

        EmbedCode::create(array_merge($request->all(), ['user_id' => auth()->id()]));

        $this->clearCache($request->placement);

        return redirect()->route('embeds.index')->with('success', 'Embed Code created successfully.');
    }

    public function edit($id)
    {
        $embedCode = EmbedCode::where('user_id', auth()->id())->findOrFail($id);
        return view('embed-codes.edit', compact('embedCode'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'placement' => 'required|in:global,local',
            'content' => 'required|string',
        ]);

        $embedCode = EmbedCode::where('user_id', auth()->id())->findOrFail($id);
        $embedCode->update($request->all());

        $this->clearCache($request->placement);

        return redirect()->route('embeds.index')->with('success', 'Embed Code updated successfully.');
    }

    public function destroy($id)
    {
        $embedCode = EmbedCode::where('user_id', auth()->id())->findOrFail($id);
        $embedCode->delete();

        $this->clearCache($embedCode->placement);

        return redirect()->route('embeds.index')->with('success', 'Embed Code deleted successfully.');
    }

    private function clearCache($placement)
    {
        Cache::forget($placement . '_embedCode');
    }
}
