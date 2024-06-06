<?php

namespace App\Http\Controllers;

use App\Http\Resources\LoadoutResource;
use App\Models\Loadout;
use Illuminate\Http\Request;

class LoadoutController extends Controller
{
    public function index()
    {
        $loadouts = Loadout::query()->get();

        return inertia('Loadouts/Index', [
            'loadouts' => LoadoutResource::collection($loadouts),
        ]);
    }

    public function store(Request $request)
    {
        Loadout::create(
            $request->validate([
                'name' => ['required', 'string', 'max:25'],
            ])
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
        $loadout->update(
            $request->validate([
                'name' => ['required', 'string', 'max:25'],
            ])
        );

        return back();
    }

    public function destroy(Loadout $loadout)
    {
        $loadout->delete();

        return back();
    }
}
