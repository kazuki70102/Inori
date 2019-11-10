<?php

namespace App\Services;

use App\User;
use App\MatchUser;

class MatchService
{
    public function getMatchId($user)
    {
        $userId = auth()->user()->id;
        $matchUserId = $user->id;
        return MatchUser::where('driver_id', $userId)
                        ->where('rider_id', $matchUserId)
                        ->orWhere(function($query) use($userId, $matchUserId) {
                            $query->where('driver_id', $matchUserId)
                                ->where('rider_id', $userId);
                        })
                        ->first()
                        ->id;
    }
}

?>
