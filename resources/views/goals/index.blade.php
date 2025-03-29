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
            <div class="overflow-x-auto bg-white rounded-xl shadow-md">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white text-left">
                            <th class="p-4 font-semibold">Title</th>
                            <th class="p-4 font-semibold">Start Date</th>
                            <th class="p-4 font-semibold">End Date</th>
                            <th class="p-4 font-semibold">Duration</th>
                            <th class="p-4 font-semibold">Hours Required</th>
                            <th class="p-4 font-semibold">Hours/Week</th>
                            <th class="p-4 font-semibold">Priority</th>
                            <th class="p-4 text-center font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($goals as $index => $goal)
                            <tr class="border-b border-indigo-100 hover:bg-indigo-50 transition-colors duration-150 animate-fade-in"
                                style="animation-delay: {{ $index * 100 }}ms">
                                <td class="p-4 font-medium text-indigo-700">{{ $goal->title }}</td>
                                <td class="p-4">{{ \Carbon\Carbon::parse($goal->start_date)->format('d M Y') }}</td>
                                <td class="p-4">{{ \Carbon\Carbon::parse($goal->end_date)->format('d M Y') }}</td>
                                <td class="p-4">{{ $goal->duration }}</td>
                                <td class="p-4">{{ $goal->total_hours }}</td>
                                <td class="p-4">{{ $goal->time_per_week }}</td>
                                <td class="p-4">
                                    <span
                                        class="px-3 py-1 rounded-full text-xs font-bold text-white 
                                        {{ $goal->priority === 'High' ? 'bg-red-500' : ($goal->priority === 'Medium' ? 'bg-amber-500' : 'bg-emerald-500') }}">
                                        {{ $goal->priority }}
                                    </span>
                                </td>
                                <td class="p-4">
                                    <div class="flex justify-center space-x-3">
                                        <a href="{{ route('goals.edit', $goal->id) }}"
                                            class="p-2 bg-indigo-100 text-indigo-700 rounded-md hover:bg-indigo-200 transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('goals.destroy', $goal->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('Are you sure you want to delete this goal?')"
                                                class="p-2 bg-red-100 text-red-700 rounded-md hover:bg-red-200 transition-colors">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6 tip-card">
                <p class="font-medium">💡 Study Tip:</p>
                <p>Keep your goals specific, measurable, achievable, relevant, and time-bound (SMART) for the best
                    results!</p>
            </div>
        @endif
    </div>
</x-app-layout>
