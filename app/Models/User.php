<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table        = 'entity__users';
    protected $fillable     = [
        'user_id',
        'user_name',
        'user_pass',
        'user_fullname',
        'user_image',
        'remember_token',
    ];
    protected $hidden = ['user_pass', 'remember_token'];
    protected $primaryKey   = 'user_id';
    public $timestamps      = false;

    public function getAuthPassword()
    {
        return $this->user_pass;
    }

}
