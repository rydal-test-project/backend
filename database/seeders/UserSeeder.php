<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $group = Group::query()->select('id')->inRandomOrder()->first();
        $users = [
            [
                'patronymic' => 'Rydal',
                'name' => 'G',
                'surname' => 'G',
                'email' => 'i.am.alex2k@mail.ru',
                'password' => Hash::make('funt1974'),
                'group_id' => $group->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];

        User::insert($users);
    }
}
