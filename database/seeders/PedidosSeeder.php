<?php

namespace Database\Seeders;

use App\Models\Pedidos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PedidosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pedidos::factory()
            ->count(20)
            ->create();
    }
}
