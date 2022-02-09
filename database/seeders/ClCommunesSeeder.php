<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ClCommunesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('cl_communes')->delete();

        \DB::table('cl_communes')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Arica',
                'region_id' => 1,
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'Camarones',
                'region_id' => 1,
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'General Lagos',
                'region_id' => 1,
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'Putre',
                'region_id' => 1,
            ),
            4 =>
            array (
                'id' => 5,
                'name' => 'Alto Hospicio',
                'region_id' => 2,
            ),
            5 =>
            array (
                'id' => 6,
                'name' => 'Iquique',
                'region_id' => 2,
            ),
            6 =>
            array (
                'id' => 7,
                'name' => 'Camiña',
                'region_id' => 2,
            ),
            7 =>
            array (
                'id' => 8,
                'name' => 'Colchane',
                'region_id' => 2,
            ),
            8 =>
            array (
                'id' => 9,
                'name' => 'Huara',
                'region_id' => 2,
            ),
            9 =>
            array (
                'id' => 10,
                'name' => 'Pica',
                'region_id' => 2,
            ),
            10 =>
            array (
                'id' => 11,
                'name' => 'Pozo Almonte',
                'region_id' => 2,
            ),
            11 =>
            array (
                'id' => 12,
                'name' => 'Antofagasta',
                'region_id' => 3,
            ),
            12 =>
            array (
                'id' => 13,
                'name' => 'Mejillones',
                'region_id' => 3,
            ),
            13 =>
            array (
                'id' => 14,
                'name' => 'Sierra Gorda',
                'region_id' => 3,
            ),
            14 =>
            array (
                'id' => 15,
                'name' => 'Taltal',
                'region_id' => 3,
            ),
            15 =>
            array (
                'id' => 16,
                'name' => 'Calama',
                'region_id' => 3,
            ),
            16 =>
            array (
                'id' => 17,
                'name' => 'Ollague',
                'region_id' => 3,
            ),
            17 =>
            array (
                'id' => 18,
                'name' => 'San Pedro de Atacama',
                'region_id' => 3,
            ),
            18 =>
            array (
                'id' => 19,
                'name' => 'María Elena',
                'region_id' => 3,
            ),
            19 =>
            array (
                'id' => 20,
                'name' => 'Tocopilla',
                'region_id' => 3,
            ),
            20 =>
            array (
                'id' => 21,
                'name' => 'Chañaral',
                'region_id' => 4,
            ),
            21 =>
            array (
                'id' => 22,
                'name' => 'Diego de Almagro',
                'region_id' => 4,
            ),
            22 =>
            array (
                'id' => 23,
                'name' => 'Caldera',
                'region_id' => 4,
            ),
            23 =>
            array (
                'id' => 24,
                'name' => 'Copiapó',
                'region_id' => 4,
            ),
            24 =>
            array (
                'id' => 25,
                'name' => 'Tierra Amarilla',
                'region_id' => 4,
            ),
            25 =>
            array (
                'id' => 26,
                'name' => 'Alto del Carmen',
                'region_id' => 4,
            ),
            26 =>
            array (
                'id' => 27,
                'name' => 'Freirina',
                'region_id' => 4,
            ),
            27 =>
            array (
                'id' => 28,
                'name' => 'Huasco',
                'region_id' => 4,
            ),
            28 =>
            array (
                'id' => 29,
                'name' => 'Vallenar',
                'region_id' => 4,
            ),
            29 =>
            array (
                'id' => 30,
                'name' => 'Canela',
                'region_id' => 5,
            ),
            30 =>
            array (
                'id' => 31,
                'name' => 'Illapel',
                'region_id' => 5,
            ),
            31 =>
            array (
                'id' => 32,
                'name' => 'Los Vilos',
                'region_id' => 5,
            ),
            32 =>
            array (
                'id' => 33,
                'name' => 'Salamanca',
                'region_id' => 5,
            ),
            33 =>
            array (
                'id' => 34,
                'name' => 'Andacollo',
                'region_id' => 5,
            ),
            34 =>
            array (
                'id' => 35,
                'name' => 'Coquimbo',
                'region_id' => 5,
            ),
            35 =>
            array (
                'id' => 36,
                'name' => 'La Higuera',
                'region_id' => 5,
            ),
            36 =>
            array (
                'id' => 37,
                'name' => 'La Serena',
                'region_id' => 5,
            ),
            37 =>
            array (
                'id' => 38,
                'name' => 'Paihuaco',
                'region_id' => 5,
            ),
            38 =>
            array (
                'id' => 39,
                'name' => 'Vicuña',
                'region_id' => 5,
            ),
            39 =>
            array (
                'id' => 40,
                'name' => 'Combarbalá',
                'region_id' => 5,
            ),
            40 =>
            array (
                'id' => 41,
                'name' => 'Monte Patria',
                'region_id' => 5,
            ),
            41 =>
            array (
                'id' => 42,
                'name' => 'Ovalle',
                'region_id' => 5,
            ),
            42 =>
            array (
                'id' => 43,
                'name' => 'Punitaqui',
                'region_id' => 5,
            ),
            43 =>
            array (
                'id' => 44,
                'name' => 'Río Hurtado',
                'region_id' => 5,
            ),
            44 =>
            array (
                'id' => 45,
                'name' => 'Isla de Pascua',
                'region_id' => 6,
            ),
            45 =>
            array (
                'id' => 46,
                'name' => 'Calle Larga',
                'region_id' => 6,
            ),
            46 =>
            array (
                'id' => 47,
                'name' => 'Los Andes',
                'region_id' => 6,
            ),
            47 =>
            array (
                'id' => 48,
                'name' => 'Rinconada',
                'region_id' => 6,
            ),
            48 =>
            array (
                'id' => 49,
                'name' => 'San Esteban',
                'region_id' => 6,
            ),
            49 =>
            array (
                'id' => 50,
                'name' => 'La Ligua',
                'region_id' => 6,
            ),
            50 =>
            array (
                'id' => 51,
                'name' => 'Papudo',
                'region_id' => 6,
            ),
            51 =>
            array (
                'id' => 52,
                'name' => 'Petorca',
                'region_id' => 6,
            ),
            52 =>
            array (
                'id' => 53,
                'name' => 'Zapallar',
                'region_id' => 6,
            ),
            53 =>
            array (
                'id' => 54,
                'name' => 'Hijuelas',
                'region_id' => 6,
            ),
            54 =>
            array (
                'id' => 55,
                'name' => 'La Calera',
                'region_id' => 6,
            ),
            55 =>
            array (
                'id' => 56,
                'name' => 'La Cruz',
                'region_id' => 6,
            ),
            56 =>
            array (
                'id' => 57,
                'name' => 'Limache',
                'region_id' => 6,
            ),
            57 =>
            array (
                'id' => 58,
                'name' => 'Nogales',
                'region_id' => 6,
            ),
            58 =>
            array (
                'id' => 59,
                'name' => 'Olmué',
                'region_id' => 6,
            ),
            59 =>
            array (
                'id' => 60,
                'name' => 'Quillota',
                'region_id' => 6,
            ),
            60 =>
            array (
                'id' => 61,
                'name' => 'Algarrobo',
                'region_id' => 6,
            ),
            61 =>
            array (
                'id' => 62,
                'name' => 'Cartagena',
                'region_id' => 6,
            ),
            62 =>
            array (
                'id' => 63,
                'name' => 'El Quisco',
                'region_id' => 6,
            ),
            63 =>
            array (
                'id' => 64,
                'name' => 'El Tabo',
                'region_id' => 6,
            ),
            64 =>
            array (
                'id' => 65,
                'name' => 'San Antonio',
                'region_id' => 6,
            ),
            65 =>
            array (
                'id' => 66,
                'name' => 'Santo Domingo',
                'region_id' => 6,
            ),
            66 =>
            array (
                'id' => 67,
                'name' => 'Catemu',
                'region_id' => 6,
            ),
            67 =>
            array (
                'id' => 68,
                'name' => 'Llaillay',
                'region_id' => 6,
            ),
            68 =>
            array (
                'id' => 69,
                'name' => 'Panquehue',
                'region_id' => 6,
            ),
            69 =>
            array (
                'id' => 70,
                'name' => 'Putaendo',
                'region_id' => 6,
            ),
            70 =>
            array (
                'id' => 71,
                'name' => 'San Felipe',
                'region_id' => 6,
            ),
            71 =>
            array (
                'id' => 72,
                'name' => 'Santa María',
                'region_id' => 6,
            ),
            72 =>
            array (
                'id' => 73,
                'name' => 'Casablanca',
                'region_id' => 6,
            ),
            73 =>
            array (
                'id' => 74,
                'name' => 'Concón',
                'region_id' => 6,
            ),
            74 =>
            array (
                'id' => 75,
                'name' => 'Juan Fernández',
                'region_id' => 6,
            ),
            75 =>
            array (
                'id' => 76,
                'name' => 'Puchuncaví',
                'region_id' => 6,
            ),
            76 =>
            array (
                'id' => 77,
                'name' => 'Quilpué',
                'region_id' => 6,
            ),
            77 =>
            array (
                'id' => 78,
                'name' => 'Quintero',
                'region_id' => 6,
            ),
            78 =>
            array (
                'id' => 79,
                'name' => 'Valparaíso',
                'region_id' => 6,
            ),
            79 =>
            array (
                'id' => 80,
                'name' => 'Villa Alemana',
                'region_id' => 6,
            ),
            80 =>
            array (
                'id' => 81,
                'name' => 'Viña del Mar',
                'region_id' => 6,
            ),
            81 =>
            array (
                'id' => 82,
                'name' => 'Colina',
                'region_id' => 7,
            ),
            82 =>
            array (
                'id' => 83,
                'name' => 'Lampa',
                'region_id' => 7,
            ),
            83 =>
            array (
                'id' => 84,
                'name' => 'Tiltil',
                'region_id' => 7,
            ),
            84 =>
            array (
                'id' => 85,
                'name' => 'Pirque',
                'region_id' => 7,
            ),
            85 =>
            array (
                'id' => 86,
                'name' => 'Puente Alto',
                'region_id' => 7,
            ),
            86 =>
            array (
                'id' => 87,
                'name' => 'San José de Maipo',
                'region_id' => 7,
            ),
            87 =>
            array (
                'id' => 88,
                'name' => 'Buin',
                'region_id' => 7,
            ),
            88 =>
            array (
                'id' => 89,
                'name' => 'Calera de Tango',
                'region_id' => 7,
            ),
            89 =>
            array (
                'id' => 90,
                'name' => 'Paine',
                'region_id' => 7,
            ),
            90 =>
            array (
                'id' => 91,
                'name' => 'San Bernardo',
                'region_id' => 7,
            ),
            91 =>
            array (
                'id' => 92,
                'name' => 'Alhué',
                'region_id' => 7,
            ),
            92 =>
            array (
                'id' => 93,
                'name' => 'Curacaví',
                'region_id' => 7,
            ),
            93 =>
            array (
                'id' => 94,
                'name' => 'María Pinto',
                'region_id' => 7,
            ),
            94 =>
            array (
                'id' => 95,
                'name' => 'Melipilla',
                'region_id' => 7,
            ),
            95 =>
            array (
                'id' => 96,
                'name' => 'San Pedro',
                'region_id' => 7,
            ),
            96 =>
            array (
                'id' => 97,
                'name' => 'Cerrillos',
                'region_id' => 7,
            ),
            97 =>
            array (
                'id' => 98,
                'name' => 'Cerro Navia',
                'region_id' => 7,
            ),
            98 =>
            array (
                'id' => 99,
                'name' => 'Conchalí',
                'region_id' => 7,
            ),
            99 =>
            array (
                'id' => 100,
                'name' => 'El Bosque',
                'region_id' => 7,
            ),
            100 =>
            array (
                'id' => 101,
                'name' => 'Estación Central',
                'region_id' => 7,
            ),
            101 =>
            array (
                'id' => 102,
                'name' => 'Huechuraba',
                'region_id' => 7,
            ),
            102 =>
            array (
                'id' => 103,
                'name' => 'Independencia',
                'region_id' => 7,
            ),
            103 =>
            array (
                'id' => 104,
                'name' => 'La Cisterna',
                'region_id' => 7,
            ),
            104 =>
            array (
                'id' => 105,
                'name' => 'La Granja',
                'region_id' => 7,
            ),
            105 =>
            array (
                'id' => 106,
                'name' => 'La Florida',
                'region_id' => 7,
            ),
            106 =>
            array (
                'id' => 107,
                'name' => 'La Pintana',
                'region_id' => 7,
            ),
            107 =>
            array (
                'id' => 108,
                'name' => 'La Reina',
                'region_id' => 7,
            ),
            108 =>
            array (
                'id' => 109,
                'name' => 'Las Condes',
                'region_id' => 7,
            ),
            109 =>
            array (
                'id' => 110,
                'name' => 'Lo Barnechea',
                'region_id' => 7,
            ),
            110 =>
            array (
                'id' => 111,
                'name' => 'Lo Espejo',
                'region_id' => 7,
            ),
            111 =>
            array (
                'id' => 112,
                'name' => 'Lo Prado',
                'region_id' => 7,
            ),
            112 =>
            array (
                'id' => 113,
                'name' => 'Macul',
                'region_id' => 7,
            ),
            113 =>
            array (
                'id' => 114,
                'name' => 'Maipú',
                'region_id' => 7,
            ),
            114 =>
            array (
                'id' => 115,
                'name' => 'Ñuñoa',
                'region_id' => 7,
            ),
            115 =>
            array (
                'id' => 116,
                'name' => 'Pedro Aguirre Cerda',
                'region_id' => 7,
            ),
            116 =>
            array (
                'id' => 117,
                'name' => 'Peñalolén',
                'region_id' => 7,
            ),
            117 =>
            array (
                'id' => 118,
                'name' => 'Providencia',
                'region_id' => 7,
            ),
            118 =>
            array (
                'id' => 119,
                'name' => 'Pudahuel',
                'region_id' => 7,
            ),
            119 =>
            array (
                'id' => 120,
                'name' => 'Quilicura',
                'region_id' => 7,
            ),
            120 =>
            array (
                'id' => 121,
                'name' => 'Quinta Normal',
                'region_id' => 7,
            ),
            121 =>
            array (
                'id' => 122,
                'name' => 'Recoleta',
                'region_id' => 7,
            ),
            122 =>
            array (
                'id' => 123,
                'name' => 'Renca',
                'region_id' => 7,
            ),
            123 =>
            array (
                'id' => 124,
                'name' => 'San Miguel',
                'region_id' => 7,
            ),
            124 =>
            array (
                'id' => 125,
                'name' => 'San Joaquín',
                'region_id' => 7,
            ),
            125 =>
            array (
                'id' => 126,
                'name' => 'San Ramón',
                'region_id' => 7,
            ),
            126 =>
            array (
                'id' => 127,
                'name' => 'Santiago',
                'region_id' => 7,
            ),
            127 =>
            array (
                'id' => 128,
                'name' => 'Vitacura',
                'region_id' => 7,
            ),
            128 =>
            array (
                'id' => 129,
                'name' => 'El Monte',
                'region_id' => 7,
            ),
            129 =>
            array (
                'id' => 130,
                'name' => 'Isla de Maipo',
                'region_id' => 7,
            ),
            130 =>
            array (
                'id' => 131,
                'name' => 'Padre Hurtado',
                'region_id' => 7,
            ),
            131 =>
            array (
                'id' => 132,
                'name' => 'Peñaflor',
                'region_id' => 7,
            ),
            132 =>
            array (
                'id' => 133,
                'name' => 'Talagante',
                'region_id' => 7,
            ),
            133 =>
            array (
                'id' => 134,
                'name' => 'Codegua',
                'region_id' => 8,
            ),
            134 =>
            array (
                'id' => 135,
                'name' => 'Coínco',
                'region_id' => 8,
            ),
            135 =>
            array (
                'id' => 136,
                'name' => 'Coltauco',
                'region_id' => 8,
            ),
            136 =>
            array (
                'id' => 137,
                'name' => 'Doñihue',
                'region_id' => 8,
            ),
            137 =>
            array (
                'id' => 138,
                'name' => 'Graneros',
                'region_id' => 8,
            ),
            138 =>
            array (
                'id' => 139,
                'name' => 'Las Cabras',
                'region_id' => 8,
            ),
            139 =>
            array (
                'id' => 140,
                'name' => 'Machalí',
                'region_id' => 8,
            ),
            140 =>
            array (
                'id' => 141,
                'name' => 'Malloa',
                'region_id' => 8,
            ),
            141 =>
            array (
                'id' => 142,
                'name' => 'Mostazal',
                'region_id' => 8,
            ),
            142 =>
            array (
                'id' => 143,
                'name' => 'Olivar',
                'region_id' => 8,
            ),
            143 =>
            array (
                'id' => 144,
                'name' => 'Peumo',
                'region_id' => 8,
            ),
            144 =>
            array (
                'id' => 145,
                'name' => 'Pichidegua',
                'region_id' => 8,
            ),
            145 =>
            array (
                'id' => 146,
                'name' => 'Quinta de Tilcoco',
                'region_id' => 8,
            ),
            146 =>
            array (
                'id' => 147,
                'name' => 'Rancagua',
                'region_id' => 8,
            ),
            147 =>
            array (
                'id' => 148,
                'name' => 'Rengo',
                'region_id' => 8,
            ),
            148 =>
            array (
                'id' => 149,
                'name' => 'Requínoa',
                'region_id' => 8,
            ),
            149 =>
            array (
                'id' => 150,
                'name' => 'San Vicente de Tagua Tagua',
                'region_id' => 8,
            ),
            150 =>
            array (
                'id' => 151,
                'name' => 'La Estrella',
                'region_id' => 8,
            ),
            151 =>
            array (
                'id' => 152,
                'name' => 'Litueche',
                'region_id' => 8,
            ),
            152 =>
            array (
                'id' => 153,
                'name' => 'Marchihue',
                'region_id' => 8,
            ),
            153 =>
            array (
                'id' => 154,
                'name' => 'Navidad',
                'region_id' => 8,
            ),
            154 =>
            array (
                'id' => 155,
                'name' => 'Peredones',
                'region_id' => 8,
            ),
            155 =>
            array (
                'id' => 156,
                'name' => 'Pichilemu',
                'region_id' => 8,
            ),
            156 =>
            array (
                'id' => 157,
                'name' => 'Chépica',
                'region_id' => 8,
            ),
            157 =>
            array (
                'id' => 158,
                'name' => 'Chimbarongo',
                'region_id' => 8,
            ),
            158 =>
            array (
                'id' => 159,
                'name' => 'Lolol',
                'region_id' => 8,
            ),
            159 =>
            array (
                'id' => 160,
                'name' => 'Nancagua',
                'region_id' => 8,
            ),
            160 =>
            array (
                'id' => 161,
                'name' => 'Palmilla',
                'region_id' => 8,
            ),
            161 =>
            array (
                'id' => 162,
                'name' => 'Peralillo',
                'region_id' => 8,
            ),
            162 =>
            array (
                'id' => 163,
                'name' => 'Placilla',
                'region_id' => 8,
            ),
            163 =>
            array (
                'id' => 164,
                'name' => 'Pumanque',
                'region_id' => 8,
            ),
            164 =>
            array (
                'id' => 165,
                'name' => 'San Fernando',
                'region_id' => 8,
            ),
            165 =>
            array (
                'id' => 166,
                'name' => 'Santa Cruz',
                'region_id' => 8,
            ),
            166 =>
            array (
                'id' => 167,
                'name' => 'Cauquenes',
                'region_id' => 9,
            ),
            167 =>
            array (
                'id' => 168,
                'name' => 'Chanco',
                'region_id' => 9,
            ),
            168 =>
            array (
                'id' => 169,
                'name' => 'Pelluhue',
                'region_id' => 9,
            ),
            169 =>
            array (
                'id' => 170,
                'name' => 'Curicó',
                'region_id' => 9,
            ),
            170 =>
            array (
                'id' => 171,
                'name' => 'Hualañé',
                'region_id' => 9,
            ),
            171 =>
            array (
                'id' => 172,
                'name' => 'Licantén',
                'region_id' => 9,
            ),
            172 =>
            array (
                'id' => 173,
                'name' => 'Molina',
                'region_id' => 9,
            ),
            173 =>
            array (
                'id' => 174,
                'name' => 'Rauco',
                'region_id' => 9,
            ),
            174 =>
            array (
                'id' => 175,
                'name' => 'Romeral',
                'region_id' => 9,
            ),
            175 =>
            array (
                'id' => 176,
                'name' => 'Sagrada Familia',
                'region_id' => 9,
            ),
            176 =>
            array (
                'id' => 177,
                'name' => 'Teno',
                'region_id' => 9,
            ),
            177 =>
            array (
                'id' => 178,
                'name' => 'Vichuquén',
                'region_id' => 9,
            ),
            178 =>
            array (
                'id' => 179,
                'name' => 'Colbún',
                'region_id' => 9,
            ),
            179 =>
            array (
                'id' => 180,
                'name' => 'Linares',
                'region_id' => 9,
            ),
            180 =>
            array (
                'id' => 181,
                'name' => 'Longaví',
                'region_id' => 9,
            ),
            181 =>
            array (
                'id' => 182,
                'name' => 'Parral',
                'region_id' => 9,
            ),
            182 =>
            array (
                'id' => 183,
                'name' => 'Retiro',
                'region_id' => 9,
            ),
            183 =>
            array (
                'id' => 184,
                'name' => 'San Javier',
                'region_id' => 9,
            ),
            184 =>
            array (
                'id' => 185,
                'name' => 'Villa Alegre',
                'region_id' => 9,
            ),
            185 =>
            array (
                'id' => 186,
                'name' => 'Yerbas Buenas',
                'region_id' => 9,
            ),
            186 =>
            array (
                'id' => 187,
                'name' => 'Constitución',
                'region_id' => 9,
            ),
            187 =>
            array (
                'id' => 188,
                'name' => 'Curepto',
                'region_id' => 9,
            ),
            188 =>
            array (
                'id' => 189,
                'name' => 'Empedrado',
                'region_id' => 9,
            ),
            189 =>
            array (
                'id' => 190,
                'name' => 'Maule',
                'region_id' => 9,
            ),
            190 =>
            array (
                'id' => 191,
                'name' => 'Pelarco',
                'region_id' => 9,
            ),
            191 =>
            array (
                'id' => 192,
                'name' => 'Pencahue',
                'region_id' => 9,
            ),
            192 =>
            array (
                'id' => 193,
                'name' => 'Río Claro',
                'region_id' => 9,
            ),
            193 =>
            array (
                'id' => 194,
                'name' => 'San Clemente',
                'region_id' => 9,
            ),
            194 =>
            array (
                'id' => 195,
                'name' => 'San Rafael',
                'region_id' => 9,
            ),
            195 =>
            array (
                'id' => 196,
                'name' => 'Talca',
                'region_id' => 9,
            ),
            196 =>
            array (
                'id' => 197,
                'name' => 'Bulnes',
                'region_id' => 10,
            ),
            197 =>
            array (
                'id' => 198,
                'name' => 'Chillán',
                'region_id' => 10,
            ),
            198 =>
            array (
                'id' => 199,
                'name' => 'Chillán Viejo',
                'region_id' => 10,
            ),
            199 =>
            array (
                'id' => 200,
                'name' => 'Cobquecura',
                'region_id' => 10,
            ),
            200 =>
            array (
                'id' => 201,
                'name' => 'Coelemu',
                'region_id' => 10,
            ),
            201 =>
            array (
                'id' => 202,
                'name' => 'Coihueco',
                'region_id' => 10,
            ),
            202 =>
            array (
                'id' => 203,
                'name' => 'El Carmen',
                'region_id' => 10,
            ),
            203 =>
            array (
                'id' => 204,
                'name' => 'Ninhue',
                'region_id' => 10,
            ),
            204 =>
            array (
                'id' => 205,
                'name' => 'Ñiquen',
                'region_id' => 10,
            ),
            205 =>
            array (
                'id' => 206,
                'name' => 'Pemuco',
                'region_id' => 10,
            ),
            206 =>
            array (
                'id' => 207,
                'name' => 'Pinto',
                'region_id' => 10,
            ),
            207 =>
            array (
                'id' => 208,
                'name' => 'Portezuelo',
                'region_id' => 10,
            ),
            208 =>
            array (
                'id' => 209,
                'name' => 'Quirihue',
                'region_id' => 10,
            ),
            209 =>
            array (
                'id' => 210,
                'name' => 'Ránquil',
                'region_id' => 10,
            ),
            210 =>
            array (
                'id' => 211,
                'name' => 'Treguaco',
                'region_id' => 10,
            ),
            211 =>
            array (
                'id' => 212,
                'name' => 'Quillón',
                'region_id' => 10,
            ),
            212 =>
            array (
                'id' => 213,
                'name' => 'San Carlos',
                'region_id' => 10,
            ),
            213 =>
            array (
                'id' => 214,
                'name' => 'San Fabián',
                'region_id' => 10,
            ),
            214 =>
            array (
                'id' => 215,
                'name' => 'San Ignacio',
                'region_id' => 10,
            ),
            215 =>
            array (
                'id' => 216,
                'name' => 'San Nicolás',
                'region_id' => 10,
            ),
            216 =>
            array (
                'id' => 217,
                'name' => 'Yungay',
                'region_id' => 10,
            ),
            217 =>
            array (
                'id' => 218,
                'name' => 'Arauco',
                'region_id' => 11,
            ),
            218 =>
            array (
                'id' => 219,
                'name' => 'Cañete',
                'region_id' => 11,
            ),
            219 =>
            array (
                'id' => 220,
                'name' => 'Contulmo',
                'region_id' => 11,
            ),
            220 =>
            array (
                'id' => 221,
                'name' => 'Curanilahue',
                'region_id' => 11,
            ),
            221 =>
            array (
                'id' => 222,
                'name' => 'Lebu',
                'region_id' => 11,
            ),
            222 =>
            array (
                'id' => 223,
                'name' => 'Los Álamos',
                'region_id' => 11,
            ),
            223 =>
            array (
                'id' => 224,
                'name' => 'Tirúa',
                'region_id' => 11,
            ),
            224 =>
            array (
                'id' => 225,
                'name' => 'Alto Biobío',
                'region_id' => 11,
            ),
            225 =>
            array (
                'id' => 226,
                'name' => 'Antuco',
                'region_id' => 11,
            ),
            226 =>
            array (
                'id' => 227,
                'name' => 'Cabrero',
                'region_id' => 11,
            ),
            227 =>
            array (
                'id' => 228,
                'name' => 'Laja',
                'region_id' => 11,
            ),
            228 =>
            array (
                'id' => 229,
                'name' => 'Los Ángeles',
                'region_id' => 11,
            ),
            229 =>
            array (
                'id' => 230,
                'name' => 'Mulchén',
                'region_id' => 11,
            ),
            230 =>
            array (
                'id' => 231,
                'name' => 'Nacimiento',
                'region_id' => 11,
            ),
            231 =>
            array (
                'id' => 232,
                'name' => 'Negrete',
                'region_id' => 11,
            ),
            232 =>
            array (
                'id' => 233,
                'name' => 'Quilaco',
                'region_id' => 11,
            ),
            233 =>
            array (
                'id' => 234,
                'name' => 'Quilleco',
                'region_id' => 11,
            ),
            234 =>
            array (
                'id' => 235,
                'name' => 'San Rosendo',
                'region_id' => 11,
            ),
            235 =>
            array (
                'id' => 236,
                'name' => 'Santa Bárbara',
                'region_id' => 11,
            ),
            236 =>
            array (
                'id' => 237,
                'name' => 'Tucapel',
                'region_id' => 11,
            ),
            237 =>
            array (
                'id' => 238,
                'name' => 'Yumbel',
                'region_id' => 11,
            ),
            238 =>
            array (
                'id' => 239,
                'name' => 'Chiguayante',
                'region_id' => 11,
            ),
            239 =>
            array (
                'id' => 240,
                'name' => 'Concepción',
                'region_id' => 11,
            ),
            240 =>
            array (
                'id' => 241,
                'name' => 'Coronel',
                'region_id' => 11,
            ),
            241 =>
            array (
                'id' => 242,
                'name' => 'Florida',
                'region_id' => 11,
            ),
            242 =>
            array (
                'id' => 243,
                'name' => 'Hualpén',
                'region_id' => 11,
            ),
            243 =>
            array (
                'id' => 244,
                'name' => 'Hualqui',
                'region_id' => 11,
            ),
            244 =>
            array (
                'id' => 245,
                'name' => 'Lota',
                'region_id' => 11,
            ),
            245 =>
            array (
                'id' => 246,
                'name' => 'Penco',
                'region_id' => 11,
            ),
            246 =>
            array (
                'id' => 247,
                'name' => 'San Pedro de La Paz',
                'region_id' => 11,
            ),
            247 =>
            array (
                'id' => 248,
                'name' => 'Santa Juana',
                'region_id' => 11,
            ),
            248 =>
            array (
                'id' => 249,
                'name' => 'Talcahuano',
                'region_id' => 11,
            ),
            249 =>
            array (
                'id' => 250,
                'name' => 'Tomé',
                'region_id' => 11,
            ),
            250 =>
            array (
                'id' => 251,
                'name' => 'Carahue',
                'region_id' => 12,
            ),
            251 =>
            array (
                'id' => 252,
                'name' => 'Cholchol',
                'region_id' => 12,
            ),
            252 =>
            array (
                'id' => 253,
                'name' => 'Cunco',
                'region_id' => 12,
            ),
            253 =>
            array (
                'id' => 254,
                'name' => 'Curarrehue',
                'region_id' => 12,
            ),
            254 =>
            array (
                'id' => 255,
                'name' => 'Freire',
                'region_id' => 12,
            ),
            255 =>
            array (
                'id' => 256,
                'name' => 'Galvarino',
                'region_id' => 12,
            ),
            256 =>
            array (
                'id' => 257,
                'name' => 'Gorbea',
                'region_id' => 12,
            ),
            257 =>
            array (
                'id' => 258,
                'name' => 'Lautaro',
                'region_id' => 12,
            ),
            258 =>
            array (
                'id' => 259,
                'name' => 'Loncoche',
                'region_id' => 12,
            ),
            259 =>
            array (
                'id' => 260,
                'name' => 'Melipeuco',
                'region_id' => 12,
            ),
            260 =>
            array (
                'id' => 261,
                'name' => 'Nueva Imperial',
                'region_id' => 12,
            ),
            261 =>
            array (
                'id' => 262,
                'name' => 'Padre Las Casas',
                'region_id' => 12,
            ),
            262 =>
            array (
                'id' => 263,
                'name' => 'Perquenco',
                'region_id' => 12,
            ),
            263 =>
            array (
                'id' => 264,
                'name' => 'Pitrufquén',
                'region_id' => 12,
            ),
            264 =>
            array (
                'id' => 265,
                'name' => 'Pucón',
                'region_id' => 12,
            ),
            265 =>
            array (
                'id' => 266,
                'name' => 'Saavedra',
                'region_id' => 12,
            ),
            266 =>
            array (
                'id' => 267,
                'name' => 'Temuco',
                'region_id' => 12,
            ),
            267 =>
            array (
                'id' => 268,
                'name' => 'Teodoro Schmidt',
                'region_id' => 12,
            ),
            268 =>
            array (
                'id' => 269,
                'name' => 'Toltén',
                'region_id' => 12,
            ),
            269 =>
            array (
                'id' => 270,
                'name' => 'Vilcún',
                'region_id' => 12,
            ),
            270 =>
            array (
                'id' => 271,
                'name' => 'Villarrica',
                'region_id' => 12,
            ),
            271 =>
            array (
                'id' => 272,
                'name' => 'Angol',
                'region_id' => 12,
            ),
            272 =>
            array (
                'id' => 273,
                'name' => 'Collipulli',
                'region_id' => 12,
            ),
            273 =>
            array (
                'id' => 274,
                'name' => 'Curacautín',
                'region_id' => 12,
            ),
            274 =>
            array (
                'id' => 275,
                'name' => 'Ercilla',
                'region_id' => 12,
            ),
            275 =>
            array (
                'id' => 276,
                'name' => 'Lonquimay',
                'region_id' => 12,
            ),
            276 =>
            array (
                'id' => 277,
                'name' => 'Los Sauces',
                'region_id' => 12,
            ),
            277 =>
            array (
                'id' => 278,
                'name' => 'Lumaco',
                'region_id' => 12,
            ),
            278 =>
            array (
                'id' => 279,
                'name' => 'Purén',
                'region_id' => 12,
            ),
            279 =>
            array (
                'id' => 280,
                'name' => 'Renaico',
                'region_id' => 12,
            ),
            280 =>
            array (
                'id' => 281,
                'name' => 'Traiguén',
                'region_id' => 12,
            ),
            281 =>
            array (
                'id' => 282,
                'name' => 'Victoria',
                'region_id' => 12,
            ),
            282 =>
            array (
                'id' => 283,
                'name' => 'Corral',
                'region_id' => 13,
            ),
            283 =>
            array (
                'id' => 284,
                'name' => 'Lanco',
                'region_id' => 13,
            ),
            284 =>
            array (
                'id' => 285,
                'name' => 'Los Lagos',
                'region_id' => 13,
            ),
            285 =>
            array (
                'id' => 286,
                'name' => 'Máfil',
                'region_id' => 13,
            ),
            286 =>
            array (
                'id' => 287,
                'name' => 'Mariquina',
                'region_id' => 13,
            ),
            287 =>
            array (
                'id' => 288,
                'name' => 'Paillaco',
                'region_id' => 13,
            ),
            288 =>
            array (
                'id' => 289,
                'name' => 'Panguipulli',
                'region_id' => 13,
            ),
            289 =>
            array (
                'id' => 290,
                'name' => 'Valdivia',
                'region_id' => 13,
            ),
            290 =>
            array (
                'id' => 291,
                'name' => 'Futrono',
                'region_id' => 13,
            ),
            291 =>
            array (
                'id' => 292,
                'name' => 'La Unión',
                'region_id' => 13,
            ),
            292 =>
            array (
                'id' => 293,
                'name' => 'Lago Ranco',
                'region_id' => 13,
            ),
            293 =>
            array (
                'id' => 294,
                'name' => 'Río Bueno',
                'region_id' => 13,
            ),
            294 =>
            array (
                'id' => 295,
                'name' => 'Ancud',
                'region_id' => 14,
            ),
            295 =>
            array (
                'id' => 296,
                'name' => 'Castro',
                'region_id' => 14,
            ),
            296 =>
            array (
                'id' => 297,
                'name' => 'Chonchi',
                'region_id' => 14,
            ),
            297 =>
            array (
                'id' => 298,
                'name' => 'Curaco de Vélez',
                'region_id' => 14,
            ),
            298 =>
            array (
                'id' => 299,
                'name' => 'Dalcahue',
                'region_id' => 14,
            ),
            299 =>
            array (
                'id' => 300,
                'name' => 'Puqueldón',
                'region_id' => 14,
            ),
            300 =>
            array (
                'id' => 301,
                'name' => 'Queilén',
                'region_id' => 14,
            ),
            301 =>
            array (
                'id' => 302,
                'name' => 'Quemchi',
                'region_id' => 14,
            ),
            302 =>
            array (
                'id' => 303,
                'name' => 'Quellón',
                'region_id' => 14,
            ),
            303 =>
            array (
                'id' => 304,
                'name' => 'Quinchao',
                'region_id' => 14,
            ),
            304 =>
            array (
                'id' => 305,
                'name' => 'Calbuco',
                'region_id' => 14,
            ),
            305 =>
            array (
                'id' => 306,
                'name' => 'Cochamó',
                'region_id' => 14,
            ),
            306 =>
            array (
                'id' => 307,
                'name' => 'Fresia',
                'region_id' => 14,
            ),
            307 =>
            array (
                'id' => 308,
                'name' => 'Frutillar',
                'region_id' => 14,
            ),
            308 =>
            array (
                'id' => 309,
                'name' => 'Llanquihue',
                'region_id' => 14,
            ),
            309 =>
            array (
                'id' => 310,
                'name' => 'Los Muermos',
                'region_id' => 14,
            ),
            310 =>
            array (
                'id' => 311,
                'name' => 'Maullín',
                'region_id' => 14,
            ),
            311 =>
            array (
                'id' => 312,
                'name' => 'Puerto Montt',
                'region_id' => 14,
            ),
            312 =>
            array (
                'id' => 313,
                'name' => 'Puerto Varas',
                'region_id' => 14,
            ),
            313 =>
            array (
                'id' => 314,
                'name' => 'Osorno',
                'region_id' => 14,
            ),
            314 =>
            array (
                'id' => 315,
                'name' => 'Puero Octay',
                'region_id' => 14,
            ),
            315 =>
            array (
                'id' => 316,
                'name' => 'Purranque',
                'region_id' => 14,
            ),
            316 =>
            array (
                'id' => 317,
                'name' => 'Puyehue',
                'region_id' => 14,
            ),
            317 =>
            array (
                'id' => 318,
                'name' => 'Río Negro',
                'region_id' => 14,
            ),
            318 =>
            array (
                'id' => 319,
                'name' => 'San Juan de la Costa',
                'region_id' => 14,
            ),
            319 =>
            array (
                'id' => 320,
                'name' => 'San Pablo',
                'region_id' => 14,
            ),
            320 =>
            array (
                'id' => 321,
                'name' => 'Chaitén',
                'region_id' => 14,
            ),
            321 =>
            array (
                'id' => 322,
                'name' => 'Futaleufú',
                'region_id' => 14,
            ),
            322 =>
            array (
                'id' => 323,
                'name' => 'Hualaihué',
                'region_id' => 14,
            ),
            323 =>
            array (
                'id' => 324,
                'name' => 'Palena',
                'region_id' => 14,
            ),
            324 =>
            array (
                'id' => 325,
                'name' => 'Aisén',
                'region_id' => 15,
            ),
            325 =>
            array (
                'id' => 326,
                'name' => 'Cisnes',
                'region_id' => 15,
            ),
            326 =>
            array (
                'id' => 327,
                'name' => 'Guaitecas',
                'region_id' => 15,
            ),
            327 =>
            array (
                'id' => 328,
                'name' => 'Cochrane',
                'region_id' => 15,
            ),
            328 =>
            array (
                'id' => 329,
                'name' => 'O\'higgins',
                'region_id' => 15,
            ),
            329 =>
            array (
                'id' => 330,
                'name' => 'Tortel',
                'region_id' => 15,
            ),
            330 =>
            array (
                'id' => 331,
                'name' => 'Coihaique',
                'region_id' => 15,
            ),
            331 =>
            array (
                'id' => 332,
                'name' => 'Lago Verde',
                'region_id' => 15,
            ),
            332 =>
            array (
                'id' => 333,
                'name' => 'Chile Chico',
                'region_id' => 15,
            ),
            333 =>
            array (
                'id' => 334,
                'name' => 'Río Ibáñez',
                'region_id' => 15,
            ),
            334 =>
            array (
                'id' => 335,
                'name' => 'Antártica',
                'region_id' => 16,
            ),
            335 =>
            array (
                'id' => 336,
                'name' => 'Cabo de Hornos',
                'region_id' => 16,
            ),
            336 =>
            array (
                'id' => 337,
                'name' => 'Laguna Blanca',
                'region_id' => 16,
            ),
            337 =>
            array (
                'id' => 338,
                'name' => 'Punta Arenas',
                'region_id' => 16,
            ),
            338 =>
            array (
                'id' => 339,
                'name' => 'Río Verde',
                'region_id' => 16,
            ),
            339 =>
            array (
                'id' => 340,
                'name' => 'San Gregorio',
                'region_id' => 16,
            ),
            340 =>
            array (
                'id' => 341,
                'name' => 'Porvenir',
                'region_id' => 16,
            ),
            341 =>
            array (
                'id' => 342,
                'name' => 'Primavera',
                'region_id' => 16,
            ),
            342 =>
            array (
                'id' => 343,
                'name' => 'Timaukel',
                'region_id' => 16,
            ),
            343 =>
            array (
                'id' => 344,
                'name' => 'Natales',
                'region_id' => 16,
            ),
            344 =>
            array (
                'id' => 345,
                'name' => 'Torres del Paine',
                'region_id' => 16,
            ),
            345 =>
            array (
                'id' => 346,
                'name' => 'Cabildo',
                'region_id' => 6,
            ),
        ));
    }
}
