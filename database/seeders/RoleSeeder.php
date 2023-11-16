<?php

namespace Database\Seeders;

use App\Models\Roles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                'name' => 'admin'
            ],
            [
                'name' => 'company'
            ],
            [
                'name' => 'job_seeker'
            ],
        ];

        foreach ($datas as $data) {
            Roles::create($data);
        }
    }
}
