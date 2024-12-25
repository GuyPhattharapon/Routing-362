<?php

namespace App\Policies;

use App\Models\Chirp;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ChirpPolicy
{
    /**
     * ตรวจสอบว่าผู้ใช้สามารถดูโมเดลใดๆ ได้หรือไม่
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * ตรวจสอบว่าผู้ใช้สามารถดูแบบจำลองได้หรือไม่
     */
    public function view(User $user, Chirp $chirp): bool
    {
        return false;
    }

    /**
     * พิจารณาว่าผู้ใช้สามารถสร้างแบบจำลองได้หรือไม่
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * ตรวจสอบว่าผู้ใช้สามารถอัปเดตโมเดลได้หรือไม่
     */
    public function update(User $user, Chirp $chirp): bool
    {
        return $chirp->user()->is($user);
    }

    /**
     *  ตรวจสอบว่าผู้ใช้สามารถลบโมเดลได้หรือไม่
     */
    public function delete(User $user, Chirp $chirp): bool
    {
        return $this->update($user, $chirp);
    }

    /**
     * ตรวจสอบว่าผู้ใช้สามารถกู้คืนโมเดลได้หรือไม่
     */
    public function restore(User $user, Chirp $chirp): bool
    {
        return false;
    }

    /**
     * ตรวจสอบว่าผู้ใช้สามารถลบโมเดลอย่างถาวรได้หรือไม่
     */
    public function forceDelete(User $user, Chirp $chirp): bool
    {
        return false;
    }
}
