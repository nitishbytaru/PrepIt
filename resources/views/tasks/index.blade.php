<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-900 leading-tight text-center animate-fade-in">
            <span class="text-gradient">Learning Tasks Manager</span>
        </h2>
    </x-slot>

    <div class="max-w-5xl mx-auto p-8 bg-white rounded-xl shadow-xl mt-6 animate-scale-in">
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg mb-6 animate-fade-in">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-8 text-center animate-fade-in">
            <h3 class="text-xl font-semibold text-indigo-800 mb-3">Select a Learning Goal to View Tasks</h3>
            <p class="text-gray-600 max-w-2xl mx-auto">Choose one of your learning goals below to view and manage the
                associated study tasks and track your educational progress.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($goals as $index => $goal)
                <a href="{{ route('tasks.list', $goal->id) }}"
                    class="knowledge-card text-center group animate-fade-in cursor-pointer transform transition-all duration-300 hover:scale-105"
                    style="animation-delay: {{ $index * 100 }}ms">
                    <div
                        class="h-16 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-t-lg flex items-center justify-center">
                        <span class="text-white font-bold text-lg">{{ $goal->title }}</span>
                    </div>

                    <div class="p-6">
                        <div class="flex justify-between mb-4">
                            <div class="text-left">
                                <p class="text-sm text-gray-600">Start Date</p>
                                <p class="font-medium">{{ \Carbon\Carbon::parse($goal->start_date)->format('d M Y') }}
                                </p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm text-gray-600">End Date</p>
                                <p class="font-medium">{{ \Carbon\Carbon::parse($goal->end_date)->format('d M Y') }}</p>
                            </div>
                        </div>

                        <div class="mb-4">
                            <p class="text-sm text-gray-600 mb-1">Priority</p>
                            <span
                                class="px-3 py-1 rounded-full text-xs font-bold text-white inline-block
                                {{ $goal->priority === 'High' ? 'bg-red-500' : ($goal->priority === 'Medium' ? 'bg-amber-500' : 'bg-emerald-500') }}">
                                {{ $goal->priority }}
                            </span>
                        </div>

                        <div class="mt-4 flex items-center justify-center text-indigo-600 font-medium">
                            <span class="group-hover:underline">View Tasks</span>
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 ml-1 group-hover:translate-x-1 transition-transform" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        @if ($goals->isEmpty())
            <div class="knowledge-card p-8 text-center animate-fade-in">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-indigo-300 mb-4" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="text-xl font-semibold text-indigo-800 mb-2">No Learning Goals Yet</h3>
                <p class="text-gray-600 mb-6">Create your first learning goal to get started with task management!</p>
                <a href="{{ route('goals.create') }}" class="btn-primary">
                    Create Your First Goal
                </a>
            </div>
        @endif

        <div class="mt-8 note-card animate-fade-in animate-delay-300">
            <p class="font-medium">📚 Learning Strategy:</p>
            <p>Breaking down your goals into manageable tasks makes learning more efficient and less overwhelming. Focus
                on consistent daily progress!</p>
        </div>
    </div>
</x-app-layout>
