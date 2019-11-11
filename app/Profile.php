<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [];


    public function profileImage()
    {
        $imagePath = ($this->image) ? $this->image : 'profile/noimage.png';
        return '/storage/' . $imagePath;
    }

    public function user()
    {
        return $this->belongTo(User::class);
    }
}
