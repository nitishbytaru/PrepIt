<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-900 leading-tight text-center animate-fade-in">
            <span class="text-gradient">Edit Learning Task</span>
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto p-8 bg-white rounded-xl shadow-xl mt-6 animate-scale-in">
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg mb-6 animate-fade-in">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('tasks.update', $task->id) }}" method="POST"
            class="space-y-6 animate-fade-in animate-delay-100">
            @csrf
            @method('PATCH')

            <div class="space-y-4">
                <!-- Task Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Task Title</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $task->title) }}"
                        class="input-field w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        required>
                </div>

                <!-- Task Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Task
                        Description</label>
                    <textarea id="description" name="description" rows="3"
                        class="input-field w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('description', $task->description) }}</textarea>
                </div>

                <!-- Planned Date & Time -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="planned_date" class="block text-sm font-medium text-gray-700 mb-1">Planned
                            Date</label>
                        <input type="date" id="planned_date" name="planned_date"
                            value="{{ old('planned_date', $task->planned_date) }}"
                            class="input-field w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            required>
                    </div>
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select id="status" name="status"
                            class="input-field w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="pending" {{ old('status', $task->status) == 'pending' ? 'selected' : '' }}>
                                Pending</option>
                            <option value="completed"
                                {{ old('status', $task->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="postponed"
                                {{ old('status', $task->status) == 'postponed' ? 'selected' : '' }}>Postponed</option>
                        </select>
                    </div>
                </div>

                <!-- Planned Time -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="planned_start_time" class="block text-sm font-medium text-gray-700 mb-1">Planned
                            Start Time</label>
                        <input type="time" id="planned_start_time" name="planned_start_time"
                            value="{{ old('planned_start_time', $task->planned_start_time) }}"
                            class="input-field w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            required>
                    </div>
                    <div>
                        <label for="planned_end_time" class="block text-sm font-medium text-gray-700 mb-1">Planned End
                            Time</label>
                        <input type="time" id="planned_end_time" name="planned_end_time"
                            value="{{ old('planned_end_time', $task->planned_end_time) }}"
                            class="input-field w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            required>
                    </div>
                </div>

                <!-- Actual Time (if completed) -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="actual_start_time" class="block text-sm font-medium text-gray-700 mb-1">Actual Start
                            Time</label>
                        <input type="time" id="actual_start_time" name="actual_start_time"
                            value="{{ old('actual_start_time', $task->actual_start_time) }}"
                            class="input-field w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div>
                        <label for="actual_end_time" class="block text-sm font-medium text-gray-700 mb-1">Actual End
                            Time</label>
                        <input type="time" id="actual_end_time" name="actual_end_time"
                            value="{{ old('actual_end_time', $task->actual_end_time) }}"
                            class="input-field w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                </div>
            </div>

            <!-- Update Button -->
            <div>
                <button type="submit"
                    class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-medium px-5 py-2.5 rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">
                    Update Task
                </button>
            </div>
        </form>

        <!-- Action Buttons -->
        <div class="grid grid-cols-3 gap-4 mt-8 animate-fade-in animate-delay-200">
            <form action="{{ route('tasks.finish', $task->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit"
                    class="w-full bg-emerald-500 hover:bg-emerald-600 text-white py-2.5 px-4 rounded-lg shadow-md hover:shadow-lg transition-all duration-200 flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Mark Complete
                </button>
            </form>

            <form action="{{ route('tasks.postpone', $task->id) }}" method="POST">
                @csrf
                <button type="submit"
                    class="w-full bg-amber-500 hover:bg-amber-600 text-white py-2.5 px-4 rounded-lg shadow-md hover:shadow-lg transition-all duration-200 flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
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
                    class="w-full bg-red-500 hover:bg-red-600 text-white py-2.5 px-4 rounded-lg shadow-md hover:shadow-lg transition-all duration-200 flex items-center justify-center gap-2"
                    onclick="return confirm('Are you sure you want to dismiss this task? This action cannot be undone.')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Dismiss
                </button>
            </form>
        </div>

        <!-- Return to List Button -->
        <div class="mt-8 text-center animate-fade-in animate-delay-300">
            <a href="{{ url()->previous() }}"
                class="inline-flex items-center text-indigo-600 hover:text-indigo-800 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                </svg>
                Return to Tasks List
            </a>
        </div>
    </div>
</x-app-layout>
