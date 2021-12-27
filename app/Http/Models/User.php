<?php

namespace App\Http\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    const ROLE_SUPERADMIN = 'ROLE_SUPERADMIN';
    const ROLE_ADMIN = 'ROLE_ADMIN';
    const ROLE_USER = 'ROLE_USER';

    private const ROLES_HIERARCHY = [
      self::ROLE_SUPERADMIN => [self::ROLE_ADMIN],
      self::ROLE_ADMIN => [self::ROLE_USER],
      self::ROLE_USER => []
    ];

    protected $fillable = [
      'name', 'email', 'password',
    ];

    protected $hidden = [
      'password', 'remember_token',
    ];

    protected $casts = [
      'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
      return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
      return [];
    }
    
    public function articles(){
      return $this->hasMany('App\Http\Models\Article');
    }

    public function comments(){
      return $this->hasMany('App\Http\Models\Comment');
    }

    public function categories(){
      return $this->belongsToMany('App\Http\Models\Category')->as('subscriptions')->withTimestamps();
    }

    public function isGranted($role){
      if($role === $this->role){
        return true;
      }
      return self::isRoleInHierarchy($role,self::ROLES_HIERARCHY[$this->role]);
    }

    private static function isRoleInHierarchy($role, $role_hierarchy){
      if(in_array($role, $role_hierarchy)){
        return true;
      }
      foreach($role_hierarchy as $role_included){
        if(self::isRoleInHierarchy($role,self::ROLES_HIERARCHY[$role_included])){
          return true;
        }
      }
      return false;
    }

    public function userable()
    {
      return $this->morphTo();
    }
}
