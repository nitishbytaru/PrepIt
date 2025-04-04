<x-app-layout>
    <x-slot name="header">
        <h3 class="text-xl font-semibold text-indigo-800">
            Tasks in Goal: {{ $goal->title }}
        </h3>
    </x-slot>

    <div class="max-w-5xl mx-auto p-8 bg-white rounded-xl shadow-xl mt-6 animate-scale-in">
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg mb-6 animate-fade-in">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex items-center justify-between mb-8">
            <h3 class="text-xl font-semibold text-indigo-800">Your learning journey</h3>

            <!-- Button to Generate Next 30 Days of Tasks -->
            <form action="{{ route('goals.generateMoreTasks', ['id' => $goal->id]) }}" method="POST">
                @csrf
                <button type="submit" class="btn-primary flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                            clip-rule="evenodd" />
                    </svg>
                    Generate Next 30 Days
                </button>
            </form>
        </div>

        @if (count($allTasks) > 0)
            <!-- Task Progress Summary -->
            <div class="bg-indigo-50 rounded-xl p-6 mb-8 animate-fade-in">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-center">
                    <div class="p-4 bg-white rounded-lg shadow-sm">
                        <p class="text-indigo-500 font-semibold text-sm uppercase">Completed</p>
                        <p class="text-3xl font-bold text-indigo-700">
                            {{ $allTasks->where('status', 'completed')->count() }}</p>
                    </div>
                    <div class="p-4 bg-white rounded-lg shadow-sm">
                        <p class="text-amber-500 font-semibold text-sm uppercase">Pending</p>
                        <p class="text-3xl font-bold text-amber-600">
                            {{ $allTasks->where('status', 'pending')->count() }}
                        </p>
                    </div>
                    <div class="p-4 bg-white rounded-lg shadow-sm">
                        <p class="text-slate-500 font-semibold text-sm uppercase">Total</p>
                        <p class="text-3xl font-bold text-slate-700">{{ $allTasks->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($tasksPaginated as $index => $task)
                    <a href="{{ route('tasks.edit', $task->id) }}"
                        class="knowledge-card hover:shadow-lg transition-all duration-300 animate-fade-in group"
                        style="animation-delay: {{ $index * 100 }}ms">
                        <div class="absolute top-3 right-3">
                            <span
                                class="px-3 py-1 text-xs font-bold text-white rounded-full
                                {{ $task->status === 'completed' ? 'bg-emerald-500' : ($task->status === 'pending' ? 'bg-amber-500' : 'bg-slate-500') }}">
                                {{ ucfirst($task->status) }}
                            </span>
                        </div>

                        <h3
                            class="text-lg font-bold text-indigo-800 mb-3 pr-24 group-hover:text-indigo-600 transition-colors">
                            {{ $task->title }}</h3>

                        <p class="text-sm text-gray-600 mb-4 line-clamp-2">
                            {{ $task->description ?? 'Click to add a description for this learning task.' }}
                        </p>

                        <div class="border-t border-indigo-100 pt-4 mt-auto">
                            <p class="text-sm text-gray-600 flex items-center gap-2 mb-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-indigo-500" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span>{{ \Carbon\Carbon::parse($task->planned_date)->format('d M Y') }}</span>
                            </p>
                            <p class="text-sm text-gray-600 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-indigo-500" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>{{ $task->planned_start_time }} - {{ $task->planned_end_time }}</span>
                            </p>
                        </div>

                        <div class="mt-4 flex items-center justify-end text-indigo-600 font-medium text-sm">
                            <span class="group-hover:underline">View & Edit</span>
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </div>
                    </a>
                @endforeach
                <div class="mt-6">
                    {{ $tasksPaginated->links() }}
                </div>
            </div>
        @else
            <div class="knowledge-card p-8 text-center animate-fade-in">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-indigo-300 mb-4" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                <h3 class="text-xl font-semibold text-indigo-800 mb-2">No Tasks Available Yet</h3>
                <p class="text-gray-600 mb-6">Generate your first set of learning tasks to start your educational
                    journey!</p>
                <form action="{{ route('goals.generateMoreTasks', ['id' => $goal->id]) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-primary">
                        Generate Learning Tasks
                    </button>
                </form>
            </div>
        @endif

        <div class="mt-8 tip-card animate-fade-in animate-delay-300">
            <p class="font-medium">📚 Learning Tip:</p>
            <p>Breaking down large learning goals into smaller, daily tasks can increase your productivity by up to 80%
                and significantly reduce learning anxiety.</p>
        </div>
    </div>
</x-app-layout>
