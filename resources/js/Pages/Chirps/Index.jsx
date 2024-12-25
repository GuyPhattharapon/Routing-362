import React from 'react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout'; // นำเข้า layout ที่ใช้สำหรับหน้าที่ผู้ใช้ล็อกอิน
import Chirp from '@/Components/Chirp'; // นำเข้า Component สำหรับแสดง Chirp (ข้อความ)
import InputError from '@/Components/InputError'; // นำเข้า Component สำหรับแสดงข้อผิดพลาดจากฟอร์ม
import PrimaryButton from '@/Components/PrimaryButton'; // นำเข้า Component สำหรับปุ่มหลัก
import { useForm, Head } from '@inertiajs/react'; // นำเข้า hook 'useForm' และ component 'Head' จาก Inertia.js


export default function Index({ auth, chirps }) {
    const { data, setData, post, processing, reset, errors } = useForm({
        message: '', // กำหนดค่าเริ่มต้นของ data ที่จะใช้ในฟอร์ม
    });
        //data: ข้อมูลที่กรอกในฟอร์ม (ในที่นี้คือ message).
        //setData: ฟังก์ชันสำหรับอัปเดตข้อมูลในฟอร์ม.
        //post: ฟังก์ชันที่ใช้สำหรับส่งข้อมูลฟอร์มไปยังเซิร์ฟเวอร์.
        //processing: สถานะการประมวลผลของคำขอ (เช่น กำลังส่งข้อมูล).
        //reset: ฟังก์ชันสำหรับรีเซ็ตข้อมูลในฟอร์มหลังจากส่งข้อมูลแล้ว.
        //errors: ข้อผิดพลาดที่เกิดขึ้นจากการตรวจสอบข้อมูลฟอร์ม


    const submit = (e) => {
        e.preventDefault(); // ป้องกันการรีเฟรชหน้าเมื่อฟอร์มถูกส่ง
        post(route('chirps.store'), { onSuccess: () => reset() }); // ส่งข้อมูลฟอร์มไปยังเซิร์ฟเวอร์และรีเซ็ตฟอร์มหลังจากสำเร็จ
    };
        //เมื่อฟอร์มถูกส่ง จะป้องกันการรีเฟรชหน้า (e.preventDefault()).
        //ข้อมูลจะถูกส่งไปยังเส้นทางที่กำหนด (ในที่นี้คือ chirps.store) โดยใช้ post.
        //เมื่อการส่งข้อมูลสำเร็จ ฟอร์มจะถูกรีเซ็ต (reset()).

    return (
        <AuthenticatedLayout>
            <Head title="Chirps" />  {/* กำหนดชื่อหัวเรื่องของหน้าเว็บ */}

            <div className="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
                <form onSubmit={submit}>  {/* ฟอร์มที่เมื่อส่งจะเรียกใช้ฟังก์ชัน submit */}
                    <textarea
                        value={data.message}  // กำหนดค่าของ textarea จาก data.message
                        placeholder="What's on your mind?"  // ข้อความ placeholder
                        className="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                        onChange={e => setData('message', e.target.value)} // เมื่อกรอกข้อมูลจะอัปเดต data.message
                    ></textarea>
                    <InputError message={errors.message} className="mt-2" /> {/* แสดงข้อผิดพลาดหากมี */}
                    <PrimaryButton className="mt-4" disabled={processing}>Chirp</PrimaryButton> {/* ปุ่มส่งข้อความ */}
                </form>
                <div className="mt-6 bg-white shadow-sm rounded-lg divide-y">
                    {chirps.map(chirp =>
                        <Chirp key={chirp.id} chirp={chirp} /> // แสดง Chirp แต่ละรายการจากข้อมูลใน chirps
                    )}
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
        // ใช้ AuthenticatedLayout เพื่อห่อหุ้มเนื้อหาในหน้า ซึ่งหมายถึงผู้ใช้ต้องล็อกอินแล้วถึงจะเข้าถึงหน้านี้ได้
        // Head ใช้เพื่อกำหนดชื่อหัวเรื่องของหน้าเป็น "Chirps"
        // ฟอร์มมี textarea สำหรับกรอกข้อความ, เมื่อกรอกข้อมูลใหม่จะอัปเดตค่าใน data.message.
        // เมื่อฟอร์มถูกส่ง จะเรียกใช้ฟังก์ชัน submit.
        // แสดงปุ่ม Chirp ที่จะส่งข้อมูลไปยังเซิร์ฟเวอร์.
        // ข้อความแสดงข้อผิดพลาด (เช่น หากไม่ได้กรอกข้อความ) จะแสดงขึ้นใน InputError.
        // หลังจากนั้นจะมีการแสดงรายการ Chirp จาก chirps โดยใช้ Chirp Component.
        // สรุปการทำงาน:
        // ฟอร์มใช้ useForm จาก Inertia เพื่อจัดการข้อมูลและการส่งข้อมูล.
        // เมื่อส่งข้อมูล, ข้อความที่ผู้ใช้กรอกจะถูกส่งไปยังเซิร์ฟเวอร์และหากสำเร็จ ฟอร์มจะถูกรีเซ็ต.
        // หลังจากนั้นจะมีการแสดงรายการ Chirps ที่ถูกสร้างขึ้นแล้วจากฐานข้อมูล.
