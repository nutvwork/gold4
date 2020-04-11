<?php

namespace App;

use App\Notifications\ResetPasswordNoti;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'password', 'provider', 'verified',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sendPasswordResetNotification($token) {
        $this->notify(new ResetPasswordNoti($token));
    }

    public function roles() {
        return $this->belongsToMany(Role::class);
    }

    public function authorizeRoles($roles) {
        if (is_array($roles)) {
            return $this->hasAnyRole($roles);
        }
        return $this->hasRole($roles);
    }

    public function hasAnyRole($roles) {
        return null !== $this->roles()->whereIn('name', $roles)->first();
    }

    public function hasRole($role) {
        return null !== $this->roles()->where('name', $role)->first();
    }

    public function isAdmin() {
        return $this->hasRole('admin');
    }

    public function getProviderAttribute($value) {
        switch ($value) {
            case 0:
                return 'email';
                break;
            case 1:
                return 'facebook';
                break;
            default:
                return 'email';
                break;
        }
    }
}
