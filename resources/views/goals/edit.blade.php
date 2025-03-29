<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-900 text-center animate-fade-in">
            <span class="text-gradient">✏️ Edit Your Learning Goal</span>
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto mt-6 p-8 bg-white rounded-xl shadow-xl animate-scale-in card-hover">
        {{-- Success & Error Messages --}}
        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded-lg mb-6 animate-fade-in">
                <p class="font-medium">Please fix the following errors:</p>
                <ul class="list-disc list-inside text-sm mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div
                class="bg-green-100 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded-lg mb-6 animate-fade-in">
                {{ session('success') }}
            </div>
        @endif

        {{-- Edit Goal Form --}}
        <form action="{{ route('goals.update', $goal->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PATCH')

            {{-- Goal Title --}}
            <div class="mb-5 animate-slide-in stagger-item">
                <label class="block text-indigo-700 font-medium mb-2">Goal Title:</label>
                <input type="text" name="title" class="input-field" value="{{ old('title', $goal->title) }}"
                    required>
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Start & End Date --}}
            <div class="grid grid-cols-2 gap-4">
                <div class="mb-5 animate-slide-in stagger-item">
                    <label class="block text-indigo-700 font-medium mb-2">Start Date:</label>
                    <input type="date" name="start_date" class="input-field"
                        value="{{ old('start_date', $goal->start_date) }}" required>
                    @error('start_date')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5 animate-slide-in stagger-item">
                    <label class="block text-indigo-700 font-medium mb-2">End Date:</label>
                    <input type="date" name="end_date" class="input-field"
                        value="{{ old('end_date', $goal->end_date) }}" required>
                    @error('end_date')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Priority Level --}}
            <div class="mb-5 animate-slide-in stagger-item">
                <label class="block text-indigo-700 font-medium mb-2">Priority Level:</label>
                <select name="priority" class="input-field">
                    <option value="High" {{ old('priority', $goal->priority) == 'High' ? 'selected' : '' }}>🔥 High
                        Priority</option>
                    <option value="Medium" {{ old('priority', $goal->priority) == 'Medium' ? 'selected' : '' }}>⚡
                        Medium Priority</option>
                    <option value="Low" {{ old('priority', $goal->priority) == 'Low' ? 'selected' : '' }}>✅ Low
                        Priority</option>
                </select>
                @error('priority')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Weekly Study Hours --}}
            <div class="mb-5 animate-slide-in stagger-item">
                <label class="block text-indigo-700 font-medium mb-2">Total Study Hours Per Week:</label>
                <input type="number" name="time_per_week" class="input-field"
                    value="{{ old('time_per_week', $goal->time_per_week) }}" required>
                @error('time_per_week')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Preferred Study Time --}}
            <div class="mb-5 animate-slide-in stagger-item">
                <label class="block text-indigo-700 font-medium mb-2">Preferred Study Time (Optional):</label>
                <div class="flex items-center gap-2">
                    <input type="time" name="preferred_start_time" class="input-field w-36"
                        value="{{ old('preferred_start_time', $goal->preferred_start_time) }}">
                    <span class="text-gray-600">to</span>
                    <input type="time" name="preferred_end_time" class="input-field w-36"
                        value="{{ old('preferred_end_time', $goal->preferred_end_time) }}">
                </div>
                @error('preferred_start_time')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                @error('preferred_end_time')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Save Button --}}
            <div class="mt-8 flex space-x-4 animate-fade-in animate-delay-300">
                <a href="{{ route('goals.index') }}" class="btn-outline flex-1 text-center">
                    Cancel
                </a>
                <button type="submit" class="btn-primary flex-1">
                    Update Goal
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
