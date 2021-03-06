<?php

namespace App;

use App\Client;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    
    public function clientReserve(Client $client) {
        $checkReserve = $client->with('info')
                          ->where('user_id', $this->id)                
                          ->first();
        if($checkReserve){
            return $checkReserve;
        }
        return false;
    }
}
