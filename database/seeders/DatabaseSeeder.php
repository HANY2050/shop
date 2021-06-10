<?php

namespace Database\Seeders;

//use App\Models\User;
use App\Models\Address;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\Review;
use App\Models\Role;
use App\Models\Tag;
use App\Models\Ticket;
use App\Models\User;
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
      User::factory()->times(500)->create();
      //  Address::factory()->times(1000)->create();
       // Product::factory()->times(1500)->create();
       //Category::factory()->times(1500)->create();
        //Image::factory()->times(1500)->create();
        //Review::factory()->times(3500)->create();
        //User::factory(1000)->create();
       // Tag::factory()->times(150)->create();
        //Role::factory()->times()->create();
        //Ticket::factory()->times(150)->create();
    }
}
