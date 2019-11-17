<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [];


    public function profileImage()
    {
        $imagePath = ($this->image) ? $this->image : 'https://inori-app.s3-ap-northeast-1.amazonaws.com/myimage/noimage.png';
        return $imagePath;
    }

    public function user()
    {
        return $this->belongTo(User::class);
    }
}
