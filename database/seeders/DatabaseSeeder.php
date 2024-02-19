<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        \App\Models\Kelas::create([
            'nama' => 'TKJ IX',
            'slug' => 'tkj-ix',
            'tahun' => '2023'
        ]);

        \App\Models\Kelas::create([
            'nama' => 'TKJ X',
            'slug' => 'tkj-x',
            'tahun' => '2023'
        ]);

        \App\Models\Kelas::create([
            'nama' => 'TKJ XI',
            'slug' => 'tkj-xi',
            'tahun' => '2023'
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'role' => 'Guru',
            'nik' => '37881923992'
        ]);

        \App\Models\User::factory(50)->create();
    }
}
