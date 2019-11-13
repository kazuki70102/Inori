<?php

namespace App;

use App\Notifications\VerifyEmailNotification;
use App\Notifications\ResetPasswordNotification;
use App\FollowUser;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','role', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    // ユーザー生成時の処理
    protected static function boot()
    {
        parent::boot();

        static::created(function ($user) {
            $user->profile()->create();
        });
    }


    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function followUsers()
    {
        return $this->belongsToMany(self::class, 'follow_users', 'user_id', 'followed_user_id')
            ->using(FollowUser::class);
    }

    // フォローしてるユーザーの取得
    public function getfollowingUsers()
    {
        $data = FollowUser::where('user_id', $this->id)->get();
        $followingUsers = [];

        foreach($data as $line) {
            array_push($followingUsers, User::find($line->followed_user_id));
        }

        return $followingUsers;
    }

    // フォロワーの取得
    public function getfollowers()
    {
        $data = FollowUser::where('followed_user_id', $this->id)->get();
        $followers = [];

        foreach($data as $line) {
            array_push($followers, User::find($line->user_id));
        }

        return $followers;
    }

    public function requestUsers()
    {
        return $this->belongsToMany(self::class, 'request_users', 'user_id', 'requested_user_id')
            ->using(RequestUser::class);
    }

    // リクエストされているユーザーの取得
    public function getrequestedUsers()
    {
        $data = RequestUser::where('requested_user_id', $this->id)->get();
        $requestedUsers = [];

        foreach($data as $line) {
            array_push($requestedUsers, User::find($line->user_id));
        }

        return $requestedUsers;
    }

    public function matchUsers()
    {
        return $this->belongsToMany(self::class, 'match_users', 'driver_id', 'rider_id')
            ->using(MatchUser::class);
    }

    // マッチしてるライダーの取得
    public function getMatchRiders()
    {
        $data = MatchUser::where('driver_id', $this->id)->get();
        $matchRiders = [];

        foreach($data as $line) {
            array_push($matchRiders, User::find($line->rider_id));
        }

        return $matchRiders;
    }

    // マッチしてるドライバーの取得
    public function getMatchDrivers()
    {
        $data = MatchUser::where('rider_id', $this->id)->get();
        $matchDrivers = [];

        foreach($data as $line) {
            array_push($matchDrivers, User::find($line->driver_id));
        }

        return $matchDrivers;
    }


    // パスワードリセットのメール送信
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    // メールアドレス認証のメール
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailNotification);
    }
}
