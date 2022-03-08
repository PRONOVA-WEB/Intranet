<?php

namespace Database\Seeders;

use App\Parameters\Parameter;
use Illuminate\Database\Seeder;

class ParameterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $parameter = Parameter::Create([
            'module'=>'drugs',
            'parameter'=>'Jefe',
            'value'=>12345678,
            'description'=>'RUN (sin digito verificador) del encargado de la Unidad de Drogas']);

        $parameter = Parameter::Create([
            'module'=>'drugs',
            'parameter'=>'CargoJefe',
            'value'=>'Jefe Unidad de Drogas',
            'description'=>'Cargo del encargado de la Unidad de Drogas']);

        $parameter = Parameter::Create([
            'module'=>'drugs',
            'parameter'=>'Mandatado',
            'value'=>12345678,
            'description'=>'RUN (sin digito verificador) del mandatado']);

        $parameter = Parameter::Create([
            'module'=>'drugs',
            'parameter'=>'MandatadoResolucion',
            'value'=>'resolución exenta Nº 903, de 06 de Junio de 2014',
            'description'=>'Resolución y su fecha']);

        $parameter = Parameter::Create([
            'module'=>'drugs',
            'parameter'=>'MinistroDeFe',
            'value'=>12345678,
            'description'=>'Run (sin digito verificador) del ministro de Fe']);

        $parameter = Parameter::Create([
            'module'=>'drugs',
            'parameter'=>'MinistroDeFeJuridico',
            'value'=>12345678,
            'description'=>'Run (sin digito verificador) del ministro de Fe']);
    }
}
