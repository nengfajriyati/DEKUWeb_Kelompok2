<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Wallet;

class DefaultSeeder extends Seeder
{
    public function run(): void
    {
        // Default categories
        $categories = [
            ['name'=>'Gaji','type'=>'income'],
            ['name'=>'Bisnis','type'=>'income'],
            ['name'=>'Makan','type'=>'expense'],
            ['name'=>'Transport','type'=>'expense'],
            ['name'=>'Kesehatan','type'=>'expense'],
            ['name'=>'Hiburan','type'=>'expense'],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }

        // Default wallet (untuk user #1)
        Wallet::create([
            'user_id' => 1,  // sementara
            'name' => 'Cash',
            'balance' => 0
        ]);
    }
}
