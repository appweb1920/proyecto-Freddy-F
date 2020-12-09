<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use Carbon\Carbon;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Opcion 1: FIXME: No funcionó bien...
        //Llenar con elementos creados por factory 
        // factory(App\User::class, 10)->create()->each(
        //     function ($user) {
        //         $user->posts()->save(factory(App\Post::class)->make());
        //     }
        // );

        
        //Opcion 2:
        //Llenar con elementos creados directamente
        $faker = Faker::create();
        
        foreach (range(1, 15) as $index) {
            DB::table('users')->insert([
                'nombre' => $faker->firstName(),
                'apellidos' => $faker->lastName,
                'nickname' => $faker->userName,
                // 'email' => $faker->unique()->email, //Replaced for next line for simplier tests
                'email' => $faker->unique()->numberBetween(10, 99).'@ex.com',
                'email_verified_at' => Carbon::now(),
                // 'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'password' => Hash::make('12345678'),
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
    
}
