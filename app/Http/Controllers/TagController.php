<?php
namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TagController extends Controller

{
    use AuthorizesRequests;

    public function index()
    {
        $tags = Tag::all();
        return view('tags.index', compact('tags'));
    }

    public function create()
    {
        $this->authorize('manageTag', Tag::class);

        return view('tags.create');
    }

    public function store(Request $request)
    {
        $this->authorize('manageTag', Tag::class);

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Tag::create($request->all());

        return redirect()->route('tags.index');
    }

    public function edit($id)
    {
        $this->authorize('manageTag', Tag::class);

        $tag = Tag::findOrFail($id);
        return view('tags.edit', compact('tag'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('manageTag', Tag::class);

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $tag = Tag::findOrFail($id);
        $tag->update($request->all());

        return redirect()->route('tags.index');
    }

    public function destroy($id)
    {
        $this->authorize('manageTag', Tag::class);

        Tag::findOrFail($id)->delete();
        return redirect()->route('tags.index');
    }
}
