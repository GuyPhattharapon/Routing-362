<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class NewPasswordController extends Controller
{
    /**
     * แสดงหน้ามุมมองสำหรับการรีเซ็ตรหัสผ่าน
     */
    public function create(Request $request): Response
    {
        return Inertia::render('Auth/ResetPassword', [
            'email' => $request->email,
            'token' => $request->route('token'),
        ]);
    }

    /**
     * จัดการคำขอรหัสผ่านใหม่ที่เข้ามา
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Here we will attempt to reset the user's password.
        // หากแปลไทย: "ที่นี่ เราจะพยายามรีเซ็ตรหัสผ่านของผู้ใช้"

        // If it is successful we will update the password on an actual user model and persist it to the database.
        // หากแปลไทย: "หากสำเร็จ เราจะอัปเดตรหัสผ่านในโมเดลผู้ใช้จริง และบันทึกลงในฐานข้อมูล"

        // Otherwise we will parse the error and return the response.
        // หากแปลไทย: "มิฉะนั้น เราจะวิเคราะห์ข้อผิดพลาดและส่งการตอบกลับ"
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        // If the password was successfully reset, we will redirect the user back to
        // หากแปลไทย: "หากการรีเซ็ตรหัสผ่านสำเร็จ เราจะเปลี่ยนเส้นทางผู้ใช้กลับไปยัง"

        // the application's home authenticated view.
        // หากแปลไทย: "หน้าหลักของแอปพลิเคชันที่ผู้ใช้เข้าสู่ระบบแล้ว"

        // If there is an error we can redirect them back to where they came from with their error message.
        // หากแปลไทย: "หากเกิดข้อผิดพลาด เราจะเปลี่ยนเส้นทางผู้ใช้กลับไปยังที่เดิมพร้อมกับข้อความแสดงข้อผิดพลาด"

        if ($status == Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('status', __($status));
        }

        throw ValidationException::withMessages([
            'email' => [trans($status)],
        ]);
    }
}
