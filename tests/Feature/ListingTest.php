<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Listing;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListingTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    //Unthenticated tests
    public function test_index()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_show()
    {
        // $user = User::factory()->create();
        $listing = Listing::factory()->create();

        $response = $this->get("/listings/$listing->id");
        $response->assertStatus(200);
    }
    //Authenticated Tests
    public function test_create()
    {
        // Test for if user is not authnticated
        $response = $this->get('/listings/create');
        $response->assertStatus(302);

        //Test for authenticated
        $user = User::factory()->create();

        $response = $this->actingAs($user)
                    ->withSession(['banned' => false])
                    ->get('/listings/create');
        $response->assertStatus(200);
    }
    public function test_store()
    {
        // Test for if user is not authnticated
        $data = ['title' => 'Laravel Developer', 'company'=>'Wayne COnfidential' , 'email'=> 'acme@gmail.com', 'location'=>'Mexico' , 'tags' => 'laravel,developer', 'website' =>'https://acmecorps.com', 'description'=>'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae perspiciatis voluptatum sequi voluptatem veritatis doloremque officiis ex, cumque quae, adipisci tempora excepturi odio corrupti. Placeat, et cum. Facilis, non numquam.'];

        $response = $this->post('/listings', $data);
        $response->assertStatus(302);

        $user = User::factory()->create();

        $authresponse = $this->actingAs($user)
                    ->withSession(['banned' => false])
                    ->post('/listings', $data);
        $authresponse->assertStatus(302);
    }
    public function test_edit()
    {
        $user = User::factory()->create();
        $listing = Listing::factory()->create(['user_id'=>$user->id]);

        $repsonse = $this->actingAs($user)
                ->withSession(['banned'=>false])
                ->get("/listings/$listing->id/edit");

        $repsonse->assertStatus(200);

        
    }
    public function test_update()
    {
        $data = ['title' => 'Laravel Developer', 'company'=>'Wayne COnfidential' , 'email'=> 'acme@gmail.com', 'location'=>'Mexico' , 'tags' => 'laravel,developer', 'website' =>'https://acmecorps.com', 'description'=>'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae perspiciatis voluptatum sequi voluptatem veritatis doloremque officiis ex, cumque quae, adipisci tempora excepturi odio corrupti. Placeat, et cum. Facilis, non numquam.'];

        $user = User::factory()->create();
        $listing = Listing::factory()->create(['user_id' => $user->id]);

        $authresponse = $this->actingAs($user)
                    ->withSession(['banned' => false])
                    ->put("/listings/$listing->id", $data);
        $authresponse->assertStatus(302);
    }
    public function test_delete()
    {
        $user = User::factory()->create();
        $listing = Listing::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)
                    ->withSession(['banned' => false])
                    ->delete("/listings/$listing->id");

        $response->assertStatus(302);

        
        
    }
    public function test_manage()
    {
        $user = User::factory()->create();
        
        $response = $this->actingAs($user)
                    ->withSession(['banned'=>false])
                    ->get("/listings/manage");

        $response->assertStatus(200);
    }
}
