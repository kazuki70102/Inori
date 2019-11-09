<?php

namespace App\Services;

use App\User;
use App\MatchUser;

class MatchService
{
    public function getMatchId($user)
    {
        $userId = auth()->user()->id;
        $partnerId = $user->id;
        return MatchUser::where('driver_id', $userId)
                        ->where('rider_id', $partnerId)
                        ->orWhere(function($query) use($userId, $partnerId) {
                            $query->where('driver_id', $partnerId)
                                ->where('rider_id', $userId);
                        })
                        ->first()
                        ->id;
    }
}

?>
