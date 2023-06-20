<?php

namespace Database\Seeders;

use App\Models\Produtos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ProdutosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $directory = storage_path('app/public/produtos');

        if (File::isDirectory($directory)) {
            File::cleanDirectory($directory);
        } else {
            File::makeDirectory($directory, 0755, true);
        }

        Produtos::factory()
            ->count(10)
            ->create();
    }
}
