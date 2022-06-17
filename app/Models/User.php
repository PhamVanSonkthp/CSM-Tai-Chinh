<?php

namespace App\Models;

use App\Traits\UserTrait;
use DateTime;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable implements MustVerifyEmail
{
    use UserTrait;
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;
    use \Awobaz\Compoships\Compoships;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [
//        'is_admin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function gender()
    {
        return $this->belongsTo(GenderUser::class);
    }

    public function presenter(){
        return $this->hasOne(User::class , 'id','referral_id');
    }

    public function role()
    {
        return $this->hasOne(Role::class , 'id','role_id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
    }

    public function walletHistories()
    {
        return $this->hasMany(UserWalletHistory::class, 'user_id', 'id');
    }

    public function checkPermissionAccess($permissionCheck)
    {
        if (optional(auth()->user())->is_admin == 2) return true;

        $roles = optional(auth()->user())->roles;
        foreach ($roles as $role) {
            $permissions = $role->permissions;
            if ($permissions->contains('key_code', $permissionCheck)) {
                return true;
            }
        }
        return false;
    }

    public function requestPaymentWallets(){
        return $this->hasMany(RequestPaymentWallet::class, 'user_id','id');
    }

    public function sendNotification($user_id, $title, $content){
        Notification::createNotification($user_id, $title, $content);
    }

    public function notifications(){
        return $this->hasMany(Notification::class, 'notifiable_id','id');
    }

    public function clients(){
        return $this->hasMany(Lend::class, 'admin_id','id');
    }

    public function status()
    {
        return $this->hasOne(UserStatus::class , 'id','user_status_id');
    }

    public function paymentStatus()
    {
        return $this->hasOne(PaymentStatus::class , 'id','payment_status_id');
    }
}
