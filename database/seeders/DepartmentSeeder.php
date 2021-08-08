<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Group;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::factory(5)->has(Group::factory(1))->create();
    }
}
