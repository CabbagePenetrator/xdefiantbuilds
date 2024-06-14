<?php

namespace App\Http\Controllers;

use App\Models\Loadout;
use Illuminate\Http\Request;

class DownvoteLoadoutController extends Controller
{
    public function __invoke(Request $request, Loadout $loadout)
    {
        $existingVote = $loadout->downvotes()
            ->where('user_id', $request->user()->id)
            ->first();

        if ($existingVote) {
            $existingVote->delete();
        } else {
            $loadout->votes()->create([
                'user_id' => $request->user()->id,
                'is_upvote' => false,
            ]);
        }

        return back();
    }
}
