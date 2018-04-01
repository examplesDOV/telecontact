<?php

namespace App;

use App\Client;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ClientTimeout {
    
    protected $client;
    protected $statusId;

    public function __construct($client) {
        $this->client = $client;
        $this->carbon = new Carbon;
    }
    
    public function apply() {
        if(array_key_exists($this->client->status, config('client.call_timeout'))) {
            $this->setAutoTimeout();
        }
    }
  
    protected function setAutoTimeout() {        
        $timeout = config('client.call_timeout.'.$this->client->status);
        $result = $this->carbon->addMinute($timeout);
        $this->client->timeout = $result;
        
        return $this->client;     
    }

}
