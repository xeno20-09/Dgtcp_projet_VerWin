<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DemandeurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
demandeurP::factory(150)->create();   
 }
}
