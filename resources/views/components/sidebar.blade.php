@yield('sidebar')
<aside id="logo-sidebar" class="w-min px-5 bg-white border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700"
    aria-label="Sidebar">
    <div class="h-full py-8 bg-white dark:bg-gray-800">
        <ul class="space-y-4 font-medium">
            @php
                $dashboardType = session('dashboardType', 'default');
                $dashboardUrl =
                    $dashboardType == 'tugas-akhir' ? 'admin/dashboard/tugas-akhir' : 'admin/dashboard/rumah-jamur';
            @endphp

            <li>
                <a href="{{ url($dashboardUrl) }}"
                    class="flex items-center px-6 py-3 {{ request()->is('admin/dashboard*') ? 'text-white bg-blue-700' : 'text-gray-700 hover:text-white' }} rounded-lg dark:text-white hover:bg-gray-400 dark:hover:bg-gray-700 group-hover:text-gray-900">
                    {{-- svg --}}
                    <svg class="flex-shrink-0 w-5 h-5 {{ request()->is('admin/dashboard*') ? 'text-white' : 'text-gray-700 hover:text-white' }} transition duration-75 dark:text-white group-hover:text-gray-900 dark:group-hover:text-white"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                        <path
                            d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z" />
                    </svg>
                    <span class="ms-3">Dashboard</span>
                </a>
            </li>
            {{-- <li>
                <a href='/admin/history/tugas-akhir'
                    class="flex items-center px-6 py-3 {{ request()->is('admin/history/tugas-akhir') ? 'text-white bg-blue-700' : 'text-gray-700 hover:text-white' }} rounded-lg dark:text-white hover:bg-gray-400 dark:hover:bg-gray-700 group-hover:text-gray-900">
                    <svg class="w-5 h-5 transition duration-75 {{ request()->is('admin/history') ? 'text-white' : 'text-gray-500 hover:text-white' }} transition duration-75 dark:text-white group-hover:text-gray-900 dark:group-hover:text-white"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                        <path
                            d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                        <path
                            d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">History</span>
                </a>
            </li> --}}
        </ul>
    </div>
</aside>
