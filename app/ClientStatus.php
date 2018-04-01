<?php

namespace App;

use App\Client;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ClientStatus {
    
    protected $client;
    protected $statusId;

    public function __construct($client) {
        $this->client = $client;
        $this->carbon = new Carbon;
    }
    
    public function apply() {
        $methodName = 'status'.$this->client->status;
        if(method_exists($this, $methodName)) {
            $this->$methodName();
        }
    }
    
    // Статус "Занято"
    public function status2() {
        $timeout = config('client.call_timeout.'.$this->client->status);
        $result = $this->carbon->addMinute($timeout);
        $this->client->timeout = $result;
        
        return $this->client;
    }
    
    // Статус "Нет ответа"
    public function status3() {
        $timeout = config('client.call_timeout.'.$this->client->status);
        $result = $this->carbon->addMinute($timeout);
        $this->client->timeout = $result;
        
        return $this->client;        
    }

}
