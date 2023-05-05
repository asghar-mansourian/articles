<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VoteController extends Controller
{
    public function __invoke(Request $request)
    {
        DB::transaction(function () use ($request) {
            // Check if the user has already liked or disliked the comment
            $previousReaction = Vote::where('modelable_id',$request->modelable_id)
                ->where('modelable_type',$request->modelable_type)
                ->where('user_id',auth()->user()->id)
                ->first();

            // If the user has already liked or disliked the comment
            if ($previousReaction) {
                // If the user's previous reaction matches the current operation, do nothing
                if ($previousReaction->type === $request->type) {
                    // If the user's previous reaction match the current operation, delete the reaction
                    $previousReaction->delete();
                    return;
                }
                //if previous reaction does not math update reaction
                $previousReaction->update(['type' => $request->type]);
                return;
            }
            // Create a new reaction for the user and comment
            Vote::create([
                'user_id' => auth()->user()->id,
                'modelable_type' => $request->modelable_type,
                'modelable_id' => $request->modelable_id,
                'type' => $request->type
            ]);
        });

        return response()->json('success');
    }
}
