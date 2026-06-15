<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Hero;
use Illuminate\Http\Request;

class HeroController extends Controller
{
    public function index()
    {
        $heroes = Hero::all();
        return view('admin.hero.index', compact('heroes'));
    }

    public function create()
    {
        return view('admin.hero.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'subtitle' => 'required',
            'title' => 'required',
            'description' => 'required',
            'members' => 'required|integer',
            'weekly_classes' => 'required|integer',
            'image' => 'required|image'
        ]);

        $image = $request->file('image')->store('heroes', 'public');

        Hero::create([
            'subtitle' => $request->subtitle,
            'title' => $request->title,
            'description' => $request->description,
            'members' => $request->members,
            'weekly_classes' => $request->weekly_classes,
            'image' => $image
        ]);

        return redirect()->route('admin.hero.index');
    }

    public function edit(Hero $hero)
    {
        return view('admin.hero.edit', compact('hero'));
    }

    public function update(Request $request, Hero $hero)
    {
        $hero->update($request->all());
        return redirect()->route('admin.hero.index');
    }

    public function destroy(Hero $hero)
    {
        $hero->delete();
        return back();
    }
}