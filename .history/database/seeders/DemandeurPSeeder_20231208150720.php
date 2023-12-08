<?php

namespace Database\Seeders;

use App\Models\demandeurP;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
