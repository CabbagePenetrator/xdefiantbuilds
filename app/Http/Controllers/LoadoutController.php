<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\GunResource;
use App\Http\Resources\LoadoutResource;
use App\Models\Category;
use App\Models\Gun;
use App\Models\Loadout;
use Illuminate\Http\Request;

class LoadoutController extends Controller
{
    public function index(Request $request)
    {
        $loadouts = Loadout::query()
            ->select('*')
            ->with('user', 'gun.category')
            ->withVotes()
            ->get();

        $categories = Category::query()->get();

        return inertia('Loadouts/Index', [
            'loadouts' => LoadoutResource::collection($loadouts),
            'categories' => CategoryResource::collection($categories),
        ]);
    }

    public function create(Gun $gun)
    {
        return inertia('Loadouts/Create', [
            'gun' => new GunResource($gun),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:25'],
            'gun_id' => ['required', 'exists:guns,id'],
            'attachments' => ['required', 'array'],
            'attachments.*' => ['required', 'distinct', 'exists:attachments,id'],
        ]);

        $loadout = $request->user()->loadouts()->create(
            $request->only('name', 'gun_id')
        );

        $loadout->attachments()->attach(
            $request->input('attachments')
        );

        return back();
    }

    public function show(Loadout $loadout)
    {
        return inertia('Loadouts/Show', [
            'loadout' => new LoadoutResource($loadout),
        ]);
    }

    public function update(Request $request, Loadout $loadout)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:25'],
            'gun_id' => ['required', 'exists:guns,id'],
            'attachments' => ['required', 'array'],
            'attachments.*' => ['required', 'distinct', 'exists:attachments,id'],
        ]);

        $loadout->update(
            $request->only('name', 'gun_id')
        );

        $loadout->attachments()->sync(
            $request->input('attachments')
        );

        return back();
    }

    public function destroy(Loadout $loadout)
    {
        $loadout->delete();

        return back();
    }
}
