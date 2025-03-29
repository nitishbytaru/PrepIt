<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gradient">Set Your Learning Schedule</h2>
        <p class="text-gray-600 mt-1">Optimize your study time by scheduling dedicated learning periods</p>
    </x-slot>

    <div class="max-w-3xl mx-auto">
        @if (session('success'))
            <div
                class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg shadow-md animate-fade-in flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-indigo-100 animate-fade-in">
            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 p-6 text-white">
                <h3 class="text-xl font-bold flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 animate-pulse" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                    Create Your Time Schedule
                </h3>
                <p class="mt-1 text-indigo-100">Plan your study sessions to maximize productivity and learning retention
                </p>
            </div>

            <form action="{{ route('timeslots.store') }}" method="POST" class="p-8 space-y-8">
                @csrf

                <div class="animate-fade-in animate-delay-100">
                    <label for="interval" class="block font-medium text-gray-700 mb-2 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                        Study Session Duration:
                    </label>
                    <div class="relative">
                        <select name="interval" id="interval"
                            class="block w-full pl-3 pr-10 py-3 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 rounded-lg shadow-sm transition-all duration-200 bg-indigo-50 hover:bg-indigo-100">
                            @php
                                $intervalOptions = [
                                    60 => '1 hour - Good for focused review',
                                    90 => '1 hour 30 minutes - Ideal for most subjects',
                                    120 => '2 hours - Perfect for deep learning',
                                    150 => '2 hours 30 minutes - Extended study session',
                                    180 => '3 hours - Maximum recommended session',
                                ];
                            @endphp
                            @foreach ($intervalOptions as $minutes => $label)
                                <option value="{{ $minutes }}">{{ $label }}</option>
                            @endforeach
                        </select>
                        <div
                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="mt-2 text-sm text-gray-500">Choose a duration that matches your attention span and
                        learning goals.</p>
                </div>

                <div class="grid md:grid-cols-2 gap-8 animate-fade-in animate-delay-200">
                    <div>
                        <label class="block font-medium text-gray-700 mb-3 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                            </svg>
                            Regular Study Days:
                        </label>
                        <div class="bg-white p-4 rounded-lg border border-indigo-100 shadow-sm space-y-2">
                            @php
                                $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                                $dayIcons = [
                                    'Monday' => '📚',
                                    'Tuesday' => '📝',
                                    'Wednesday' => '📖',
                                    'Thursday' => '🧠',
                                    'Friday' => '📓',
                                    'Saturday' => '🎯',
                                    'Sunday' => '🧘',
                                ];
                            @endphp
                            @foreach ($days as $day)
                                <label
                                    class="flex items-center p-2 rounded-lg hover:bg-indigo-50 transition-all duration-200">
                                    <input type="checkbox" name="working_days[]" value="{{ $day }}"
                                        data-day="{{ $day }}"
                                        class="form-checkbox h-5 w-5 text-indigo-600 rounded border-gray-300 focus:ring-indigo-500 transition-all duration-200">
                                    <span class="ml-3 text-gray-700">{{ $dayIcons[$day] }} {{ $day }}</span>
                                </label>
                            @endforeach
                        </div>
                        <p class="mt-2 text-sm text-gray-500">Select days for your regular study sessions.</p>
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 mb-3 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                            </svg>
                            Makeup Study Days:
                        </label>
                        <div class="bg-white p-4 rounded-lg border border-indigo-100 shadow-sm space-y-2">
                            @foreach ($days as $day)
                                <label
                                    class="flex items-center p-2 rounded-lg hover:bg-indigo-50 transition-all duration-200">
                                    <input type="checkbox" name="compensation_days[]" value="{{ $day }}"
                                        data-day="{{ $day }}"
                                        class="form-checkbox h-5 w-5 text-purple-600 rounded border-gray-300 focus:ring-purple-500 transition-all duration-200">
                                    <span class="ml-3 text-gray-700">{{ $dayIcons[$day] }} {{ $day }}</span>
                                </label>
                            @endforeach
                        </div>
                        <p class="mt-2 text-sm text-gray-500">Select days for makeup sessions if you miss regular study
                            time.</p>
                    </div>
                </div>

                <div class="animate-fade-in animate-delay-300">
                    <label class="block font-medium text-gray-700 mb-3 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path
                                d="M12 2v6M12 18v4M4.93 4.93l4.24 4.24M14.83 14.83l4.24 4.24M2 12h6M18 12h4M4.93 19.07l4.24-4.24M14.83 9.17l4.24-4.24">
                            </path>
                        </svg>
                        Preferred Study Hours:
                    </label>

                    <div class="bg-white p-6 rounded-lg border border-indigo-100 shadow-sm space-y-4">
                        <p class="text-sm text-gray-600 mb-4">Set your ideal study time for each day. Research shows
                            people have different optimal learning periods during the day.</p>

                        @foreach ($days as $day)
                            <div class="flex flex-wrap items-center space-x-2 p-3 rounded-lg"
                                id="time-row-{{ $day }}" x-data="{ enabled: false }" x-init="enabled = document.querySelector('input[name=\'working_days[]\'][value=\'{{ $day }}\']').checked ||
                                    document.querySelector('input[name=\'compensation_days[]\'][value=\'{{ $day }}\']').checked"
                                :class="enabled ? 'bg-indigo-50 border border-indigo-100' : 'bg-gray-50 border border-gray-200'">

                                <div class="w-20 md:w-24 font-medium text-gray-700 mb-2 md:mb-0">{{ $dayIcons[$day] }}
                                    {{ $day }}</div>

                                <div class="flex flex-wrap md:flex-nowrap items-center gap-2 w-full md:w-auto">
                                    <div class="relative w-full md:w-auto">
                                        <input type="time" name="preferred_start_time[{{ $day }}]"
                                            data-day="{{ $day }}"
                                            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 text-gray-700 transition-all duration-200"
                                            placeholder="Start Time" :disabled="!enabled"
                                            :class="enabled ? 'bg-white' : 'bg-gray-100'">
                                        <div
                                            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2">
                                                <circle cx="12" cy="12" r="10"></circle>
                                                <polyline points="12 6 12 12 16 14"></polyline>
                                            </svg>
                                        </div>
                                    </div>

                                    <span class="px-2 text-gray-500">to</span>

                                    <div class="relative w-full md:w-auto">
                                        <input type="time" name="preferred_end_time[{{ $day }}]"
                                            data-day="{{ $day }}"
                                            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 text-gray-700 transition-all duration-200"
                                            placeholder="End Time" :disabled="!enabled"
                                            :class="enabled ? 'bg-white' : 'bg-gray-100'">
                                        <div
                                            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2">
                                                <circle cx="12" cy="12" r="10"></circle>
                                                <polyline points="12 6 12 12 16 14"></polyline>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <p class="mt-2 text-sm text-gray-500">Times will only be active for days you've selected above.</p>
                </div>

                <div class="pt-5 text-center animate-fade-in animate-delay-400">
                    <button type="submit"
                        class="px-8 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-medium rounded-lg shadow-lg hover:shadow-xl transform transition-all duration-300 hover:-translate-y-1 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        <div class="flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                                <polyline points="17 21 17 13 7 13 7 21"></polyline>
                                <polyline points="7 3 7 8 15 8"></polyline>
                            </svg>
                            Save My Schedule
                        </div>
                    </button>
                    <p class="mt-3 text-sm text-gray-600">Your schedule will be used to optimize your learning journey
                    </p>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const workingDays = document.querySelectorAll("input[name='working_days[]']");
            const compensationDays = document.querySelectorAll("input[name='compensation_days[]']");

            function toggleOppositeCheckbox(day, checked, type) {
                let oppositeType = type === "working" ? "compensation" : "working";
                let oppositeCheckbox = document.querySelector(
                    `input[name='${oppositeType}_days[]'][value='${day}']`
                );

                if (checked) {
                    oppositeCheckbox.checked = false;
                    oppositeCheckbox.disabled = true;
                } else {
                    oppositeCheckbox.disabled = false;
                }
                updateTimeRowState(day);
            }

            function updateTimeRowState(day) {
                const timeRow = document.getElementById(`time-row-${day}`);
                const workingChecked = document.querySelector(`input[name='working_days[]'][value='${day}']`)
                    .checked;
                const compensationChecked = document.querySelector(
                    `input[name='compensation_days[]'][value='${day}']`).checked;
                const isEnabled = workingChecked || compensationChecked;

                // This will work with Alpine.js x-data state
                if (window.Alpine) {
                    Alpine.store(`time-row-${day}`, {
                        enabled: isEnabled
                    });
                }

                // Fallback for non-Alpine
                timeRow.classList.toggle('bg-indigo-50', isEnabled);
                timeRow.classList.toggle('border-indigo-100', isEnabled);
                timeRow.classList.toggle('bg-gray-50', !isEnabled);
                timeRow.classList.toggle('border-gray-200', !isEnabled);

                // Enable/disable the time inputs
                const timeInputs = timeRow.querySelectorAll('input[type="time"]');
                timeInputs.forEach(input => {
                    input.disabled = !isEnabled;
                    input.classList.toggle('bg-white', isEnabled);
                    input.classList.toggle('bg-gray-100', !isEnabled);
                });
            }

            workingDays.forEach(checkbox => {
                checkbox.addEventListener("change", function() {
                    toggleOppositeCheckbox(this.value, this.checked, "working");
                });
            });

            compensationDays.forEach(checkbox => {
                checkbox.addEventListener("change", function() {
                    toggleOppositeCheckbox(this.value, this.checked, "compensation");
                });
            });

            // Initialize all day rows
            document.querySelectorAll(
                '#time-row-Monday, #time-row-Tuesday, #time-row-Wednesday, #time-row-Thursday, #time-row-Friday, #time-row-Saturday, #time-row-Sunday'
            ).forEach(row => {
                const day = row.id.replace('time-row-', '');
                updateTimeRowState(day);
            });
        });
    </script>
</x-app-layout>
