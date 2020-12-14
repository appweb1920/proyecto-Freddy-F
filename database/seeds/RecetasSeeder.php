<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;
use Illuminate\Support\Str;

use App\Recetas;
use App\Ingredientes;

class RecetasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //objeto de utilidad para generar campos automaticamente
        $faker = Faker::create();
        
        // Crea 3 recetas de prueba
        foreach (range(1, 5) as $indexReceta) {
            DB::table('recetas')->insert([
                'nombreReceta' => 'Receta '.$indexReceta,
                'categoria' => 'Categoria '.$indexReceta,
                'numPorciones' => $indexReceta%3 + 4,
                'tiempoPreparacion' => ($indexReceta%3 + 1) * 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
            
            // Por cada receta crea algunos pasos para cada una
            foreach (range(1, $indexReceta%4 + 2) as $numPaso){
                DB::table('pasosDeReceta')->insert([
                    'idReceta' => $indexReceta,
                    'numPaso' => $numPaso,
                    'textoPaso' => $faker->text( 50*($indexReceta%3 + 1) ),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            }
        }
        
        //idReceta 6
        DB::table('recetas')->insert([
            'nombreReceta' => 'Pan de calabaza',
            'categoria' => 'Postres ',
            'numPorciones' => 6,
            'tiempoPreparacion' => 30,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
        $receta = new Recetas();
        $receta->agregarPasosAReceta(6, 1, "Engrasa el molde con mantequilla y precalienta el horno a 175°c.");
        $receta->agregarPasosAReceta(6, 2, "Mezcla en un tazón todos los polvos, que queden bien integrados y reserva.");
        $receta->agregarPasosAReceta(6, 3, "En otro tazón mezcla el agua, huevos, vainilla, aceite y la calabaza previamente cocida sólo con agua. Finalmente agrega las nueces picadas y la mezcla de polvos hasta que se integren.");
        $receta->agregarPasosAReceta(6, 4, "Vierte la mezcla en el molde engrasado y hornea por 60 minutos o hasta que se sienta esponjoso.");
        
        $receta->agregarIngredientesAReceta(6, 1, 1, 'tazas?');
        $receta->agregarIngredientesAReceta(6, 2, 1, 'tazas?');
        $receta->agregarIngredientesAReceta(6, 3, 1, 'cucharaditas?');
        $receta->agregarIngredientesAReceta(6, 4, 1, 'pizca');
        $receta->agregarIngredientesAReceta(6, 5, 1, 'pizca');
        $receta->agregarIngredientesAReceta(6, 6, 1, 'pizca');
        $receta->agregarIngredientesAReceta(6, 7, 1, 'pizca');
        $receta->agregarIngredientesAReceta(6, 8, 1, 'pizca');
        $receta->agregarIngredientesAReceta(6, 9, 1, 'taza');
        $receta->agregarIngredientesAReceta(6, 10, 1, 'piezas');
        $receta->agregarIngredientesAReceta(6, 11, 1, 'prueba');
        $receta->agregarIngredientesAReceta(6, 12, 1, 'prueba');
        $receta->agregarIngredientesAReceta(6, 13, 1, 'tazas?');
        $receta->agregarIngredientesAReceta(6, 14, 1, 'tazas?');

        
    }
}
