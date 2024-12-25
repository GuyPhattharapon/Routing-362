<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // คอลัมน์ Primary Key แบบ Auto-Increment
            $table->string('name'); // ชื่อผู้ใช้
            $table->string('email')->unique(); // อีเมล ต้องไม่ซ้ำกัน
            $table->timestamp('email_verified_at')->nullable(); // วันที่ยืนยันอีเมล (อาจไม่มี)
            $table->string('password'); // รหัสผ่าน
            $table->rememberToken(); // Token สำหรับ "Remember Me"
            $table->timestamps(); // คอลัมน์ created_at และ updated_at
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary(); // Primary Key เป็นอีเมล
            $table->string('token'); // Token สำหรับรีเซ็ตรหัสผ่าน
            $table->timestamp('created_at')->nullable(); // วันที่สร้าง Token
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary(); // Primary Key คือ ID ของ Session
            $table->foreignId('user_id')->nullable()->index(); // เชื่อมกับตาราง `users`
            $table->string('ip_address', 45)->nullable(); // IP Address ของผู้ใช้
            $table->text('user_agent')->nullable(); // ข้อมูล User-Agent เช่น Browser
            $table->longText('payload'); // ข้อมูล Session
            $table->integer('last_activity')->index(); // เวลาล่าสุดที่ผู้ใช้ทำกิจกรรม
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
