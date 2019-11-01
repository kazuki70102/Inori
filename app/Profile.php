<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [];


    public function profileImage()
    {
        $imagePath = ($this->image) ? $this->image : '/profile/6OXZCVZQBvrzhtA8QB1zQpvjXMISP3uLE8SH8ffR.png';
        return '/storage/' . $imagePath;
    }

    public function user()
    {
        return $this->belongTo(User::class);
    }
}
