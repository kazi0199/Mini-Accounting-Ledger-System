<?php

namespace Database\Seeders;

use App\Models\Account;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Account::firstOrCreate(['name' => 'Cash']);
        Account::firstOrCreate(['name' => 'Bank']);
        Account::firstOrCreate(['name' => 'Sales']);

    }
}
