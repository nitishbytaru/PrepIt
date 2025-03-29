<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-center animate-fade-in">
            <span class="text-gradient">Learning Tasks for <span
                    class="text-indigo-600">{{ $goal->title ?? 'your goals' }}</span></span>
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto p-8 bg-white rounded-xl shadow-xl mt-6 animate-scale-in">
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg mb-6 animate-fade-in">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex items-center justify-between mb-8">
            <h3 class="text-xl font-semibold text-indigo-800">Your learning sessions</h3>

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

        @if (count($tasks) > 0)
            <div class="space-y-6">
                @foreach ($tasks as $index => $task)
                    <div class="knowledge-card animate-fade-in" style="animation-delay: {{ $index * 100 }}ms">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-lg font-bold text-indigo-800">{{ $task->title }}</h3>
                            <span
                                class="px-3 py-1 text-xs font-bold text-white rounded-full
                                {{ $task->status === 'completed' ? 'bg-emerald-500' : ($task->status === 'pending' ? 'bg-amber-500' : 'bg-slate-500') }}">
                                {{ ucfirst($task->status) }}
                            </span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <p class="text-sm text-gray-600 flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-indigo-500"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span><strong>Planned Date:</strong>
                                        {{ \Carbon\Carbon::parse($task->planned_date)->format('d M Y') }}</span>
                                </p>
                                <p class="text-sm text-gray-600 flex items-center gap-2 mt-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-indigo-500"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span><strong>Planned Time:</strong> {{ $task->planned_start_time }} -
                                        {{ $task->planned_end_time }}</span>
                                </p>
                            </div>
                            <div>
                                @if ($task->actual_start_time && $task->actual_end_time)
                                    <p class="text-sm text-gray-600 flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-emerald-500"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span><strong>Actual Time:</strong> {{ $task->actual_start_time }} -
                                            {{ $task->actual_end_time }}</span>
                                    </p>
                                @endif
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-wrap gap-2">
                            <a href="{{ route('tasks.edit', $task->id) }}"
                                class="btn-outline text-sm py-1 px-3 inline-flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit
                            </a>
                            <form action="{{ route('tasks.finish', $task->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                    class="bg-emerald-500 hover:bg-emerald-600 text-white text-sm py-1 px-3 rounded-lg inline-flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    Completed
                                </button>
                            </form>
                            <form action="{{ route('tasks.postpone', $task->id) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="bg-amber-500 hover:bg-amber-600 text-white text-sm py-1 px-3 rounded-lg inline-flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Postpone
                                </button>
                            </form>
                            <form action="{{ route('tasks.dismiss', $task->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-500 hover:bg-red-600 text-white text-sm py-1 px-3 rounded-lg inline-flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    Dismiss
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
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
    </div>
</x-app-layout>
