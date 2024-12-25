<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UseController extends Controller
{
    /**
     * Display a listing of the resource. คล้ายๆ หน้าแรกเว็ปช็อปปี้
     */
    public function index()
    {
        return 'User Controller is working!';
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.  เก็บข้อมูลผ่านdatabase
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource. เหมือนแสดงรายละเอียดที่เราเลือก เช่น รายละเอียดสินค้า 1 ชิ้น
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage. edit 1 เป็นฟอรม์ edit1 เป็นจัดการ ใน storage
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage. เป็นการ update ของ storage
     */
    public function destroy(User $user)
    {
        //
    }
}
