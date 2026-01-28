<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $company = \App\Models\Company::firstOrCreate(
            ['name' => 'Admin Comp'],
            ['is_active' => true]
        );

        \App\Models\User::updateOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'company_id' => $company->id,
                'name' => 'admin',
                'password' => \Hash::make('admin'),
                'is_admin' => true,
                'is_active' => true,
                'plan_type' => 'pro',
            ]
        );
    }
}
