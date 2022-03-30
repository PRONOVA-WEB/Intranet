<?php

namespace Database\Seeders;

use App\User;
use Illuminate\Database\Seeder;

class ShiftUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::factory()->count(200)->create()->each(function($user) {
            $userFirst = User::find(12345678);
            for ($i=1; $i < 13 ; $i++) {
                $endOfMonth = \Carbon\Carbon::parse('2022-'.$i.'-01')->endOfMonth()->format('d');
                $ShiftUser = \App\Models\Rrhh\ShiftUser::create([
                    'date_from' => '2022-'.$i.'-01',
                    'date_up' => '2022-'.$i.'-'.$endOfMonth,
                    'asigned_by' => '12345678',
                    'user_id' => $user->id,
                    'shift_types_id' => rand(1,4),
                    'organizational_units_id'=> '16'
               ]);
               $nUser = User::find($ShiftUser->user_id);
               $s = 0;
               for ($d=1; $d <= $endOfMonth; $d++) {
                    $actuallyShift = \App\Models\Rrhh\ShiftTypes::find( $ShiftUser->shift_types_id );
                    $currentSeries =  explode(",", $actuallyShift->day_series);
                    //$starDay = rand(1,7);
                    $working_day = $currentSeries[$s];

                    $ShiftUserDay = \App\Models\Rrhh\ShiftUserDay::create([
                        'day' => '2022-'.$i.'-'.$d,
                        'commentary' => '// Automatically added by the shift '.$ShiftUser->id.'//',
                        'status' => '1',
                        'shift_user_id' => $ShiftUser->id,
                        'working_day' => $working_day,
                    ]);

                    $nHistory = new \App\Models\Rrhh\ShiftDayHistoryOfChanges;
                    $nHistory->commentary = "El usuario \"".$userFirst->name." ". $userFirst->fathers_family." ". $userFirst->mothers_family."\" ha <b>asignado la jornada</b> del \"".'2022-'.$i.'-'.$d."\" de tipo  \"".$working_day."\" al usuario ID: \"". $nUser->runFormat() ."\" - ".$nUser->name." ".$nUser->fathers_family." ".$nUser->mothers_family;
                    $nHistory->shift_user_day_id = $ShiftUserDay->id;
                    $nHistory->modified_by = $userFirst->id;
                    $nHistory->change_type = 0;//0_asignado 1:cambio estado, 2 cambio de tipo de jornada, 3 intercambio con otro usuario
                    $nHistory->day = '2022-'.$i.'-'.$d;
                    $nHistory->previous_value = "";
                    $nHistory->current_value = "1";
                    $nHistory->save();

                    if ($s < 6) {
                        $s++;
                    }
                    else
                    {
                        $s = 0;
                    }
               }
           }

        });
    }
}
