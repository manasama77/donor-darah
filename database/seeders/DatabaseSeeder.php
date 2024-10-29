<?php

namespace Database\Seeders;

use App\Models\Location;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'username' => 'admin',
            'password' => 'rahasia!@#)',
        ]);

        Location::create([
            'name' => 'Ruko Imperium Park',
            'address' => 'Jl. Raya Mayor Oking Jaya Atmaja No.63, Ciriung, Kec. Cibinong, Kabupaten Bogor, Jawa Barat 16918',
            'gmap_embed_url' => '<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d247.7734274844141!2d106.8637358!3d-6.4741148!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c1f9916e2c05%3A0x6783c7e20d185e8c!2sBnetfit%20-%20Head%20Office%20(PT%20Omega%20Media%20Global)!5e0!3m2!1sen!2sid!4v1730223102808!5m2!1sen!2sid" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>'
        ]);
    }
}
