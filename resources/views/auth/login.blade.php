<x-guest-layout>
    <div
        class="min-h-screen bg-gradient-to-br from-indigo-50 to-purple-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <div class="flex justify-center">
                <div
                    class="w-16 h-16 rounded-full bg-gradient-to-r from-indigo-500 to-purple-600 flex items-center justify-center text-white text-2xl font-bold shadow-lg animate__animated animate__fadeIn">
                    P</div>
            </div>
            <h2
                class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900 animate__animated animate__fadeIn">
                Welcome back</h2>
            <p class="mt-2 text-center text-sm text-gray-600 animate__animated animate__fadeIn">
                Sign in to continue your learning journey
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div
                class="bg-white py-8 px-6 shadow-xl rounded-xl sm:px-10 border border-gray-100 animate__animated animate__fadeInUp">
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email Address -->
                    <div class="relative group">
                        <x-input-label for="email" :value="__('Email')" class="text-gray-700 font-medium" />
                        <div class="mt-1 relative rounded-md">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400 group-focus-within:text-indigo-500 transition-colors duration-200"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                </svg>
                            </div>
                            <x-text-input id="email"
                                class="block w-full pl-10 pr-4 py-3 rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50 transition-all duration-200"
                                type="email" name="email" :value="old('email')" required autofocus
                                autocomplete="username" />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="relative group">
                        <div class="flex items-center justify-between">
                            <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-medium" />
                            @if (Route::has('password.request'))
                                <a class="text-sm text-indigo-600 hover:text-indigo-800 font-medium transition-colors duration-200"
                                    href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif
                        </div>
                        <div class="mt-1 relative rounded-md">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400 group-focus-within:text-indigo-500 transition-colors duration-200"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <x-text-input id="password"
                                class="block w-full pl-10 pr-4 py-3 rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50 transition-all duration-200"
                                type="password" name="password" required autocomplete="current-password" />
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between">
                        <label for="remember_me" class="flex items-center space-x-2">
                            <input id="remember_me" type="checkbox"
                                class="w-4 h-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 transition duration-200"
                                name="remember">
                            <span class="text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <!-- Login Button -->
                    <div>
                        <x-primary-button
                            class="w-full py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">
                            {{ __('Sign In') }}
                        </x-primary-button>
                    </div>

                    <!-- Register Link -->
                    <div class="text-center mt-6">
                        <p class="text-sm text-gray-600">
                            {{ __("Don't have an account?") }}
                            <a href="{{ route('register') }}"
                                class="font-medium text-indigo-600 hover:text-indigo-800 transition-colors duration-200">
                                {{ __('Create one now') }}
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        /* Floating animation for the logo */
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

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }

        /* Add floating animation to the logo */
        .sm\:mx-auto .w-16 {
            animation: float 3s ease-in-out infinite;
        }

        /* Form field focus effect */
        input:focus {
            box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.2);
        }
    </style>

    <script>
        // Add animations when the page loads
        document.addEventListener('DOMContentLoaded', function() {
            // Staggered animations
            const fadeElements = document.querySelectorAll('.animate__fadeIn, .animate__fadeInUp');
            fadeElements.forEach((el, index) => {
                setTimeout(() => {
                    el.classList.add('animate__animated');
                }, index * 200);
            });

            // Focus animation on input fields
            const inputs = document.querySelectorAll('input[type="email"], input[type="password"]');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.parentElement.classList.add('scale-105');
                    this.parentElement.parentElement.style.transition = 'all 0.3s ease';
                });

                input.addEventListener('blur', function() {
                    this.parentElement.parentElement.classList.remove('scale-105');
                });
            });
        });
    </script>
</x-guest-layout>
