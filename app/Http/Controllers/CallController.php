<?php

namespace App\Http\Controllers;

use Auth;
use App\Client;
use App\ClientStatus;
use App\Http\Requests\ClientUpdatePost;
use Illuminate\Http\Request;

class CallController extends Controller
{
    public function call(Client $client) {
        
        $reserve = Auth::user()->clientReserve($client);

        if($reserve) {
            return view('call.client', ['client' => $reserve]);    
        }
        
        // Возможно, стоит обернуть в транзакцию...
        // DB::beginTransaction();
        $client = $client->getFree();
        
        if (!$client) {
            return view('call.client', ['client' => null]);
        }
        
        $client->reserve(true);
        // DB::commit();
        
        return view('call.client', [
            'client' => $client
        ]);
        
    }
    
    public function update(Client $client, ClientUpdatePost $request) {
        

        $client = $client->getById($request->id); 

        if(!$client) {
            return back()->withInput();
        }
        
        $client->update($request->all());
        $client->info->update($request->info);

        (new ClientStatus($client))->apply();        

        $client->reserve(false);
        
        return redirect()->route('client.call');        
    }
    
    public function pause(Client $client){
        
        $client = Auth::user()->clientReserve($client);
        $client->reserve(false);
        
        return redirect()->route('home');
    }

    
}
