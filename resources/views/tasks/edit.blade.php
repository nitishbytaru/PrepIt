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

        <div class="knowledge-card mb-8 animate-fade-in">
            <h3 class="text-xl font-semibold text-indigo-800 mb-4">Edit Your Learning Task</h3>

            <p class="text-gray-600 mb-2">Here you can adjust your study session details:</p>
            <ul class="list-disc list-inside text-gray-600 space-y-1 mb-4">
                <li>Update session title or description</li>
                <li>Change the planned date or time</li>
                <li>Record your actual study times</li>
                <li>Add notes about your progress</li>
            </ul>

            <div class="tip-card mt-4">
                <p class="font-medium">💡 Learning Tip:</p>
                <p>Tracking your actual study time helps develop better study habits and improves time management
                    skills.</p>
            </div>
        </div>

        <!-- Task Edit Form will be implemented here -->
        <!-- This is a placeholder until the actual task edit functionality is implemented -->
        <div class="flex justify-center">
            <a href="{{ url()->previous() }}" class="btn-primary">
                Return to Tasks
            </a>
        </div>
    </div>
</x-app-layout>
