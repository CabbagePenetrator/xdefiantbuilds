<?php

namespace App\Http\Controllers;

use App\Models\Loadout;
use Illuminate\Http\Request;

class UpvoteLoadoutController extends Controller
{
    public function __invoke(Request $request, Loadout $loadout)
    {
        $existingVote = $loadout->upvotes()
            ->where('user_id', $request->user()->id)
            ->first();

        if ($existingVote) {
            $existingVote->delete();
        } else {
            $loadout->votes()->create([
                'user_id' => $request->user()->id,
                'is_upvote' => true,
            ]);
        }

        return back();
    }
}
