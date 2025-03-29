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
                Start your learning journey</h2>
            <p class="mt-2 text-center text-sm text-gray-600 animate__animated animate__fadeIn">
                Create an account to organize your academic goals
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div
                class="bg-white py-8 px-6 shadow-xl rounded-xl sm:px-10 border border-gray-100 animate__animated animate__fadeInUp">
                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf

                    <!-- Name -->
                    <div class="relative group">
                        <x-input-label for="name" :value="__('Full Name')" class="text-gray-700 font-medium" />
                        <div class="mt-1 relative rounded-md">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400 group-focus-within:text-indigo-500 transition-colors duration-200"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <x-text-input id="name"
                                class="block w-full pl-10 pr-4 py-3 rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50 transition-all duration-200"
                                type="text" name="name" :value="old('name')" required autofocus
                                autocomplete="name" />
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

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
                                type="email" name="email" :value="old('email')" required autocomplete="username" />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="relative group">
                        <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-medium" />
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
                                type="password" name="password" required autocomplete="new-password" />
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="relative group">
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')"
                            class="text-gray-700 font-medium" />
                        <div class="mt-1 relative rounded-md">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400 group-focus-within:text-indigo-500 transition-colors duration-200"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <x-text-input id="password_confirmation"
                                class="block w-full pl-10 pr-4 py-3 rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50 transition-all duration-200"
                                type="password" name="password_confirmation" required autocomplete="new-password" />
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <!-- Form Actions -->
                    <div class="flex flex-col space-y-4">
                        <x-primary-button
                            class="w-full py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">
                            {{ __('Create Account') }}
                        </x-primary-button>

                        <div class="text-center">
                            <p class="text-sm text-gray-600">
                                {{ __('Already have an account?') }}
                                <a href="{{ route('login') }}"
                                    class="font-medium text-indigo-600 hover:text-indigo-800 transition-colors duration-200">
                                    {{ __('Sign in instead') }}
                                </a>
                            </p>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Floating decoration elements -->
        <div
            class="hidden lg:block absolute top-20 right-20 w-32 h-32 bg-purple-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-float">
        </div>
        <div class="hidden lg:block absolute bottom-20 left-20 w-32 h-32 bg-blue-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-float"
            style="animation-delay: 2s;"></div>
    </div>

    <style>
        /* Floating animation for the logo and decoration elements */
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

        /* Password strength indicator */
        .password-strength {
            height: 4px;
            transition: width 0.3s ease;
        }
    </style>

    <script>
        // Add animations when the page loads
        document.addEventListener('DOMContentLoaded', function() {
            // Staggered animations for elements
            const fadeElements = document.querySelectorAll('.animate__fadeIn, .animate__fadeInUp');
            fadeElements.forEach((el, index) => {
                setTimeout(() => {
                    el.classList.add('animate__animated');
                }, index * 200);
            });

            // Focus animation on input fields
            const inputs = document.querySelectorAll('input');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.parentElement.classList.add('scale-105');
                    this.parentElement.parentElement.style.transition = 'all 0.3s ease';
                });

                input.addEventListener('blur', function() {
                    this.parentElement.parentElement.classList.remove('scale-105');
                });
            });

            // Simple password strength indicator (for demonstration)
            const passwordInput = document.getElementById('password');
            if (passwordInput) {
                // Create the strength indicator element
                const strengthIndicator = document.createElement('div');
                strengthIndicator.className = 'mt-1 bg-gray-200 rounded-full overflow-hidden';
                strengthIndicator.innerHTML =
                    '<div class="password-strength bg-red-500" style="width: 0%; height: 4px;"></div>';

                // Insert it after the password input
                passwordInput.parentElement.parentElement.appendChild(strengthIndicator);

                // Update the strength indicator when the password changes
                passwordInput.addEventListener('input', function() {
                    const value = this.value;
                    const strengthBar = strengthIndicator.querySelector('.password-strength');

                    let strength = 0;
                    if (value.length >= 8) strength += 25;
                    if (value.match(/[A-Z]/)) strength += 25;
                    if (value.match(/[0-9]/)) strength += 25;
                    if (value.match(/[^A-Za-z0-9]/)) strength += 25;

                    strengthBar.style.width = strength + '%';

                    if (strength <= 25) {
                        strengthBar.className = 'password-strength bg-red-500';
                    } else if (strength <= 50) {
                        strengthBar.className = 'password-strength bg-orange-500';
                    } else if (strength <= 75) {
                        strengthBar.className = 'password-strength bg-yellow-500';
                    } else {
                        strengthBar.className = 'password-strength bg-green-500';
                    }
                });
            }
        });
    </script>
</x-guest-layout>
