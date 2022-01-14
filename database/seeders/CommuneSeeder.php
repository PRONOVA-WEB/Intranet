<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Commune;

class CommuneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \DB::table('communes')->delete();
        $comunas = ["Santiago","Cerrillos","Cerro Navia","Conchalí","El Bosque","Estación Central","Huechuraba","Independencia","La Cisterna","La Florida","La Granja","La Pintana","La Reina","Las Condes","Lo Barnechea","Lo Espejo","Lo Prado","Macul","Maipú","Ñuñoa","Pedro Aguirre Cerda","Peñalolén","Providencia","Pudahuel","Quilicura","Quinta Normal","Recoleta","Renca","San Joaquín","San Miguel","San Ramón","Vitacura","Puente Alto","Pirque","San José De Maipo","Colina","Lampa","Tiltil","San Bernardo","Buin","Calera De Tango","Paine","Melipilla","Alhué","Curacaví","María Pinto","San Pedro","Talagante","El Monte","Isla De Maipo","Padre Hurtado","Peñaflor"];
        foreach ($comunas as $key => $comuna) {
            Commune::create(['name'=>$comuna]);
            \Storage::makeDirectory('health_plan_files/'.$comuna);
        }
    }
}
