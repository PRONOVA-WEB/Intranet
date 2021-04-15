<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\ServiceRequests\ServiceRequest;

class addProfessionId extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add_profession_ids';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
      $serviceRequests = ServiceRequest::all();
      foreach ($serviceRequests as $key => $serviceRequest) {
        $profession_id = null;
        switch ($serviceRequest->rrhh_team) {
          case 'Administrativo Diurno':
            $profession_id = 26;
            break;
          case 'Administrativo Turno':
            $profession_id = 26;
            break;
          case 'Auxiliar Diurno':
            $profession_id = 27;
            break;
          case 'Auxiliar Turno':
            $profession_id = 27;
            break;
          case 'Bioquímico':
            $profession_id = 15;
            break;
          case 'Biotecnólogo Turno':
            $profession_id = 16;
            break;
          case 'Enfermera Diurna':
            $profession_id = 4;
            break;
          case 'Enfermera Supervisora':
            $profession_id = 4;
            break;
          case 'Enfermera Turno':
            $profession_id = 4;
            break;
          case 'Fonoaudiologo':
            $profession_id = 11;
            break;
          case 'Kinesiólogo Diurno':
            $profession_id = 7;
            break;
          case 'Kinesiólogo Turno':
            $profession_id = 7;
            break;
          case 'Kinesiólogo Turno':
            $profession_id = 7;
            break;
          case 'Matrona Diurno':
            $profession_id = 5;
            break;
          case 'Matrona Turno':
            $profession_id = 5;
            break;
          case 'Médico Diurno':
            $profession_id = 1;
            break;
          case 'Nutricionista Diurno':
            $profession_id = 8;
            break;
          case 'Nutricionista turno':
            $profession_id = 8;
            break;
          case 'Otros técnicos':
            $profession_id = 24;
            break;
          case 'Prevencionista de Riesgo':
            $profession_id = 12;
            break;
          case 'Psicólogo':
            $profession_id = 6;
            break;
          case 'Químico Farmacéutico':
            $profession_id = 3;
            break;
          case 'Residencia Médica':
            $profession_id = 1;
            break;
          case 'Téc.Paramédicos Diurno':
            $profession_id = 25;
            break;
          case 'Téc.Paramédicos Turno':
            $profession_id = 25;
            break;
          case 'Téc.Paramédicos Turno':
            $profession_id = 25;
            break;
          case 'Tecn. Médico Diurno':
            $profession_id = 13;
            break;
          case 'Tecn. Médico Turno':
            $profession_id = 13;
            break;
          case 'Terapeuta Ocupacional':
            $profession_id = 10;
            break;
          case 'Trabajador Social':
            $profession_id = 9;
            break;
        }
        $serviceRequest->profession_id = $profession_id;
        $serviceRequest->save();
        print_r($serviceRequest->id . "\n");
      }

      return 0;
    }
}
