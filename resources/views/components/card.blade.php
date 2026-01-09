@props(['href' => '#'])

<a href="{{ $href }}"
   class="group block transform transition-all duration-500 hover:-translate-y-3 hover:scale-[1.03]">
    <div class="relative border border-gray-200 bg-white rounded-3xl shadow-lg hover:shadow-2xl
                transition-all duration-500 overflow-hidden p-8 sm:p-10 w-full max-w-2xl mx-auto">

        {{-- Subtle gradient overlay when hovered --}}
        <div class="absolute inset-0 opacity-0 group-hover:opacity-10 bg-gradient-to-r
                    from-indigo-500 via-purple-500 to-pink-500 transition-opacity duration-500 rounded-3xl">
        </div>

        {{-- Optional shine animation --}}
        <span class="absolute inset-0 bg-gradient-to-r from-transparent via-white/25 to-transparent
                     translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-700 rounded-3xl">
        </span>

        <div class="relative z-10 text-center space-y-4">
            {{ $slot }}
        </div>
    </div>
</a>
