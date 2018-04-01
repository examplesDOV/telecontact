<?php

use App\Client;
use App\ClientInfo;
use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ClientInfo::truncate();
        Client::truncate();        
        
        factory(Client::class, 7)->create()->each(function($client) {
            factory(ClientInfo::class)->create([
                'client_id' => $client->id,
            ]);
        });
    }
}
