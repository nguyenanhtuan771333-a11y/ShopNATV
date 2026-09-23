<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
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
        $user->username      = 'admin';
        $user->fullname      = 'Admin ShopNATV';
        $user->email         = $email;
        $user->password      = Hash::make('Natv@2026#Admin');
        $user->phone         = '0966982422';
        $user->balance       = 0;
        $user->total_deposit = 0;
        $user->total_withdraw = 0;
        $user->status        = 'active';
        $user->role          = 'admin';

        $user->save();

        echo "✅ Đã tạo admin: {$email} / Natv@2026#Admin\n";
    }
}