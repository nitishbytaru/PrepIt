<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-900 leading-tight text-center animate-fade-in">
            <span class="text-gradient">My Learning Goals</span>
        </h2>
    </x-slot>

    <div class="max-w-6xl mx-auto p-8 bg-white rounded-xl shadow-xl mt-6 animate-scale-in">
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg mb-6 animate-fade-in">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-semibold text-indigo-800">Your active learning paths</h3>
            <a href="{{ route('goals.create') }}" class="btn-primary flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                        clip-rule="evenodd" />
                </svg>
                Create New Goal
            </a>
        </div>

        @if ($goals->isEmpty())
            <div class="knowledge-card p-8 text-center animate-fade-in">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-indigo-300 mb-4" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <h3 class="text-xl font-semibold text-indigo-800 mb-2">No Learning Goals Yet</h3>
                <p class="text-gray-600 mb-6">Create your first learning goal to get started on your educational
                    journey!</p>
                <a href="{{ route('goals.create') }}" class="btn-primary inline-flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    Create Your First Goal
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($goals as $index => $goal)
                    <div class="bg-white rounded-xl shadow-md border border-indigo-100 overflow-hidden hover:shadow-lg transition-all duration-300 animate-fade-in flex flex-col"
                        style="animation-delay: {{ $index * 100 }}ms">
                        <div class="p-5 border-b border-indigo-100">
                            <div class="flex justify-between items-start">
                                <h3 class="text-lg font-bold text-indigo-800 mb-2">{{ $goal->title }}</h3>
                                <span
                                    class="px-3 py-1 rounded-full text-xs font-bold text-white 
                                    {{ $goal->priority === 'High' ? 'bg-red-500' : ($goal->priority === 'Medium' ? 'bg-amber-500' : 'bg-emerald-500') }}">
                                    {{ $goal->priority }}
                                </span>
                            </div>

                            <div class="flex items-center text-sm text-gray-600 mt-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-indigo-500"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                {{ \Carbon\Carbon::parse($goal->start_date)->format('d M Y') }} -
                                {{ \Carbon\Carbon::parse($goal->end_date)->format('d M Y') }}
                            </div>
                        </div>

                        <div class="p-5 bg-indigo-50 flex-grow">
                            <div class="grid grid-cols-2 gap-3 mb-4">
                                <div class="bg-white p-3 rounded-lg shadow-sm">
                                    <span class="text-xs text-gray-500 block">Duration</span>
                                    <span class="text-lg font-semibold text-indigo-700">{{ $goal->duration }}</span>
                                </div>
                                <div class="bg-white p-3 rounded-lg shadow-sm">
                                    <span class="text-xs text-gray-500 block">Total Hours</span>
                                    <span class="text-lg font-semibold text-indigo-700">{{ $goal->total_hours }}</span>
                                </div>
                            </div>

                            <div class="bg-white p-3 rounded-lg shadow-sm mb-4">
                                <span class="text-xs text-gray-500 block">Weekly Commitment</span>
                                <div class="flex items-center">
                                    <span
                                        class="text-lg font-semibold text-indigo-700">{{ $goal->time_per_week }}</span>
                                    <span class="text-sm text-gray-600 ml-1">hours/week</span>
                                </div>
                            </div>

                            <!-- Progress Bar (Visual Representation) -->
                            @php
                                // Calculate progress percentage based on dates
                                $startDate = \Carbon\Carbon::parse($goal->start_date);
                                $endDate = \Carbon\Carbon::parse($goal->end_date);
                                $today = \Carbon\Carbon::now();

                                $totalDays = $startDate->diffInDays($endDate);
                                $daysCompleted = $startDate->diffInDays($today);

                                // Ensure percentage is between 0 and 100
                                $progressPercentage =
                                    $totalDays > 0 ? min(100, max(0, ($daysCompleted * 100) / $totalDays)) : 0;
                            @endphp

                            <div class="mb-2 flex justify-between text-xs text-gray-500">
                                <span>Progress</span>
                                <span>{{ round($progressPercentage) }}%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                <div class="h-2.5 rounded-full progress-bar" style="width: {{ $progressPercentage }}%">
                                </div>
                            </div>
                        </div>

                        <div class="p-4 bg-white border-t border-indigo-100 flex justify-end space-x-2">
                            <a href="{{ route('goals.edit', $goal->id) }}"
                                class="p-2 bg-indigo-100 text-indigo-700 rounded-md hover:bg-indigo-200 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>
                            <form action="{{ route('goals.destroy', $goal->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    onclick="return confirm('Are you sure you want to delete this goal?')"
                                    class="p-2 bg-red-100 text-red-700 rounded-md hover:bg-red-200 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6 tip-card">
                <p class="font-medium">💡 Study Tip:</p>
                <p>Keep your goals specific, measurable, achievable, relevant, and time-bound (SMART) for the best
                    results!</p>
            </div>
        @endif
    </div>
</x-app-layout>
