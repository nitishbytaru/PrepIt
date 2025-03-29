<x-app-layout>
    <div class="py-12 bg-gradient-to-b from-gray-50 to-indigo-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <div class="text-center mb-8 animate__animated animate__fadeIn">
                <h1 class="text-3xl font-bold text-gray-800">Your Learning Dashboard</h1>
                <p class="text-gray-600 mt-2">Track, manage, and accomplish your academic goals</p>
            </div>

            <!-- Working Hours Card -->
            <div
                class="relative overflow-hidden bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 text-white shadow-xl rounded-xl p-8 animate__animated animate__fadeInUp">
                <div class="absolute top-0 right-0 -mt-4 -mr-4 w-32 h-32 bg-white opacity-10 rounded-full"></div>
                <div class="absolute bottom-0 left-0 -mb-8 -ml-8 w-48 h-48 bg-white opacity-10 rounded-full"></div>

                <div class="relative z-10">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
                        <div>
                            <h2 class="text-2xl font-bold mb-2 flex items-center gap-2">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Your Study Time
                            </h2>
                            <p class="text-indigo-100">Optimize your schedule for maximum productivity</p>
                        </div>

                        <button
                            class="mt-4 sm:mt-0 px-4 py-2 bg-white/20 hover:bg-white/30 rounded-lg text-sm font-medium flex items-center gap-1 transition-all group">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                </path>
                            </svg>
                            Update Schedule
                            <span class="w-0 overflow-hidden transition-all group-hover:w-4">→</span>
                        </button>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        <div
                            class="bg-white/10 rounded-lg p-4 backdrop-blur-sm hover:bg-white/20 transition-all transform hover:-translate-y-1 duration-300">
                            <h3 class="text-indigo-100 font-medium text-sm mb-1">Working Hours</h3>
                            <p class="text-2xl font-bold">{{ $totalWorkingHours }} hours</p>
                            <p class="text-xs text-indigo-100 mt-1">per week</p>
                        </div>

                        <div
                            class="bg-white/10 rounded-lg p-4 backdrop-blur-sm hover:bg-white/20 transition-all transform hover:-translate-y-1 duration-300">
                            <h3 class="text-indigo-100 font-medium text-sm mb-1">Compensation Hours</h3>
                            <p class="text-2xl font-bold">{{ $totalCompensationHours }} hours</p>
                            <p class="text-xs text-indigo-100 mt-1">per week</p>
                        </div>

                        <div
                            class="bg-white/10 rounded-lg p-4 backdrop-blur-sm hover:bg-white/20 transition-all transform hover:-translate-y-1 duration-300">
                            <h3 class="text-indigo-100 font-medium text-sm mb-1">Working Days</h3>
                            <p class="text-2xl font-bold">{{ $working_days_per_week }} days</p>
                            <p class="text-xs text-indigo-100 mt-1">per week</p>
                        </div>

                        <div
                            class="bg-white/10 rounded-lg p-4 backdrop-blur-sm hover:bg-white/20 transition-all transform hover:-translate-y-1 duration-300">
                            <h3 class="text-indigo-100 font-medium text-sm mb-1">Session Duration</h3>
                            @if ($timeslot)
                                <p class="text-2xl font-bold">{{ $timeslot->interval / 60 }} hours</p>
                                <p class="text-xs text-indigo-100 mt-1">per session</p>
                            @else
                                <p class="text-lg font-medium mt-2">Not configured</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Goals Section -->
            <div class="bg-white shadow-xl rounded-xl overflow-hidden animate__animated animate__fadeInUp"
                style="animation-delay: 0.2s;">
                <div class="border-b border-gray-100 bg-gradient-to-r from-gray-50 to-indigo-50 px-8 py-5">
                    <div class="flex justify-between items-center">
                        <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                            <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Your Academic Goals
                        </h2>

                        <button
                            class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 rounded-lg text-white text-sm font-medium flex items-center gap-1 transition-all transform hover:scale-105 shadow-md hover:shadow-lg">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Add New Goal
                        </button>
                    </div>
                </div>

                <div class="p-8">
                    @if (count($goals) > 0)
                        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach ($goals as $goal)
                                <div
                                    class="goal-card relative overflow-hidden bg-white border border-gray-100 hover:border-indigo-200 rounded-xl shadow-sm hover:shadow-md transition-all duration-300 group">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-r from-indigo-500/5 via-purple-500/5 to-pink-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    </div>

                                    <div class="px-6 py-5 relative z-10">
                                        <div class="flex items-start justify-between mb-4">
                                            <h3
                                                class="text-lg font-bold text-gray-800 group-hover:text-indigo-600 transition-colors duration-300">
                                                {{ $goal->title }}</h3>

                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                                {{ $goal->priority == 'high'
                                                    ? 'bg-red-100 text-red-800'
                                                    : ($goal->priority == 'medium'
                                                        ? 'bg-yellow-100 text-yellow-800'
                                                        : 'bg-green-100 text-green-800') }}">
                                                {{ ucfirst($goal->priority) }}
                                            </span>

                                        </div>

                                        <div class="space-y-2">
                                            <div class="flex justify-between text-sm">
                                                <span class="text-gray-500">Weekly Hours:</span>
                                                <span class="font-medium text-gray-700">{{ $goal->time_per_week }}
                                                    hrs</span>
                                            </div>

                                            <div class="flex justify-between text-sm">
                                                <span class="text-gray-500">Total Hours:</span>
                                                <span class="font-medium text-gray-700">{{ $goal->total_hours }}
                                                    hrs</span>
                                            </div>

                                            <div class="flex justify-between text-sm">
                                                <span class="text-gray-500">Daily Study:</span>
                                                <span class="font-medium text-gray-700">{{ $goal->study_hours }}h
                                                    {{ $goal->study_minutes ?: '0' }}m</span>
                                            </div>

                                            <div class="pt-2 mt-2 border-t border-gray-100">
                                                <div class="flex justify-between text-sm">
                                                    <span class="text-gray-500">Period:</span>
                                                    <span class="font-medium text-gray-700">
                                                        {{ \Carbon\Carbon::parse($goal->start_date)->format('d M Y') }}
                                                        -
                                                        {{ \Carbon\Carbon::parse($goal->end_date)->format('d M Y') }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mt-5 flex justify-between">
                                            <button
                                                class="text-xs font-medium text-indigo-600 hover:text-indigo-700 flex items-center gap-1 transition-colors">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                                    </path>
                                                </svg>
                                                Edit
                                            </button>

                                            <button
                                                class="text-xs font-medium text-gray-500 hover:text-gray-700 flex items-center gap-1 transition-colors">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                                    </path>
                                                </svg>
                                                Duplicate
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Progress indicator -->
                                    <div class="w-full h-1 bg-gray-100">
                                        <div class="h-full bg-indigo-500 rounded-r-full" style="width: 65%;"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div
                                class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-indigo-100 text-indigo-500 mb-4">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">No goals yet</h3>
                            <p class="text-gray-600 mb-6">Set your first academic goal and start tracking your progress
                            </p>
                            <button
                                class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 rounded-lg text-white font-medium transition-all transform hover:scale-105 shadow-md hover:shadow-lg">
                                Create Your First Goal
                            </button>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 animate__animated animate__fadeInUp"
                style="animation-delay: 0.4s;">
                <div
                    class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-shadow border border-gray-100">
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 rounded-lg bg-green-100 flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-600">Completed Tasks</p>
                            <p class="text-2xl font-bold text-gray-800">24</p>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-shadow border border-gray-100">
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 rounded-lg bg-blue-100 flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-600">Study Hours This Week</p>
                            <p class="text-2xl font-bold text-gray-800">18.5</p>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-shadow border border-gray-100">
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 rounded-lg bg-purple-100 flex items-center justify-center">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-600">Progress Rate</p>
                            <p class="text-2xl font-bold text-gray-800">76%</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Add scroll animations
        document.addEventListener('DOMContentLoaded', function() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        if (entry.target.classList.contains('animate__animated')) {
                            const animationClass = Array.from(entry.target.classList).find(
                                className =>
                                className.startsWith('animate__') && className !==
                                'animate__animated'
                            );
                            if (animationClass) {
                                entry.target.classList.add(animationClass);
                                observer.unobserve(entry.target);
                            }
                        }
                    }
                });
            }, {
                threshold: 0.1
            });

            document.querySelectorAll('.animate__animated').forEach(el => {
                const animationClass = Array.from(el.classList).find(className =>
                    className.startsWith('animate__') && className !== 'animate__animated'
                );
                if (animationClass) {
                    el.classList.remove(animationClass);
                    observer.observe(el);
                }
            });

            // Add hover animations to goal cards
            document.querySelectorAll('.goal-card').forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px)';
                });

                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
        });
    </script>
</x-app-layout>
