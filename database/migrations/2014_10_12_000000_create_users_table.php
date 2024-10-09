<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('username')->unique()->nullable();
            $table->string('phone')->unique()->nullable();
            $table->string('address')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('gender')->nullable();
            $table->string('birth_date')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->string('avatar')->nullable();
            $table->string('role')->default('user');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        // اضافة صلاحيات للمستخدمين
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'username' => 'admin',
                'phone' => '1234567890',
                'address' => '123 Main St',
                'country' => 'USA',
                'city' => 'New York',
                'postal_code' => '10001',
                'gender' => 'Male',
                'birth_date' => '1990-01-01',
                'lat' => '40.7128',
                'lng' => '-74.0060',
                'role' => 'admin',
                'status' => 'active',
                'password' => bcrypt('admin123'),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
