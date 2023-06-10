<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Analyse;

class AnalyseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
  
    
        public function run(): void
    {
        Analyse::factory(10)->create();  
    }
    
}
