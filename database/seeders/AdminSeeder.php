<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $email = 'admin@shopnatv.com';
        
        if (User::where('email', $email)->exists()) {
            echo "ℹ️  Admin đã tồn tại: {$email}\n";
            return;
        }

        $user = new User();
        $user->name = 'Admin ShopNATV';
        $user->email = $email;
        $user->password = Hash::make('Natv@2026#Admin');

        // Tự động phát hiện cột role
        if (Schema::hasColumn('users', 'role')) {
            $user->role = 'admin';
        }
        if (Schema::hasColumn('users', 'is_admin')) {
            $user->is_admin = 1;
        }
        if (Schema::hasColumn('users', 'level')) {
            $user->level = 1;
        }
        if (Schema::hasColumn('users', 'balance')) {
            $user->balance = 0;
        }
        if (Schema::hasColumn('users', 'total_deposit')) {
            $user->total_deposit = 0;
        }
        if (Schema::hasColumn('users', 'status')) {
            $user->status = 'active';
        }

        $user->save();

        echo "✅ Đã tạo admin: {$email} / Natv@2026#Admin\n";
    }
}