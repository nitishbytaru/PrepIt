<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.website_logo') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=outfit:400,500,600,700|poppins:400,500,600,700" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Custom animations */
        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        @keyframes pulse-border {
            0% {
                border-color: rgba(139, 92, 246, 0.5);
            }

            50% {
                border-color: rgba(139, 92, 246, 1);
            }

            100% {
                border-color: rgba(139, 92, 246, 0.5);
            }
        }

        .animate-float {
            animation: float 4s ease-in-out infinite;
        }

        .feature-card {
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
            overflow: hidden;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            border-left: 4px solid #8B5CF6;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(139, 92, 246, 0.05) 0%, rgba(16, 185, 129, 0.05) 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: -1;
        }

        .feature-card:hover::before {
            opacity: 1;
        }

        .btn-primary {
            background: linear-gradient(90deg, #8B5CF6 0%, #6366F1 100%);
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px -1px rgba(139, 92, 246, 0.2), 0 2px 4px -1px rgba(139, 92, 246, 0.06);
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 15px -3px rgba(139, 92, 246, 0.3), 0 4px 6px -2px rgba(139, 92, 246, 0.1);
        }

        .btn-outline {
            transition: all 0.3s ease;
            border: 2px solid #E5E7EB;
        }

        .btn-outline:hover {
            border-color: #8B5CF6;
            color: #8B5CF6;
        }

        .hero-gradient {
            background: linear-gradient(135deg, #F9FAFB 0%, #EEF2FF 100%);
        }

        .hero-image {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 1s ease forwards 0.5s;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .logo-text {
            background: linear-gradient(90deg, #8B5CF6 0%, #6366F1 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>

<body class="min-h-screen bg-gradient-to-b from-gray-50 to-gray-100 flex flex-col font-[outfit]">
    <header class="bg-white backdrop-blur-sm bg-opacity-90 shadow-sm py-4 sticky top-0 z-50">
        <div class="max-w-6xl mx-auto flex justify-between items-center px-6">
            <div class="flex items-center space-x-2">
                <div
                    class="w-10 h-10 rounded-lg bg-gradient-to-r from-violet-500 to-indigo-500 flex items-center justify-center text-white font-bold text-xl">
                    P</div>
                <h1 class="text-2xl font-bold logo-text">{{ config('app.website_logo') }}</h1>
            </div>

            @if (Route::has('login'))
                <nav class="flex items-center space-x-4">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="px-5 py-2.5 bg-gradient-to-r from-violet-500 to-indigo-500 text-white rounded-lg font-medium text-sm transition-all hover:shadow-lg hover:shadow-indigo-500/30 hover:-translate-y-0.5 duration-300">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="px-5 py-2.5 text-gray-700 hover:text-indigo-600 font-medium text-sm transition-colors duration-300">
                            Log in
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="px-5 py-2.5 border-2 border-indigo-500 text-indigo-500 hover:bg-indigo-500 hover:text-white rounded-lg font-medium text-sm transition-all duration-300">
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </div>
    </header>

    <main class="flex-grow flex flex-col items-center justify-center px-6 py-12">
        <div class="max-w-5xl w-full">
            <div class="text-center mb-16 animate__animated animate__fadeIn">
                <h1 class="text-5xl sm:text-6xl font-bold mb-6 text-gray-800 leading-tight">
                    Unlock Your <span class="text-indigo-600">Academic</span> Potential
                </h1>
                <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
                    PrepIt helps you organize your study schedule, track your academic goals, and maximize your
                    productivity.
                </p>
                <div class="flex flex-wrap justify-center gap-4 mb-12">
                    <a href="{{ route('register') }}"
                        class="btn-primary px-8 py-3 text-white rounded-lg font-medium text-base transition-all hover:-translate-y-1 duration-300">
                        Get Started Free
                    </a>
                    <a href="#features"
                        class="btn-outline px-8 py-3 text-gray-700 rounded-lg font-medium text-base transition-all duration-300">
                        Learn More
                    </a>
                </div>
                <div class="relative mt-8 max-w-4xl mx-auto">
                    <div
                        class="absolute -top-6 -left-6 w-24 h-24 bg-purple-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-float">
                    </div>
                    <div class="absolute -bottom-8 -right-8 w-24 h-24 bg-blue-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-float"
                        style="animation-delay: 2s;"></div>
                    <div class="relative bg-white p-4 rounded-2xl shadow-xl hero-image">
                        <img src="https://source.unsplash.com/random/1200x600/?study,education" alt="Student dashboard"
                            class="rounded-lg w-full h-auto object-cover">
                    </div>
                </div>
            </div>

            <div id="features" class="py-12">
                <h2 class="text-3xl font-bold text-center mb-12 text-gray-800 animate__animated animate__fadeIn">
                    Why Students <span class="text-indigo-600">Love PrepIt</span>
                </h2>

                <div class="grid sm:grid-cols-3 gap-8 relative">
                    <div
                        class="feature-card p-8 bg-white shadow-md rounded-xl relative z-10 animate__animated animate__fadeInUp">
                        <div
                            class="w-12 h-12 flex items-center justify-center rounded-full bg-indigo-100 text-indigo-600 mb-6">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-3 text-gray-800">Fast & Efficient</h3>
                        <p class="text-gray-600">Optimized for quick goal setting and time management. Plan your
                            semester in minutes.</p>
                    </div>

                    <div class="feature-card p-8 bg-white shadow-md rounded-xl relative z-10 animate__animated animate__fadeInUp"
                        style="animation-delay: 0.2s;">
                        <div
                            class="w-12 h-12 flex items-center justify-center rounded-full bg-indigo-100 text-indigo-600 mb-6">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-3 text-gray-800">Secure & Reliable</h3>
                        <p class="text-gray-600">Your academic goals and progress are safely stored with bank-level
                            encryption.</p>
                    </div>

                    <div class="feature-card p-8 bg-white shadow-md rounded-xl relative z-10 animate__animated animate__fadeInUp"
                        style="animation-delay: 0.4s;">
                        <div
                            class="w-12 h-12 flex items-center justify-center rounded-full bg-indigo-100 text-indigo-600 mb-6">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-3 text-gray-800">Accessible Anywhere</h3>
                        <p class="text-gray-600">Access your study plan on any device, whether you're at the library,
                            cafe, or home.</p>
                    </div>
                </div>
            </div>

            <div class="py-12 text-center">
                <h2 class="text-3xl font-bold mb-6 text-gray-800 animate__animated animate__fadeIn">Ready to Boost Your
                    Academic Success?</h2>
                <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto animate__animated animate__fadeIn">
                    Join thousands of students who have transformed their study habits with PrepIt.
                </p>
                <a href="{{ route('register') }}"
                    class="btn-primary inline-block px-8 py-3 text-white rounded-lg font-medium text-base animate__animated animate__fadeIn">
                    Create Free Account
                </a>
            </div>
        </div>
    </main>

    <footer class="bg-gray-800 text-white py-12">
        <div class="max-w-6xl mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-6 md:mb-0">
                    <div class="flex items-center space-x-2">
                        <div
                            class="w-8 h-8 rounded-lg bg-gradient-to-r from-violet-500 to-indigo-500 flex items-center justify-center text-white font-bold text-sm">
                            P</div>
                        <span class="text-xl font-bold">PrepIt</span>
                    </div>
                    <p class="text-gray-400 mt-2">Empowering academic excellence</p>
                </div>

                <div class="flex space-x-8">
                    <div>
                        <h4 class="font-semibold mb-3">About</h4>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Our
                                    Story</a></li>
                            <li><a href="#"
                                    class="text-gray-400 hover:text-white transition-colors">Features</a></li>
                            <li><a href="#"
                                    class="text-gray-400 hover:text-white transition-colors">Testimonials</a></li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="font-semibold mb-3">Support</h4>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Help
                                    Center</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Contact
                                    Us</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Privacy
                                    Policy</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>© {{ date('Y') }} PrepIt. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Add scroll animations
        document.addEventListener('DOMContentLoaded', function() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate__fadeIn');
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1
            });

            document.querySelectorAll('h2, h3, .feature-card').forEach(el => {
                el.classList.remove('animate__animated', 'animate__fadeIn', 'animate__fadeInUp');
                observer.observe(el);
            });
        });
    </script>
</body>

</html>
