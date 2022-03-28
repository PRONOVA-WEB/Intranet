<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Documents\Summaries\SummaryStatus;

class SummaryStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $summaryStatus = SummaryStatus::Create(['name'=>'Apertura inicial', 'granted_days'=>3]);
        $summaryStatus = SummaryStatus::Create(['name'=>'Notificación al fiscal', 'granted_days'=>4]);
        $summaryStatus = SummaryStatus::Create(['name'=>'Formulación de cargos', 'granted_days'=>5]);
        $summaryStatus = SummaryStatus::Create(['name'=>'Solicita sobreseimiento', 'granted_days'=>5]);
        $summaryStatus = SummaryStatus::Create(['name'=>'Prorroga', 'granted_days'=>3]);
        $summaryStatus = SummaryStatus::Create(['name'=>'Cerrar el sumario', 'granted_days'=>2]);
        $summaryStatus = SummaryStatus::Create(['name'=>'Reapertura', 'granted_days'=>10]);
    }
}
