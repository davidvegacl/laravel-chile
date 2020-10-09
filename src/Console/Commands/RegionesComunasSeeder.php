<?php

namespace DavidVegaCl\LaravelChile\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use DB;

class RegionesComunasSeeder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laravelchile:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Inserta datos de regiones y comunas de Chile';

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
     * @return mixed
     */
    public function handle()
    {
        $this->info('Insertando datos Chile');

        DB::beginTransaction();
        try {
            if (DB::table(config('laravelchile.tabla_regiones'))->count() == 0) {
                $this->insertRegiones();
            }
            if (DB::table(config('laravelchile.tabla_provincias'))->count() == 0) {
                $this->insertProvincias();
            }
            if (DB::table(config('laravelchile.tabla_comunas'))->count() == 0) {
                $this->insertComunas();
            }

            DB::commit();
            $this->info('Datos insertados');
        } catch (Exception $e) {
            DB::rollback();
            $this->info('Error insertando datos: '.$e->getMessage());
        }
    }


    /**
     * Inserta las regiones
     */
    private function insertRegiones()
    {
        $now = \Carbon\Carbon::now();
        $regiones = [
            [1, 2, 'Región de Tarapacá', 'Tarapacá', 'I'],
            [2, 3, 'Región de Antofagasta', 'Antofagasta', 'II'],
            [3, 4, 'Región de Atacama', 'Atacama', 'III'],
            [4, 5, 'Región de Coquimbo', 'Coquimbo', 'IV'],
            [5, 6, 'Región de Valparaíso', 'Valparaiso', 'V'],
            [6, 8, 'Región del Libertador General Bernardo O\'Higgins', 'O\'Higgins', 'VI'],
            [7, 9, 'Región del Maule', 'Maule', 'VII'],
            [8, 11, 'Región del Biobío', 'Biobío', 'VIII'],
            [9, 12, 'Región de La Araucanía', 'Araucanía', 'IX'],
            [10, 14, 'Región de Los Lagos', 'Los Lagos', 'X'],
            [11, 15, 'Región de Aisén del General Carlos Ibáñez del Campo', 'Aisén', 'XI'],
            [12, 16, 'Región de Magallanes y de la Antártica Chilena', 'Magallanes', 'XII'],
            [13, 7, 'Región Metropolitana de Santiago', 'Metropolitana', 'RM'],
            [14, 13, 'Región de Los Ríos', 'Los Ríos', 'XIV'],
            [15, 1, 'Región de Arica y Parinacota','Arica y Parinacota', 'XV'],
            [16, 10, 'Región de Ñuble', 'Ñuble', 'XVI'],
        ];
        $regiones = array_map(function ($region) use ($now) {
            return [
                'id' => $region[0],
                'orden' => $region[1],
                'nombre' => $region[2],
                'nombre_corto' => $region[3],
                'sigla' => $region[4],
                'updated_at' => $now,
                'created_at' => $now,
            ];
        }, $regiones);
        DB::table(config('laravelchile.tabla_regiones'))->insert($regiones);
    }

    /**
     * Inserta las provincias de las regiones
     */
    private function insertProvincias()
    {
        $now = now();

        $provinces = [
            [1, 'Arica', 15],
            [2, 'Parinacota', 15],
            [3, 'Iquique', 1],
            [4, 'Tamarugal', 1],
            [5, 'Antofagasta', 2],
            [6, 'El Loa', 2],
            [7, 'Tocopilla', 2],
            [8, 'Copiapó', 3],
            [9, 'Chañaral', 3],
            [10, 'Huasco', 3],
            [11, 'Elqui', 4],
            [12, 'Choapa', 4],
            [13, 'Limarí', 4],
            [14, 'Valparaíso', 5],
            [15, 'Isla De Pascua', 5],
            [16, 'Los Andes', 5],
            [17, 'Petorca', 5],
            [18, 'Quillota', 5],
            [19, 'San Antonio', 5],
            [20, 'San Felipe', 5],
            [21, 'Marga Marga', 5],
            [22, 'Santiago', 13],
            [23, 'Cordillera', 13],
            [24, 'Chacabuco', 13],
            [25, 'Maipo', 13],
            [26, 'Melipilla', 13],
            [27, 'Talagante', 13],
            [28, 'Cachapoal', 6],
            [29, 'Cardenal Caro', 6],
            [30, 'Colchagua', 6],
            [31, 'Talca', 7],
            [32, 'Cauquenes', 7],
            [33, 'Curicó', 7],
            [34, 'Linares', 7],
            [35, 'Diguillín', 16],
            [36, 'Itata', 16],
            [37, 'Punilla', 16],
            [38, 'Concepción', 8],
            [39, 'Arauco', 8],
            [40, 'Bío-Bío', 8],
            [41, 'Cautín', 9],
            [42, 'Malleco', 9],
            [43, 'Valdivia', 14],
            [44, 'Ranco', 14],
            [45, 'Llanquihue', 10],
            [46, 'Chiloé', 10],
            [47, 'Osorno', 10],
            [48, 'Palena', 10],
            [49, 'Coihayque', 11],
            [50, 'Aisén', 11],
            [51, 'Capitán Prat', 11],
            [52, 'General Carrera', 11],
            [53, 'Magallanes', 12],
            [54, 'Antártica Chilena', 12],
            [55, 'Tierra del Fuego', 12],
            [56, 'Última Esperanza', 12],
        ];

        $provincias = array_map(function ($provincia) use ($now) {
            return [
                'id' => $provincia[0],
                'nombre' => $comuna[1],
                'region_id' => $comuna[2],
                'updated_at' => $now,
                'created_at' => $now,
            ];
        }, $provincias);
        DB::table(config('laravelchile.tabla_provincias'))->insert($provincias);
    }

    /**
     * Inserta las comunas de las regiones
     */
    private function insertComunas()
    {
        $now = now();
        $comunas = [
            ['Arica', 15, 1],
            ['Camarones', 15, 1],
            ['General Lagos', 15, 2],
            ['Putre', 15, 2],
            ['Alto Hospicio', 1, 3],
            ['Iquique', 1, 3],
            ['Camiña', 1, 4],
            ['Colchane', 1, 4],
            ['Huara', 1, 4],
            ['Pica', 1, 4],
            ['Pozo Almonte', 1, 4],
            ['Antofagasta', 2, 5],
            ['Mejillones', 2, 5],
            ['Sierra Gorda', 2, 5],
            ['Taltal', 2, 5],
            ['Calama', 2, 6],
            ['Ollague', 2, 6],
            ['San Pedro de Atacama', 2, 6],
            ['María Elena', 2, 7],
            ['Tocopilla', 2, 7],
            ['Chañaral', 3, 8],
            ['Diego de Almagro', 3, 8],
            ['Caldera', 3, 8],
            ['Copiapó', 3, 9],
            ['Tierra Amarilla', 3, 9],
            ['Alto del Carmen', 3, 10],
            ['Freirina', 3, 10],
            ['Huasco', 3, 10],
            ['Vallenar', 3, 10],
            ['Canela', 4, 11],
            ['Illapel', 4, 11],
            ['Los Vilos', 4, 11],
            ['Salamanca', 4, 11],
            ['Andacollo', 4, 11],
            ['Coquimbo', 4, 11],
            ['La Higuera', 4, 12],
            ['La Serena', 4, 12],
            ['Paihuaco', 4, 12],
            ['Vicuña', 4, 12],
            ['Combarbalá', 4, 13],
            ['Monte Patria', 4, 13],
            ['Ovalle', 4, 13],
            ['Punitaqui', 4, 13],
            ['Río Hurtado', 4, 13],
            ['Isla de Pascua', 5, 14],
            ['Calle Larga', 5, 14],
            ['Los Andes', 5, 14],
            ['Rinconada', 5, 14],
            ['San Esteban', 5, 14],
            ['La Ligua', 5, 14],
            ['Papudo', 5, 14],
            ['Petorca', 5, 15],
            ['Zapallar', 5, 16],
            ['Hijuelas', 5, 16],
            ['La Calera', 5, 16],
            ['La Cruz', 5, 16],
            ['Limache', 5, 17],
            ['Nogales', 5, 17],
            ['Olmué', 5, 17],
            ['Quillota', 5, 17],
            ['Algarrobo', 5, 17],
            ['Cartagena', 5, 18],
            ['El Quisco', 5, 18],
            ['El Tabo', 5, 18],
            ['San Antonio', 5, 18],
            ['Santo Domingo', 5, 18],
            ['Catemu', 5, 19],
            ['Llaillay', 5, 19],
            ['Panquehue', 5, 19],
            ['Putaendo', 5, 19],
            ['San Felipe', 5, 19],
            ['Santa María', 5, 19],
            ['Casablanca', 5, 20],
            ['Concón', 5, 20],
            ['Juan Fernández', 5, 20],
            ['Puchuncaví', 5, 20],
            ['Quilpué', 5, 20],
            ['Quintero', 5, 20],
            ['Valparaíso', 5, 21],
            ['Villa Alemana', 5, 21],
            ['Viña del Mar', 5, 21],
            ['Colina', 13, 21],
            ['Lampa', 13, 22],
            ['Tiltil', 13, 22],
            ['Pirque', 13, 22],
            ['Puente Alto', 13, 22],
            ['San José de Maipo', 13, 22],
            ['Buin', 13, 22],
            ['Calera de Tango', 13, 22],
            ['Paine', 13, 22],
            ['San Bernardo', 13, 22],
            ['Alhué', 13, 22],
            ['Curacaví', 13, 22],
            ['María Pinto', 13, 22],
            ['Melipilla', 13, 22],
            ['San Pedro', 13, 22],
            ['Cerrillos', 13, 22],
            ['Cerro Navia', 13, 22],
            ['Conchalí', 13, 22],
            ['El Bosque', 13, 22],
            ['Estación Central', 13, 22],
            ['Huechuraba', 13, 22],
            ['Independencia', 13, 22],
            ['La Cisterna', 13, 22],
            ['La Granja', 13, 22],
            ['La Florida', 13, 22],
            ['La Pintana', 13, 22],
            ['La Reina', 13, 22],
            ['Las Condes', 13, 22],
            ['Lo Barnechea', 13, 22],
            ['Lo Espejo', 13, 22],
            ['Lo Prado', 13, 22],
            ['Macul', 13, 22],
            ['Maipú', 13, 22],
            ['Ñuñoa', 13, 23],
            ['Pedro Aguirre Cerda', 13, 23],
            ['Peñalolén', 13, 23],
            ['Providencia', 13, 24],
            ['Pudahuel', 13, 24],
            ['Quilicura', 13, 24],
            ['Quinta Normal', 13, 25],
            ['Recoleta', 13, 25],
            ['Renca', 13, 25],
            ['San Miguel', 13, 25],
            ['San Joaquín', 13, 26],
            ['San Ramón', 13, 26],
            ['Santiago', 13, 26],
            ['Vitacura', 13, 26],
            ['El Monte', 13, 26],
            ['Isla de Maipo', 13, 27],
            ['Padre Hurtado', 13, 27],
            ['Peñaflor', 13, 27],
            ['Talagante', 13, 27],
            ['Codegua', 6, 27],
            ['Coínco', 6, 28],
            ['Coltauco', 6, 28],
            ['Doñihue', 6, 28],
            ['Graneros', 6, 28],
            ['Las Cabras', 6, 28],
            ['Machalí', 6, 28],
            ['Malloa', 6, 28],
            ['Mostazal', 6, 28],
            ['Olivar', 6, 28],
            ['Peumo', 6, 28],
            ['Pichidegua', 6, 28],
            ['Quinta de Tilcoco', 6, 28],
            ['Rancagua', 6, 28],
            ['Rengo', 6, 28],
            ['Requínoa', 6, 28],
            ['San Vicente de Tagua Tagua', 6, 28],
            ['La Estrella', 6, 28],
            ['Litueche', 6, 29],
            ['Marchihue', 6, 29],
            ['Navidad', 6, 29],
            ['Peredones', 6, 29],
            ['Pichilemu', 6, 29],
            ['Chépica', 6, 29],
            ['Chimbarongo', 6, 30],
            ['Lolol', 6, 30],
            ['Nancagua', 6, 30],
            ['Palmilla', 6, 30],
            ['Peralillo', 6, 30],
            ['Placilla', 6, 30],
            ['Pumanque', 6, 30],
            ['San Fernando', 6, 30],
            ['Santa Cruz', 6, 30],
            ['Cauquenes', 7, 30],
            ['Chanco', 7, 31],
            ['Pelluhue', 7, 31],
            ['Curicó', 7, 31],
            ['Hualañé', 7, 31],
            ['Licantén', 7, 31],
            ['Molina', 7, 31],
            ['Rauco', 7, 31],
            ['Romeral', 7, 31],
            ['Sagrada Familia', 7, 31],
            ['Teno', 7, 31],
            ['Vichuquén', 7, 32],
            ['Colbún', 7, 32],
            ['Linares', 7, 32],
            ['Longaví', 7, 33],
            ['Parral', 7, 33],
            ['Retiro', 7, 33],
            ['San Javier', 7, 33],
            ['Villa Alegre', 7, 33],
            ['Yerbas Buenas', 7, 33],
            ['Constitución', 7, 33],
            ['Curepto', 7, 33],
            ['Empedrado', 7, 33],
            ['Maule', 7, 34],
            ['Pelarco', 7, 34],
            ['Pencahue', 7, 34],
            ['Río Claro', 7, 34],
            ['San Clemente', 7, 34],
            ['San Rafael', 7, 34],
            ['Talca', 7, 34],
            ['Bulnes', 16, 34],
            ['Chillán', 16, 35],
            ['Chillán Viejo', 16, 35],
            ['Cobquecura', 16, 35],
            ['Coelemu', 16, 35],
            ['Coihueco', 16, 35],
            ['El Carmen', 16, 35],
            ['Ninhue', 16, 35],
            ['Ñiquen', 16, 35],
            ['Pemuco', 16, 35],
            ['Pinto', 16, 36],
            ['Portezuelo', 16, 36],
            ['Quirihue', 16, 36],
            ['Ránquil', 16, 36],
            ['Treguaco', 16, 36],
            ['Quillón', 16, 36],
            ['San Carlos', 16, 36],
            ['San Fabián', 16, 37],
            ['San Ignacio', 16, 37],
            ['San Nicolás', 16, 37],
            ['Yungay', 16, 37],
            ['Arauco', 8, 37],
            ['Cañete', 8, 38],
            ['Contulmo', 8, 38],
            ['Curanilahue', 8, 38],
            ['Lebu', 8, 38],
            ['Los Álamos', 8, 38],
            ['Tirúa', 8, 38],
            ['Alto Biobío', 8, 38],
            ['Antuco', 8, 38],
            ['Cabrero', 8, 38],
            ['Laja', 8, 38],
            ['Los Ángeles', 8, 38],
            ['Mulchén', 8, 38],
            ['Nacimiento', 8, 39],
            ['Negrete', 8, 39],
            ['Quilaco', 8, 39],
            ['Quilleco', 8, 39],
            ['San Rosendo', 8, 39],
            ['Santa Bárbara', 8, 39],
            ['Tucapel', 8, 39],
            ['Yumbel', 8, 40],
            ['Chiguayante', 8, 40],
            ['Concepción', 8, 40],
            ['Coronel', 8, 40],
            ['Florida', 8, 40],
            ['Hualpén', 8, 40],
            ['Hualqui', 8, 40],
            ['Lota', 8, 40],
            ['Penco', 8, 40],
            ['San Pedro de La Paz', 8, 40],
            ['Santa Juana', 8, 40],
            ['Talcahuano', 8, 40],
            ['Tomé', 8, 40],
            ['Carahue', 9, 40],
            ['Cholchol', 9, 41],
            ['Cunco', 9, 41],
            ['Curarrehue', 9, 41],
            ['Freire', 9, 41],
            ['Galvarino', 9, 41],
            ['Gorbea', 9, 41],
            ['Lautaro', 9, 41],
            ['Loncoche', 9, 41],
            ['Melipeuco', 9, 41],
            ['Nueva Imperial', 9, 41],
            ['Padre Las Casas', 9, 41],
            ['Perquenco', 9, 41],
            ['Pitrufquén', 9, 41],
            ['Pucón', 9, 41],
            ['Saavedra', 9, 41],
            ['Temuco', 9, 41],
            ['Teodoro Schmidt', 9, 41],
            ['Toltén', 9, 41],
            ['Vilcún', 9, 41],
            ['Villarrica', 9, 41],
            ['Angol', 9, 41],
            ['Collipulli', 9, 42],
            ['Curacautín', 9, 42],
            ['Ercilla', 9, 42],
            ['Lonquimay', 9, 42],
            ['Los Sauces', 9, 42],
            ['Lumaco', 9, 42],
            ['Purén', 9, 42],
            ['Renaico', 9, 42],
            ['Traiguén', 9, 42],
            ['Victoria', 9, 42],
            ['Corral', 14, 42],
            ['Lanco', 14, 43],
            ['Los Lagos', 14, 43],
            ['Máfil', 14, 43],
            ['Mariquina', 14, 43],
            ['Paillaco', 14, 43],
            ['Panguipulli', 14, 43],
            ['Valdivia', 14, 43],
            ['Futrono', 14, 43],
            ['La Unión', 14, 44],
            ['Lago Ranco', 14, 44],
            ['Río Bueno', 14, 44],
            ['Ancud', 10, 44],
            ['Castro', 10, 45],
            ['Chonchi', 10, 45],
            ['Curaco de Vélez', 10, 45],
            ['Dalcahue', 10, 45],
            ['Puqueldón', 10, 45],
            ['Queilén', 10, 45],
            ['Quemchi', 10, 45],
            ['Quellón', 10, 45],
            ['Quinchao', 10, 45],
            ['Calbuco', 10, 46],
            ['Cochamó', 10, 46],
            ['Fresia', 10, 46],
            ['Frutillar', 10, 46],
            ['Llanquihue', 10, 46],
            ['Los Muermos', 10, 46],
            ['Maullín', 10, 46],
            ['Puerto Montt', 10, 46],
            ['Puerto Varas', 10, 46],
            ['Osorno', 10, 46],
            ['Puero Octay', 10, 47],
            ['Purranque', 10, 47],
            ['Puyehue', 10, 47],
            ['Río Negro', 10, 47],
            ['San Juan de la Costa', 10, 47],
            ['San Pablo', 10, 47],
            ['Chaitén', 10, 47],
            ['Futaleufú', 10, 48],
            ['Hualaihué', 10, 48],
            ['Palena', 10, 48],
            ['Aisén', 11, 48],
            ['Cisnes', 11, 49],
            ['Guaitecas', 11, 49],
            ['Cochrane', 11, 50],
            ['O\'higgins', 11, 50],
            ['Tortel', 11, 50],
            ['Coihaique', 11, 51],
            ['Lago Verde', 11, 51],
            ['Chile Chico', 11, 51],
            ['Río Ibáñez', 11, 52],
            ['Antártica', 12, 52],
            ['Cabo de Hornos', 12, 53],
            ['Laguna Blanca', 12, 53],
            ['Punta Arenas', 12, 53],
            ['Río Verde', 12, 53],
            ['San Gregorio', 12, 54],
            ['Porvenir', 12, 54],
            ['Primavera', 12, 55],
            ['Timaukel', 12, 55],
            ['Natales', 12, 55],
            ['Torres del Paine', 12, 56],
            ['Cabildo', 5, 56],
        ];
        $comunas = array_map(function ($comuna) use ($now) {
            return [
                'nombre' => $comuna[0],
                'region_id' => $comuna[1],
                'provincia_id' => $comuna[2],
                'updated_at' => $now,
                'created_at' => $now,
            ];
        }, $comunas);
        DB::table(config('laravelchile.tabla_comunas'))->insert($comunas);
    }
}
