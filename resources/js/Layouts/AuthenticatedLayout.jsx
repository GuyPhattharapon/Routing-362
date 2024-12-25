import ApplicationLogo from '@/Components/ApplicationLogo';
import Dropdown from '@/Components/Dropdown';
import NavLink from '@/Components/NavLink';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink';
import { Link, usePage } from '@inertiajs/react';
import { useState } from 'react';

export default function AuthenticatedLayout({ header, children }) {
    const user = usePage().props.auth.user; // ดึงข้อมูลผู้ใช้ที่ล็อกอินมาจาก Inertia.js

    const [showingNavigationDropdown, setShowingNavigationDropdown] =
        useState(false); // สถานะการแสดงเมนูนำทางบนมือถือ

    return (
        <div className="min-h-screen bg-gray-100">
            <nav className="border-b border-gray-100 bg-white">
                <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div className="flex h-16 justify-between">
                        <div className="flex">
                            <div className="flex shrink-0 items-center">
                                <Link href="/">
                                    <ApplicationLogo className="block h-9 w-auto fill-current text-gray-800" />
                                </Link>
                            </div>

                            <div className="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                                {/* แสดงลิงก์ที่ใช้ในเมนูหลัก เป็นลิงก์ ที่เชื่อมกับเมนู Dashboard และ Chirps */}
                                <NavLink
                                    href={route('dashboard')}
                                    active={route().current('dashboard')}
                                >
                                    Dashboard
                                </NavLink>
                                <NavLink
                                    href={route('chirps.index')}
                                    active={route().current('chirps.index')}
                                >
                                    Chirps
                                </NavLink>
                                <NavLink
                                    href={route('products.index')} // กำหนดเส้นทางไปยังหน้า Products
                                    active={route().current('products.index')}
                                >
                                    Products
                                </NavLink>
                            </div>
                        </div>

                        {/* เมนูดรอปดาวน์สำหรับ User */}
                        <div className="hidden sm:ms-6 sm:flex sm:items-center">
                            <div className="relative ms-3">
                                <Dropdown>
                                    <Dropdown.Trigger>
                                        <span className="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                className="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none"
                                            >
                                                {user.name}

                                                <svg
                                                    className="-me-0.5 ms-2 h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fillRule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clipRule="evenodd"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                                    </Dropdown.Trigger>

                                    <Dropdown.Content>
                                        {' '}
                                        {/* ลิงก์ในเมนูดรอปดาวน์ */}
                                        <Dropdown.Link
                                            href={route('profile.edit')}
                                        >
                                            {/* Dropdown สำหรับ Profile */}
                                            Profile
                                        </Dropdown.Link>
                                        <Dropdown.Link
                                            href={route('logout')}
                                            method="post"
                                            as="button"
                                        >
                                            {' '}
                                            {/* Dropdown สำหรับ Log out */}
                                            Log Out
                                        </Dropdown.Link>
                                    </Dropdown.Content>
                                </Dropdown>
                            </div>
                        </div>

                        {/* เมนูนำทางที่แสดงบนมือถือ */}
                        <div className="-me-2 flex items-center sm:hidden">
                            <button
                                onClick={() =>
                                    setShowingNavigationDropdown(
                                        (previousState) => !previousState,
                                    )
                                }
                                className="inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-500 focus:bg-gray-100 focus:text-gray-500 focus:outline-none"
                            >
                                <svg
                                    className="h-6 w-6"
                                    stroke="currentColor"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        className={
                                            !showingNavigationDropdown
                                                ? 'inline-flex'
                                                : 'hidden'
                                        }
                                        strokeLinecap="round"
                                        strokeLinejoin="round"
                                        strokeWidth="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        className={
                                            showingNavigationDropdown
                                                ? 'inline-flex'
                                                : 'hidden'
                                        }
                                        strokeLinecap="round"
                                        strokeLinejoin="round"
                                        strokeWidth="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div
                    className={
                        (showingNavigationDropdown ? 'block' : 'hidden') +
                        ' sm:hidden'
                    }
                >
                    <div className="space-y-1 pb-3 pt-2">
                        <ResponsiveNavLink
                            href={route('dashboard')}
                            active={route().current('dashboard')}
                        >
                            {/* Dropdown สำหรับ Dashboard */}
                            Dashboard
                        </ResponsiveNavLink>
                        <ResponsiveNavLink
                            href={route('chirps.index')}
                            active={route().current('chirps.index')}
                        >
                            Chirps
                        </ResponsiveNavLink>
                        <ResponsiveNavLink
                            href={route('products.index')} // เพิ่มลิงก์ Products
                            active={route().current('products.index')}
                        >
                            Products
                        </ResponsiveNavLink>
                    </div>

                    <div className="border-t border-gray-200 pb-1 pt-4">
                        <div className="px-4">
                            <div className="text-base font-medium text-gray-800">
                                {user.name}
                            </div>
                            <div className="text-sm font-medium text-gray-500">
                                {user.email}
                            </div>
                        </div>

                        <div className="mt-3 space-y-1">
                            <ResponsiveNavLink href={route('profile.edit')}>
                                {/* Dropdown สำหรับ profile */}
                                Profile
                            </ResponsiveNavLink>
                            <ResponsiveNavLink
                                method="post"
                                href={route('logout')}
                                as="button"
                            >
                                {/* Dropdown สำหรับ Log out */}
                                Log Out
                            </ResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </nav>
            {/* ถ้ามี header ให้แสดง */}
            {header && (
                <header className="bg-white shadow">
                    <div className="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                        {header}
                    </div>
                </header>
            )}
            <main>{children}</main> {/* แสดงเนื้อหาหลักของหน้า */}
        </div>
    );

    //Navigation Bar:
    //มีลิงก์นำทางไปยังหน้าหลัก (Dashboard) และ Chirps.
    //มีเมนูดรอปดาวน์ที่แสดงชื่อผู้ใช้ และมีตัวเลือกสำหรับ "Profile" และ "Log Out".
    //เมื่ออยู่บนอุปกรณ์พกพา (มือถือ), จะมีเมนูที่สามารถเปิด-ปิดได้ (โดยใช้ปุ่มแฮมเบอร์เกอร์).

    //Dropdown for Logged-In User:
    //เมื่อผู้ใช้ล็อกอินแล้ว จะแสดงชื่อผู้ใช้ในเมนูดรอปดาวน์.
    //ผู้ใช้สามารถเข้าถึงโปรไฟล์หรือออกจากระบบได้จากเมนูนี้.

    //Mobile Navigation:
    //เมื่อขนาดหน้าจอลดลง (บนมือถือ), เมนูจะถูกซ่อนและสามารถเปิดได้ด้วยปุ่มแฮมเบอร์เกอร์.
    //ใช้ ResponsiveNavLink สำหรับลิงก์ที่แสดงผลบนมือถือ.

    //Header and Children:
    //ถ้ามี header จะถูกแสดงเหนือส่วนเนื้อหาหลัก.
    //ส่วน children จะเป็นเนื้อหาหลักที่ถูกส่งเข้ามาใน AuthenticatedLayout.
    //การทำงานหลักของคอมโพเนนต์นี้คือการแสดงเมนูนำทางที่เหมาะสมกับอุปกรณ์ที่ใช้ และจัดการกับการแสดงข้อมูลผู้ใช้ที่ล็อกอินแล้ว.
}
