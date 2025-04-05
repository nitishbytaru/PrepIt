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

        <!-- Tasks Calendar View -->
        <div class="mb-8">
            <h3 class="text-lg font-semibold text-indigo-800 mb-4">This Week's Schedule</h3>
            <div class="grid grid-cols-7 gap-2 text-center">
                @php
                    $today = \Carbon\Carbon::now();
                    $startOfWeek = $today->copy()->startOfWeek()->addWeeks($weekOffset);
                    $weekDays = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
                @endphp

                <!-- Previous Week Button -->
                <a href="{{ route('todaytasks.index', ['week' => $weekOffset - 1]) }}"
                    class="p-2 bg-gray-200 rounded-md hover:bg-gray-300">&lt;</a>

                @foreach ($weekDays as $index => $day)
                    @php
                        $currentDate = $startOfWeek->copy()->addDays($index)->format('Y-m-d');
                        $hasTask = $tasks->where('planned_date', $currentDate)->count() > 0;
                        $isToday = \Carbon\Carbon::now()->format('Y-m-d') === $currentDate;
                    @endphp
                    <a href="{{ route('todaytasks.index', ['date' => $currentDate]) }}"
                        class="block border rounded-lg p-2 transition-all duration-300 hover:shadow-md
                        {{ $isToday ? 'bg-indigo-100 border-indigo-300' : ($hasTask ? 'bg-white border-indigo-200' : 'bg-gray-50 border-gray-200') }}
                        {{ $hasTask ? 'hover:border-indigo-400' : '' }}">
                        <p class="text-xs font-semibold {{ $isToday ? 'text-indigo-800' : 'text-gray-600' }}">
                            {{ $day }}</p>
                        <p class="text-sm {{ $isToday ? 'text-indigo-800 font-bold' : 'text-gray-800' }}">
                            {{ \Carbon\Carbon::parse($currentDate)->format('d') }}</p>
                        @if ($hasTask)
                            <div class="mt-1 w-2 h-2 bg-indigo-500 rounded-full mx-auto"></div>
                        @endif
                    </a>
                @endforeach

                <!-- Next Week Button -->
                <a href="{{ route('todaytasks.index', ['week' => $weekOffset + 1]) }}"
                    class="p-2 bg-gray-200 rounded-md hover:bg-gray-300">&gt;</a>
            </div>
        </div>

        @if (count($tasks) > 0)

            <!-- Task Progress Summary -->
            <div class="bg-indigo-50 rounded-xl p-6 mb-8 animate-fade-in">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-center">
                    <div class="p-4 bg-white rounded-lg shadow-sm">
                        <p class="text-indigo-500 font-semibold text-sm uppercase">Completed</p>
                        <p class="text-3xl font-bold text-indigo-700">
                            {{ $tasks->where('status', 'complete')->count() }}</p>
                    </div>
                    <div class="p-4 bg-white rounded-lg shadow-sm">
                        <p class="text-amber-500 font-semibold text-sm uppercase">Pending</p>
                        <p class="text-3xl font-bold text-amber-600">{{ $tasks->where('status', 'pending')->count() }}
                        </p>
                    </div>
                    <div class="p-4 bg-white rounded-lg shadow-sm">
                        <p class="text-slate-500 font-semibold text-sm uppercase">Total</p>
                        <p class="text-3xl font-bold text-slate-700">{{ $tasks->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($tasks as $index => $task)
                    <div class="knowledge-card hover:shadow-lg transition-all duration-300 animate-fade-in group"
                        style="animation-delay: {{ $index * 100 }}ms">
                        <div class="absolute top-3 right-3">
                            <span
                                class="px-3 py-1 text-xs font-bold text-white rounded-full
                             {{ $task->statusColor() }}">
                                {{ ucfirst($task->status->value) }}
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

                        <!-- Action Buttons -->
                        @php
                            $status = $task->status->value;
                            $showComplete = in_array($status, ['pending', 'postpone']);
                            $showPostpone = in_array($status, ['pending', 'postpone']);
                            $showDismiss = in_array($status, ['pending', 'postpone', 'complete']);
                            $buttonCount = ($showComplete ? 1 : 0) + ($showPostpone ? 1 : 0) + ($showDismiss ? 1 : 0);
                        @endphp

                        <div class="grid grid-cols-{{ $buttonCount }} gap-4 mt-8 animate-fade-in animate-delay-200">
                            @if ($showComplete)
                                <!-- Mark Complete -->
                                <form action="{{ route('tasks.finish', $task->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                        class="w-full bg-emerald-500 hover:bg-emerald-600 text-white py-2.5 px-4 rounded-lg shadow-md hover:shadow-lg transition-all">
                                        ✅ Mark Complete
                                    </button>
                                </form>
                            @endif

                            @if ($showPostpone)
                                <!-- Postpone -->
                                <form action="{{ route('tasks.postpone', $task->id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="w-full bg-amber-500 hover:bg-amber-600 text-white py-2.5 px-4 rounded-lg shadow-md hover:shadow-lg transition-all">
                                        ⏳ Postpone
                                    </button>
                                </form>
                            @endif

                            @if ($showDismiss)
                                <!-- Dismiss -->
                                <form action="{{ route('tasks.dismiss', $task->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="w-full bg-red-500 hover:bg-red-600 text-white py-2.5 px-4 rounded-lg shadow-md hover:shadow-lg transition-all"
                                        onclick="return confirm('Are you sure?')">
                                        ❌ Dismiss
                                    </button>
                                </form>
                            @endif
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
                ndjkfbjhvbflqbewegvbdf;yisdvbiyfvbsdi;yfgvbsuyfvbsukdfsdvfdvfdghv
            </div>
        @endif
    </div>
</x-app-layout>
