<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;
use Illuminate\Support\Str;

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
                    'txtoPaso' => $faker->text( 50*($indexReceta%3 + 1) ),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            }
        }
    }
}
