<x-app-layout>
    <div class="max-w-6xl mx-auto p-6 bg-white rounded-2xl shadow-xl animate-scale-in border border-indigo-100">
        @if (session('success'))
            <div
                class="bg-green-100 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded-lg mb-4 animate-slide-in shadow-md">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <p>{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <div class="flex flex-col sm:flex-row justify-between items-center mb-4">
            <h3 class="text-3xl font-bold text-indigo-800 animate-fade-in mb-2 sm:mb-0">Learning Schedule</h3>
        </div>

        @if ($timeslots->isEmpty())
            <div class="text-center py-12 animate-fade-in bg-indigo-50 rounded-xl border border-indigo-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-indigo-300 mb-3" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="text-lg font-semibold text-indigo-800 mb-2">No Learning Schedule Found</h3>
                <p class="text-gray-600 mb-4 max-w-md mx-auto">Set up your personal learning schedule to optimize your
                    study time.</p>
                <a href="{{ route('timeslots.create') }}"
                    class="btn-primary inline-flex items-center px-5 py-2 rounded-lg text-white font-semibold">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    Create Schedule
                </a>
            </div>
        @else
            <div class="sm:mx-40 grid grid-cols-1 lg:grid-cols-1 gap-4 mb-4 animate-fade-in text-xl">
                @foreach ($timeslots as $timeslot)
                    <div
                        class="text-xl bg-white border border-indigo-100 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 overflow-hidden">
                        <!-- Schedule Card Header -->
                        <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-4 py-3 text-white">
                            <div class="flex justify-between items-center">
                                <h4 class="font-semibold">Schedule</h4>
                                <div class="flex items-center space-x-1">
                                    <a href="{{ route('timeslots.edit', $timeslot->id) }}"
                                        class="p-1 hover:bg-white/20 rounded">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                    <form action="{{ route('timeslots.destroy', $timeslot->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1 hover:bg-white/20 rounded"
                                            onclick="return confirm('Are you sure you want to delete this schedule?')">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Session Duration -->
                        <div class="px-4 py-3 border-b border-indigo-50">
                            <div class="flex items-center">
                                <div class="bg-green-100 p-2 rounded-full mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <h5 class="text-xs text-gray-500 font-medium">Session Duration</h5>
                                    <p class="text-indigo-800 font-semibold">
                                        @php
                                            $hours = floor($timeslot->interval / 60);
                                            $minutes = $timeslot->interval % 60;
                                            $durationText = '';
                                            if ($hours > 0) {
                                                $durationText .= $hours . ' hour' . ($hours > 1 ? 's' : '');
                                            }
                                            if ($minutes > 0) {
                                                $durationText .=
                                                    ($hours > 0 ? ' ' : '') .
                                                    $minutes .
                                                    ' minute' .
                                                    ($minutes > 1 ? 's' : '');
                                            }
                                        @endphp
                                        {{ $durationText }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Days Section -->
                        <div class="px-4 py-3">
                            <div class="grid grid-cols-2 gap-3">
                                <!-- Learning Days -->
                                <div>
                                    <h5 class="text-xs text-gray-500 font-medium mb-2">Learning Days</h5>
                                    <div class="flex flex-wrap gap-1">
                                        @foreach (json_decode($timeslot->working_days, true) as $day)
                                            <span
                                                class="px-2 py-1 bg-indigo-100 text-indigo-800 rounded-md text-xs font-medium">
                                                {{ substr($day, 0, 3) }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Catch-up Days -->
                                <div>
                                    <h5 class="text-xs text-gray-500 font-medium mb-2">Catch-up Days</h5>
                                    <div class="flex flex-wrap gap-1">
                                        @php $compDays = json_decode($timeslot->compensation_days, true) ?? []; @endphp
                                        @if (count($compDays) > 0)
                                            @foreach ($compDays as $day)
                                                <span
                                                    class="px-2 py-1 bg-purple-100 text-purple-800 rounded-md text-xs font-medium">
                                                    {{ substr($day, 0, 3) }}
                                                </span>
                                            @endforeach
                                        @else
                                            <span class="text-xs text-gray-400 italic">None selected</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Weekly Schedule Visual -->
                        <div class="px-4 py-3 bg-gray-50 border-t border-indigo-50">
                            <h5 class="text-xs text-gray-500 font-medium mb-2">Weekly Schedule</h5>
                            @php
                                $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                                $preferredStartTimes = json_decode($timeslot->preferred_start_time, true);
                                $preferredEndTimes = json_decode($timeslot->preferred_end_time, true);
                                $workingDays = json_decode($timeslot->working_days, true);
                                $compDays = json_decode($timeslot->compensation_days, true) ?? [];
                            @endphp

                            <div class="grid grid-cols-7 gap-1 text-center">
                                @foreach ($days as $day)
                                    @php
                                        $isWorking = in_array($day, $workingDays);
                                        $isComp = in_array($day, $compDays);
                                        $hasSchedule =
                                            isset($preferredStartTimes[$day]) && isset($preferredEndTimes[$day]);
                                    @endphp

                                    <div class="flex flex-col items-center">
                                        <div
                                            class="w-8 h-8 rounded-full flex items-center justify-center text-xs
                                            {{ $isWorking ? 'bg-indigo-600 text-white' : ($isComp ? 'bg-purple-600 text-white' : 'bg-gray-200 text-gray-500') }}">
                                            {{ substr($day, 0, 2) }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Time Slots -->
                            <div class="mt-3">
                                <div class="grid grid-cols-1 gap-1">
                                    @php
                                        $scheduledDays = array_merge($workingDays, $compDays);
                                    @endphp

                                    @foreach ($scheduledDays as $day)
                                        @if (isset($preferredStartTimes[$day]) && isset($preferredEndTimes[$day]))
                                            <div class="flex items-center text-xs">
                                                <span
                                                    class="w-16 font-medium text-gray-700">{{ substr($day, 0, 3) }}</span>
                                                <div
                                                    class="bg-blue-50 text-blue-800 px-2 py-1 rounded flex-1 text-center">
                                                    {{ $preferredStartTimes[$day] }} - {{ $preferredEndTimes[$day] }}
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="tip-card bg-indigo-50 border-l-4 border-indigo-400 p-3 rounded-lg animate-fade-in text-sm">
                <div class="flex items-start">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500 mr-2 mt-0.5" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div>
                        <h4 class="font-semibold text-indigo-800 mb-1">Learning Schedule Tip</h4>
                        <p class="text-indigo-700">Consistent daily schedules improve information retention and
                            learning efficiency. Try to study at the same time each day for better results.</p>
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
