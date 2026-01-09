<x-layout>
    <div class="flex min-h-screen bg-gray-50">

        <!-- Sidebar -->
        <aside class="w-64 bg-white border-r border-gray-200 flex flex-col shadow-sm">

            <!-- Sidebar Header -->
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-violet-600 to-violet-800 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-sm font-bold text-gray-800">Admin Panel</h2>
                        <p class="text-xs text-gray-500">Management</p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 p-4 space-y-1">

                <!-- Dashboard (commented but improved) -->
                <!-- <a href="/dashboard"
                   class="{{ request()->is('dashboard') ? 'bg-violet-100 text-violet-700 border-violet-600' : 'text-gray-700 hover:bg-gray-100' }} flex items-center gap-3 px-4 py-3 rounded-lg font-medium transition border-l-4 {{ request()->is('dashboard') ? 'border-violet-600' : 'border-transparent' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span>Dashboard</span>
                </a> -->

                <!-- Students Profile -->
                <a href="/dashboard/students-profile"
                   class="{{ request()->is('dashboard/students-profile') ? 'bg-violet-100 text-violet-700 border-violet-600' : 'text-gray-700 hover:bg-gray-100' }} flex items-center gap-3 px-4 py-3 rounded-lg font-medium transition border-l-4 {{ request()->is('dashboard/students-profile') ? 'border-violet-600' : 'border-transparent' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    <span>Student Profiles</span>
                </a>

                <!-- Subjects -->
                <a href="/subjects"
                   class="{{ request()->is('subjects') ? 'bg-violet-100 text-violet-700 border-violet-600' : 'text-gray-700 hover:bg-gray-100' }} flex items-center gap-3 px-4 py-3 rounded-lg font-medium transition border-l-4 {{ request()->is('subjects') ? 'border-violet-600' : 'border-transparent' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                    <span>Subjects</span>
                </a>

                <!-- Class Batches -->
                <a href="/class_batch"
                   class="{{ request()->is('class_batch*') ? 'bg-violet-100 text-violet-700 border-violet-600' : 'text-gray-700 hover:bg-gray-100' }} flex items-center gap-3 px-4 py-3 rounded-lg font-medium transition border-l-4 {{ request()->is('class_batch*') ? 'border-violet-600' : 'border-transparent' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    <span>Class Batches</span>
                </a>

                <!-- Divider -->
                <div class="border-t border-gray-200 my-4"></div>


            </nav>




        </aside>

        <!-- Main Content Area -->
        <main class="flex-1 overflow-auto">
            {{ $slot }}
        </main>
    </div>
</x-layout>
