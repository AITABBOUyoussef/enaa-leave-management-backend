<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\LeaveType;
use App\Models\LeaveBalance;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Roles
        $roles = ['employee', 'teacher', 'manager', 'hr', 'admin'];
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // 2. Types de congés
        $cp = LeaveType::create(['name' => 'Congés Payés', 'code' => 'CP', 'unit' => 'days', 'default_quota' => 22]);
        $sick = LeaveType::create(['name' => 'Congés Maladie', 'code' => 'SICK', 'unit' => 'days', 'default_quota' => 15]);
        $permit = LeaveType::create(['name' => 'Autorisation d\'absence', 'code' => 'PERMIT', 'unit' => 'hours', 'default_quota' => 10]);

        // 3. Manager
        $manager = User::create([
            'name' => 'Karim Alami',
            'email' => 'manager@enaa.ma',
            'password' => Hash::make('password123'),
            'department' => 'Informatique',
            'is_teacher' => false,
        ]);
        $manager->assignRole('manager');

        // 4. Formateur (Teacher)
        $teacher = User::create([
            'name' => 'Youssef Ait',
            'email' => 'teacher@enaa.ma',
            'password' => Hash::make('password123'),
            'department' => 'Informatique',
            'manager_id' => $manager->id,
            'is_teacher' => true,
        ]);
        $teacher->assignRole('teacher');

        // 5. Soldes pour le formateur (Year 2026)
        LeaveBalance::create(['user_id' => $teacher->id, 'leave_type_id' => $cp->id, 'year' => 2026, 'total' => 22, 'used' => 4]); // 18 restants
        LeaveBalance::create(['user_id' => $teacher->id, 'leave_type_id' => $sick->id, 'year' => 2026, 'total' => 15, 'used' => 0]);
        LeaveBalance::create(['user_id' => $teacher->id, 'leave_type_id' => $permit->id, 'year' => 2026, 'total' => 10, 'used' => 2]);
    }
}
