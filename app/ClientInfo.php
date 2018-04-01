<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientInfo extends Model
{
    protected $fillable = [
        'data_1', 'data_2', 'data_3'
    ];
    
    public function client() {
        return $this->belongsTo(Client::class);
    }
}
