<?php

namespace Database\Seeders\cruds;

use App\Models\Cruds\Image;
use App\Models\Users\Admin;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        Image::create([
            'path' => 'admins/ziadgamal.jpg',
            'imageable_id' => '2',
            'imageable_type' => Admin::class,
        ]);
    }
}
