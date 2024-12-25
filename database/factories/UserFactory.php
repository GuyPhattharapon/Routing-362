<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * คลาส UserFactory ขยายจากคลาส Factory ซึ่งเป็นโครงสร้างพื้นฐานสำหรับ Laravel Factories
     *Factory นี้จะใช้สร้างตัวอย่างข้อมูลของโมเดล User (<\App\Models\User>)
     */

     protected static ?string $password;
     //ใช้เก็บ password ที่ถูกสร้างครั้งแรก และนำมาใช้ซ้ำในข้อมูลที่ถูกสร้างถัดไป (เพื่อประสิทธิภาพและการจัดการหน่วยความจำ)

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(), //ชื่อแบบสุ่ม โดยใช้ฟังก์ชัน fake()->name()
            'email' => fake()->unique()->safeEmail(), //อีเมลแบบสุ่มและไม่ซ้ำ โดยใช้ fake()->unique()->safeEmail()
            'email_verified_at' => now(), //ระบุวันที่และเวลาที่อีเมลถูกยืนยัน (now())
            'password' => static::$password ??= Hash::make('password'), //ใช้ค่า $password ที่เก็บไว้ใน Static Property หากไม่มีค่า จะสร้างใหม่โดยใช้ Hash::make('password')
            'remember_token' => Str::random(10), //สตริงสุ่ม 10 ตัวอักษร (Str::random(10))
        ];
    }

    /**
     *ฟังก์ชันนี้กำหนด สถานะพิเศษ ให้กับข้อมูลที่สร้าง เช่น หากต้องการสร้างผู้ใช้ที่ยังไม่ได้ยืนยันอีเมล
     *state ใช้กำหนดค่าหรือปรับเปลี่ยนข้อมูลเฉพาะกรณี
     *ในตัวอย่างนี้: email_verified_at ถูกตั้งค่าเป็น null เพื่อระบุว่าอีเมลยังไม่ได้รับการยืนยัน
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
