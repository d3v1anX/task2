<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\Team;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Laravel\Jetstream\Jetstream;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            'Admin' => 'admin@example.com',
            'TeamLeader' => 'teamleader1@example.com',
            'Editor' => 'editor1@example.com',
            'Viewer' => 'viewer1@example.com',
        ];
          // Create one team
          

        foreach ($users as $name => $email) {
            DB::transaction(function () use ($name, $email, ) {
                return tap(User::create([
                    'name' => $name,
                    'email' => $email,
                    'password' => Hash::make('123456'),
                    'current_team_id' => 1,

                ]),);
            });
        }
        $team = $this->createBigTeam('admin@example.com');

        $email = 'admin@example.com';
        $role = Role::create(['name' => 'Admin']);
        $user = User::where('email', $email)->first();
        $permissions = Permission::pluck('id', 'id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);

        $email = 'teamleader1@example.com';
        $role = Role::create(['name' => 'TeamLeader']);
        $user = User::where('email', $email)->first();
        $permissions = Permission::whereIn('name', [
            'product-list',
            'product-create',
            'product-edit',
            'product-delete',
            'approval'
        ])->pluck('id', 'id');
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);

        $email = 'editor1@example.com';
        $role = Role::create(['name' => 'Editor']);
        $user = User::where('email', $email)->first();
        $permissions = Permission::whereIn('name', [
            'product-list',
            'product-edit',
        ])->pluck('id', 'id');
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);
        
        $email = 'viewer1@example.com';
        $role = Role::create(['name' => 'Viewer']);
        $user = User::where('email', $email)->first();
        $permissions = Permission::whereIn('name', [
            'product-list',
        ])->pluck('id', 'id');
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);

    }
   
    /**
     * @param mixed $email
     * @return Team
     */
    protected function createBigTeam($email): Team
    {
        $user = Jetstream::findUserByEmailOrFail($email);
        $team = Team::forceCreate([
            'user_id' => $user->id,
            'name' => "RentaPro",
            'personal_team' => false,
        ]);
        $user->ownedTeams()->save($team);
        return $team;
    }
}
