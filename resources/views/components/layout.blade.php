<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Student Evaluation and Management System for tracking academic performance and records" />
    <meta name="author" content="Your Institution Name" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Student Evaluation System' }}</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/favicon.ico">

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js (for interactive components) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Additional Styles -->
    <style>
        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }

        /* Custom scrollbar for webkit browsers */
        ::-webkit-scrollbar {
            width: 10px;
            height: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #7c3aed;
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #6d28d9;
        }

        /* Loading animation */
        .page-loading {
            opacity: 0;
            animation: fadeIn 0.3s ease-in forwards;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }
    </style>

    <!-- Additional Head Content -->
    @stack('head')
</head>

<body class="min-h-screen bg-gray-50 text-gray-900 antialiased">

<!-- Skip to main content (accessibility) -->
<a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 bg-violet-600 text-white px-4 py-2 rounded-lg z-50">
    Skip to main content
</a>

<!-- Navigation -->
<x-nav></x-nav>

<!-- Main Content -->
<main id="main-content" class="page-loading">
    {{ $slot }}
</main>

<!-- Footer (Optional) -->
@if(!isset($hideFooter))
    <footer class="bg-white border-t border-gray-200 mt-auto">
        <div class="max-w-7xl mx-auto px-6 py-4">
            <div class="text-center text-sm text-gray-600">
                <p>&copy; {{ date('Y') }} Student Evaluation System. All rights reserved.</p>
            </div>
        </div>
    </footer>
@endif

<!-- Toast Notification Container (Global) -->
<div id="toast-container" class="fixed top-20 right-6 z-50 space-y-2"></div>

<!-- Back to Top Button -->
<button
    onclick="window.scrollTo({top: 0, behavior: 'smooth'})"
    class="fixed bottom-6 right-6 bg-violet-600 hover:bg-violet-700 text-white p-3 rounded-full shadow-lg transition transform hover:scale-110 opacity-0 pointer-events-none"
    id="backToTop"
    aria-label="Back to top">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
    </svg>
</button>

<!-- Global Scripts -->
<script>
    // Back to top button visibility
    window.addEventListener('scroll', function() {
        const backToTop = document.getElementById('backToTop');
        if (window.pageYOffset > 300) {
            backToTop.classList.remove('opacity-0', 'pointer-events-none');
        } else {
            backToTop.classList.add('opacity-0', 'pointer-events-none');
        }
    });

    // Global toast notification function
    function showToast(message, type = 'success') {
        const container = document.getElementById('toast-container');
        const toast = document.createElement('div');

        const colors = {
            success: 'bg-green-500',
            error: 'bg-red-500',
            warning: 'bg-yellow-500',
            info: 'bg-blue-500'
        };

        const icons = {
            success: '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>',
            error: '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>',
            warning: '<path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>',
            info: '<path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>'
        };

        toast.className = `${colors[type]} text-white px-6 py-3 rounded-lg shadow-xl font-semibold flex items-center gap-2 transform transition-all duration-300 translate-x-full`;
        toast.innerHTML = `
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    ${icons[type]}
                </svg>
                ${message}
            `;

        container.appendChild(toast);

        // Animate in
        setTimeout(() => {
            toast.classList.remove('translate-x-full');
        }, 100);

        // Remove after 3 seconds
        setTimeout(() => {
            toast.classList.add('translate-x-full');
            setTimeout(() => {
                container.removeChild(toast);
            }, 300);
        }, 3000);
    }

    // Expose globally
    window.showToast = showToast;
</script>

<!-- Additional Scripts -->
@stack('scripts')

</body>
</html>









{{--<!doctype html>--}}
{{--<html>--}}
{{--<head>--}}
{{--    <title>Student Evaluation System</title>--}}
{{--    <meta charset="utf-8" />--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1.0" />--}}


{{--    @vite(['resources/css/app.css', 'resources/js/app.js'])--}}

{{--</head>--}}
{{--<body class="bg-violet-200 h-full text-black">--}}
{{--<x-nav></x-nav>--}}

{{--    {{$slot}}--}}

{{--</body>--}}
{{--</html>--}}
