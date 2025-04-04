<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-900 text-center animate-fade-in">
            <span class="text-gradient">🎯 Create a New Learning Goal</span>
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto mt-6 p-8 bg-white rounded-xl shadow-xl animate-scale-in card-hover">
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded mb-4 animate-fade-in">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('goals.store') }}" method="POST" class="space-y-6">
            @csrf

            {{-- Goal Title --}}
            <div class="mb-5 animate-slide-in stagger-item">
                <label class="block text-indigo-700 font-medium mb-2">Goal Title</label>
                <input type="text" name="title" class="input-field" placeholder="Enter your learning goal..."
                    required>
            </div>

            {{-- Start & End Date --}}
            <div class="grid grid-cols-2 gap-4">
                <div class="mb-5 animate-slide-in stagger-item">
                    <label class="block text-indigo-700 font-medium mb-2">Start Date</label>
                    <input type="date" name="start_date" class="input-field" required>
                </div>
                <div class="mb-5 animate-slide-in stagger-item">
                    <label class="block text-indigo-700 font-medium mb-2">End Date</label>
                    <input type="date" name="end_date" class="input-field" required>
                </div>
            </div>

            {{-- Priority Level --}}
            <div class="mb-5 animate-slide-in stagger-item">
                <label class="block text-indigo-700 font-medium mb-2">Priority Level</label>
                <select name="priority" class="input-field">
                    <option value="High">🔥 High Priority</option>
                    <option value="Medium">⚡ Medium Priority</option>
                    <option value="Low">✅ Low Priority</option>
                </select>
            </div>

            {{-- Weekly Study Hours --}}
            <div class="mb-5 animate-slide-in stagger-item">
                <label class="block text-indigo-700 font-medium mb-2">Total Study Hours Per Week</label>
                <input type="number" name="time_per_week" class="input-field" min="1" required>
                <p class="text-sm text-gray-500 mt-1">This helps us calculate your daily study schedule</p>
            </div>

            {{-- Preferred Study Time  --}}
            <div class="mb-5 animate-slide-in stagger-item">
                <label class="block text-indigo-700 font-medium mb-2">Preferred Study Time</label>
                <div class="flex items-center gap-2">
                    <input type="time" name="preferred_start_time" class="input-field w-36">
                    <span class="text-gray-600">to</span>
                    <input type="time" name="preferred_end_time" class="input-field w-36">
                </div>
                <p class="text-sm text-gray-500 mt-1">We'll try to schedule your study sessions during this time</p>
            </div>

            {{-- Note Card --}}
            <div class="note-card animate-fade-in animate-delay-300">
                <p class="font-medium">💡 Pro Tip:</p>
                <p>Setting realistic goals with consistent study times leads to better learning outcomes!</p>
            </div>

            {{-- Submit Button --}}
            <div class="mt-8 animate-fade-in animate-delay-400">
                <button type="submit" class="btn-primary w-full flex justify-center items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    Save Learning Goal
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
