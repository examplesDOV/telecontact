<?php

namespace App;

use Auth;
use Carbon\Carbon;
use App\ClientInfo;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    
    public $timestamps = false;
    
    protected $fillable = [
        'status', 'timeout'
    ];

    public function info() {
        return $this->hasOne(ClientInfo::class);
    }
    
    public function reserve($switch) {
       
        $this->user_id = ($switch) ? Auth::user()->id : NULL;
        $this->reserved_time = ($switch) ? Carbon::now() : NULL;
        $this->save();
    }
    

    public function getById($id) {
        return $this->find($id);
    }

    

    public function getFree() {
        return $this->with('info')                        
                      ->whereIn('status', [0, 2, 3, 4])
                      ->where(function ($query) {
                        $query->where('timeout', '<', Carbon::now())
                              ->orWhereNull('timeout');
                        })
                      ->where('user_id', NULL)
                      ->orderBy('status')
                      ->first(); 
    }
    
}
