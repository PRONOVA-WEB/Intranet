<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('settings')->delete();

        \DB::table('settings')->insert(array(
            0 =>
            array(
                'id' => 1,
                'key' => 'site.title',
                'display_name' => 'Título del sitio',
                'value' => 'Control de Turnos HEP',
                'details' => '',
                'type' => 'text',
                'order' => 1,
            ),
            1 =>
            array(
                'id' => 2,
                'key' => 'site.logo',
                'display_name' => 'Logo del sitio',
                'value' => '/images/logo_pronova.jpg',
                'details' => '',
                'type' => 'image',
                'order' => 2,
            ),
            2 =>
            array(
                'id' => 3,
                'key' => 'site.description',
                'display_name' => 'Descripción del sitio',
                'value' => '<h2>Control de Turnos HEP</h2>
                <p>Sistema para gesti&oacute;n de actividades propias de una organizaci&oacute;n de salud. Permite la compartici&oacute;n de recursos digitales entre los miembros de la organizaci&oacute;n, todo bajo un<strong>&nbsp;esquema de seguridad y control</strong> <strong>de acceso</strong>&nbsp;que asegura que cada persona puede ver &uacute;nicamente lo que le corresponde.</p>',
                'details' => '',
                'type' => 'rich_text_box',
                'order' => 3,
            ),
            3 =>
            array(
                'id' => 4,
                'key' => 'site.phrase_day',
                'display_name' => 'Frase del día',
                'value' => 'Hoy es el día',
                'details' => '',
                'type' => 'text',
                'order' => 4,
            ),
            4 =>
            array(
                'id' => 5,
                'key' => 'site.external_description',
                'display_name' => 'Descripción de módulo externo',
                'value' => '<div class="mt-3">
                <h1>Reclutamiento y Selecci&oacute;n</h1>
                <div>
                <div>Ingresa tus antecedentes curriculares para postular al <strong>Staff de Reemplazos</strong> de la Unidad de Reclutamiento y Selecci&oacute;n.</div>
                </div>
                </div>',
                'details' => 'Texto que se muestra en el home del sitio para externos',
                'type' => 'rich_text_box',
                'order' => 5,
            ),
            5 =>
            array(
                'id' => 6,
                'key' => 'site.organization',
                'display_name' => 'Nombre de la organización',
                'value' => 'Hospital El Pino',
                'details' => 'Nombre de la organización',
                'type' => 'text',
                'order' => 6,
            ),
            6 =>
            array(
                'id' => 7,
                'key' => 'site.phone',
                'display_name' => 'Teléfono de contacto',
                'value' => '+56 999999999',
                'details' => 'Teléfono de contacto',
                'type' => 'text',
                'order' => 7,
            )
        ));
    }
}
