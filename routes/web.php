<?php

// นำเข้า คอนโทรลเลอร์(ChirpController) เพื่อใช้จัดการเส้นทางที่เกี่ยวข้องกับ Chirps
use App\Http\Controllers\ChirpController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
// นำเข้าคลาสที่ใช้สำหรับแอปพลิเคชัน(Application)
use Illuminate\Foundation\Application;
// นำเข้าคลาสที่ใช้สำหรับกำหนดเส้นทาง
use Illuminate\Support\Facades\Route;
// นำเข้า Inertia สำหรับการเรนเดอร์หน้าเว็บ
use Inertia\Inertia;
use App\Http\Controllers\UseController;
use Illuminate\Http\Request;

// เส้นทางหลักสำหรับหน้าแรกของเว็ปไซต์ ('/')
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'), // ตรวจสอบว่ามีเส้นทางเข้าสู่ระบบ
        'canRegister' => Route::has('register'), // ตรวจสอบว่ามีเส้นทางสมัครสมาชิก
        'laravelVersion' => Application::VERSION, // แสดงเวอร์ชันของ Laravel
        'phpVersion' => PHP_VERSION, // แสดงเวอร์ชันของ PHP
    ]);
});

Route::get('/greeting', function () {
    return 'Hello World';
});

Route::get('/user', [UseController::class, 'index']);

Route::get('/user/{id}', function (Request $request, string $id) {
    return 'User '.$id;
});

Route::get('/products',[ProductController::class,'index']) ->middleware(['auth', 'verified'])->name('products.index');
Route::get('/products/{id}',[ProductController::class,'show'])->middleware(['auth','verified']);

// Route::resource('products', ProductController::class);
// เส้นทางสำหรับแดชบอร์ดที่ต้องการการยืนยันตัวตนและอีเมล
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// กลุ่มเส้นทางที่ต้องการการยืนยันตัวตน
Route::middleware('auth')->group(function () {
    // เส้นทางสำหรับการแก้ไขข้อมูลโปรไฟล์
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // เส้นทางสำหรับการอัพเดทข้อมูลโปรไฟล์
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // เส้นทางสำหรับการลบโปรไฟล์
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// กลุ่มเส้นทางสำหรับการจัดการ Chirp โดยใช้ resource controller
Route::resource('chirps', ChirpController::class)
->only(['index', 'store', 'update', 'destroy']) // จำกัดการใช้เมธอดที่เลือกเท่านั้น
    ->middleware(['auth', 'verified']); // ต้องการการยืนยันตัวตนและอีเมลสำหรับการเข้าถึง

// รวมเส้นทางที่เกี่ยวข้องกับการเข้าสู่ระบบและการยืนยันอีเมล
require __DIR__.'/auth.php';
