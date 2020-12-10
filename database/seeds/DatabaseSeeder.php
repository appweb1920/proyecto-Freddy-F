<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        //NOTA: Asegurarse de ejecutar "composer dump-autoload" antes del seeder
        $this->call([
            UsersSeeder::class,
            AlmacenSeeder::class,
            UsuariosAlmacenSeeder::class,
            RecetasSeeder::class,
        ]);
    }
}
