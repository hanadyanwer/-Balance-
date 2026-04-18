<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Balance+ | Cultivate a Healthier Life')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#0B6B7A',
                        primaryDark: '#07505A',
                        accent: '#6FCF97',
                        bg: '#F6FBFC',
                    },
                    borderRadius: { '4xl': '2rem' },
                    boxShadow: { 'custom': '0 2px 12px rgba(11, 107, 122, 0.08)' }
                }
            }
        }
    </script>
    <style>
        .hamburger span {
            display: block;
            width: 24px;
            height: 2px;
            background: #0B6B7A;
            transition: 0.3s;
        }

        .hamburger.active span:nth-child(1) {
            transform: translateY(8px) rotate(45deg);
        }

        .hamburger.active span:nth-child(2) {
            opacity: 0;
        }

        .hamburger.active span:nth-child(3) {
            transform: translateY(-8px) rotate(-45deg);
        }

        .fade-in {
            animation: fadeIn 0.4s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .slide {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 1s ease-in-out;
            z-index: 0;
            pointer-events: none;
        }

        .slide.active {
            opacity: 1;
            z-index: 10;
            pointer-events: auto;
        }

        .dot.active {
            width: 2rem !important;
            background-color: white !important;
        }

        .reveal {
            animation: slideUp 0.6s ease-out forwards;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.3s ease-out;
        }
    </style>

    @yield('styles')
</head>

<body class="font-sans text-slate-900 bg-bg overflow-x-hidden flex flex-col min-h-screen pt-16">
    @include('layouts.navbar')

    <main class="flex-grow">
        @yield('content')
    </main>

    @include('layouts.footer')

    <script>
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');

        if (mobileMenuBtn) {
            mobileMenuBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }

        // Slider functionality
        let currentSlide = 0;
        const slides = document.querySelectorAll('.slide');
        const dots = document.querySelectorAll('.dot');

        window.moveSlide = function (direction) {
            if (slides.length === 0) return;
            currentSlide = (currentSlide + direction + slides.length) % slides.length;
            updateSlider();
        }

        function updateSlider() {
            slides.forEach((s, i) => s.classList.toggle('active', i === currentSlide));
            dots.forEach((d, i) => {
                if (i === currentSlide) {
                    d.classList.add('active', 'w-8', 'bg-white');
                } else {
                    d.classList.remove('active', 'w-8', 'bg-white');
                    d.classList.add('w-2', 'bg-white/50');
                }
            });
        }

        // Auto slide
        setInterval(() => {
            const sliderTrack = document.getElementById('sliderTrack');
            if (sliderTrack) {
                moveSlide(1);
            }
        }, 5000);

        // Dot clicks
        dots.forEach((dot, i) => {
            dot.addEventListener('click', () => {
                currentSlide = i;
                updateSlider();
            });
        });

        // Reveal animation on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('reveal');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.reveal').forEach(el => {
            observer.observe(el);
        });
    </script>

    @yield('scripts')
</body>

</html>
