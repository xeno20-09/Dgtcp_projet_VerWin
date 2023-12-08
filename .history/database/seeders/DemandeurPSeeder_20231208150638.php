<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
usen

class DemandeurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
\App\Models\demandeurP::factory(150)->create();   
 }
}
