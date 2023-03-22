<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Listing;
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
        \App\Models\User::factory(5)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        Listing::factory(6)->create();
        // Listing::create([
        //     'title' => 'Laravel Senior Developer',
        //     'tags' => 'laravel, javascript',
        //     'company' => 'Acme Corp',
        //     'location' => 'Boston, MA',
        //     'email' => 'email@email.com',
        //     'website' => 'https://www.acme.com',
        //     'description' => 'Lorem ipsum dolor sit amet consectetur,
        //     adipisicing elit. Quidem, eos eum maiores 
        //     est iste atque aliquam fuga provident accusamus
        //      optio ullam neque quasi libero dignissimos quis, 
        //      similique impedit corrupti maxime! '
        // ]);
        // Listing::create([
        //     'title' => 'Full Stack Engineer',
        //     'tags' => 'laravel, backedn, ao',
        //     'company' => 'Stark Industries',
        //     'location' => 'NewYork, NY',
        //     'email' => 'email2@email.com',
        //     'website' => 'https://www.starkindustries.com',
        //     'description' => 'Lorem ipsum dolor sit amet consectetur,
        //     adipisicing elit. Quidem, eos eum maiores 
        //     est iste atque aliquam fuga provident accusamus
        //      optio ullam neque quasi libero dignissimos quis, 
        //      similique impedit corrupti maxime! '
        // ]);
    }
}
