<?php

namespace Database\Seeders;

use App\Models\Link;
use App\Models\HtmlSnippet;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Link::factory(20)->create();
        HtmlSnippet::factory(20)->create();
    }
}
