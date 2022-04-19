<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ServiceRequests\Fulfillment;
use Carbon\Carbon;

class FulfillmentSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */

    public function run()
    {
        Fulfillment::create([
            'service_request_id' => '1',
            'year' => '2022',
            'month' => '4',
            'type' => 'Mensual',
            'start_date' => '2022-04-01 00:00:00',
            'end_date' => '2022-04-31 00:00:00',
            'user_id' => '12345678',
            'created_at' => carbon::now(),
            'updated_at' => carbon::now()
        ]);

        Fulfillment::create([
            'service_request_id' => '1',
            'year' => '2022',
            'month' => '5',
            'type' => 'Mensual',
            'start_date' => '2022-05-01 00:00:00',
            'end_date' => '2022-05-30 00:00:00',
            'user_id' => '12345678',
            'created_at' => carbon::now(),
            'updated_at' => carbon::now()
        ]);

    }
}
