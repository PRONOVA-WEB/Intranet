<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DocTemplatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('doc_templates')->delete();

        \DB::table('doc_templates')->insert(array(
            0 =>
            array(
                'id' => 1,
                'type' => 'Documento en blanco',
                'prefix' => '',
                'body' => '',
                'description' => 'Documento en blanco',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now()
            ),
            1 =>
            array(
                'id' => 2,
                'type' => 'Acta de Entrega',
                'prefix' => 'AE',
                'body' => '<h1 style="text-align: center; text-decoration: underline;">ACTA DE ENTREGA</h1>
                <p><strong>Datos de ubicaci&oacute;n</strong></p>
                <table style="width: 100%; border-collapse: collapse;" border="1" cellpadding="2">
                <tbody>
                <tr>
                <td style="width: 30%; height: 30px;">Establecimiento</td>
                <td>&nbsp;</td>
                </tr>
                <tr>
                <td style="width: 30%; height: 30px;">Direcci&oacute;n</td>
                <td>&nbsp;</td>
                </tr>
                <tr>
                <td style="width: 30%; height: 30px;">Unidad Organizacional</td>
                <td>&nbsp;</td>
                </tr>
                <tr>
                <td style="width: 30%; height: 30px;">Ubicaci&oacute;n (oficina)</td>
                <td>&nbsp;</td>
                </tr>
                </tbody>
                </table>
                <p><strong>Caracter&iacute;sticas de la especie</strong></p>
                <table style="width: 100%; border-collapse: collapse;" border="1" cellpadding="2">
                <tbody>
                <tr>
                <td style="width: 30%; height: 30px;">Inventario</td>
                <td>&nbsp;</td>
                </tr>
                <tr>
                <td style="width: 30%; height: 30px;">Tipo de equipo</td>
                <td>&nbsp;</td>
                </tr>
                <tr>
                <td style="width: 30%; height: 30px;">Marca</td>
                <td>&nbsp;</td>
                </tr>
                <tr>
                <td style="width: 30%; height: 30px;">Modelo</td>
                <td>&nbsp;</td>
                </tr>
                <tr>
                <td style="width: 30%; height: 30px;">N&uacute;mero de serie</td>
                <td>&nbsp;</td>
                </tr>
                </tbody>
                </table>
                <p><strong>Responsable</strong></p>
                <table style="width: 100%; border-collapse: collapse;" border="1" cellpadding="2">
                <tbody>
                <tr>
                <td style="width: 30%; height: 30px;">Nombre completo</td>
                <td>&nbsp;</td>
                </tr>
                <tr>
                <td style="width: 30%; height: 30px;">Funci&oacute;n / cargo</td>
                <td>&nbsp;</td>
                </tr>
                </tbody>
                </table>',
                'description' => 'Plantilla de acta de entrega',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now()
            ),
            2 =>
            array(
                'id' => 3,
                'type' => 'Circular',
                'prefix' => 'CR',
                'body' => '<h1 style="text-align: center; text-decoration: underline;">Circular</h1>
                ',
                'description' => 'Plantilla de circular',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now()
            ),
            3 =>
            array(
                'id' => 4,
                'type' => 'Memo',
                'prefix' => 'MM',
                'body' => '<h1 style="text-align: center; text-decoration: underline;">Memo</h1>
                ',
                'description' => 'Plantilla de Memo',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now()
            ),
            4 =>
            array(
                'id' => 5,
                'type' => 'Resolución',
                'prefix' => 'RS',
                'body' => '<h1 style="text-align: center; text-decoration: underline;">Resolución</h1>
                ',
                'description' => 'Plantilla de Resolución',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now()
            )
        ));
    }
}
