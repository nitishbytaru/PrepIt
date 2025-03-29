<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gradient leading-tight text-center animate-fade-in">
            Edit Your Schedule
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto p-8 bg-white rounded-2xl shadow-xl mt-6 animate-scale-in border border-indigo-100">
        @if (session('success'))
            <div
                class="bg-green-100 border-l-4 border-green-500 text-green-700 px-6 py-4 rounded-lg mb-6 animate-slide-in shadow-md">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-green-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <p>{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <form action="{{ route('timeslots.store', $timeslot->id) }}" method="POST">
            @csrf

            {{-- Interval Selection --}}
            <div class="mb-8 animate-fade-in animate-delay-100">
                <label class="block font-medium text-xl text-indigo-800 mb-3">Session Duration:</label>
                @php
                    $intervalOptions = [
                        60 => '1 hour',
                        90 => '1 hour 30 minutes',
                        120 => '2 hours',
                        150 => '2 hours 30 minutes',
                        180 => '3 hours',
                    ];
                @endphp
                <div class="grid sm:grid-cols-2 gap-4 mt-2">
                    @foreach ($intervalOptions as $minutes => $label)
                        <label
                            class="flex items-center space-x-3 p-4 rounded-xl cursor-pointer transition-all duration-300 knowledge-card hover:-translate-y-1 hover:shadow-md {{ $timeslot->interval == $minutes ? 'border-2 border-indigo-500 bg-indigo-50' : '' }}">
                            <input type="radio" name="interval" value="{{ $minutes }}"
                                class="form-radio text-indigo-600 h-5 w-5"
                                {{ $timeslot->interval == $minutes ? 'checked' : '' }}>
                            <span class="text-gray-800 font-medium">{{ $label }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            {{-- Decode JSON --}}
            @php
                $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                $selectedWorkingDays = json_decode($timeslot->working_days, true) ?? [];
                $selectedCompensationDays = json_decode($timeslot->compensation_days, true) ?? [];
                $preferredStartTimes = json_decode($timeslot->preferred_start_time, true) ?? [];
                $preferredEndTimes = json_decode($timeslot->preferred_end_time, true) ?? [];
            @endphp

            <div class="grid md:grid-cols-2 gap-8 mb-8">
                {{-- Working Days --}}
                <div class="animate-fade-in animate-delay-200">
                    <label class="block font-medium text-xl text-indigo-800 mb-3">Learning Days:</label>
                    <div class="grid grid-cols-2 md:grid-cols-1 gap-3 mt-2">
                        @foreach ($days as $day)
                            <label
                                class="flex items-center space-x-3 p-3 rounded-lg cursor-pointer hover:bg-indigo-50 transition-all duration-200 {{ in_array($day, $selectedWorkingDays) ? 'bg-indigo-50 border border-indigo-200' : 'bg-gray-50 border border-gray-200' }}">
                                <input type="checkbox" name="working_days[]" value="{{ $day }}"
                                    class="checkbox h-5 w-5 text-indigo-600 rounded border-gray-300 focus:ring-indigo-500"
                                    {{ in_array($day, $selectedWorkingDays) ? 'checked' : '' }}>
                                <span class="text-gray-800">{{ $day }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                {{-- Compensation Days --}}
                <div class="animate-fade-in animate-delay-300">
                    <label class="block font-medium text-xl text-indigo-800 mb-3">Catch-up Days:</label>
                    <div class="grid grid-cols-2 md:grid-cols-1 gap-3 mt-2">
                        @foreach ($days as $day)
                            <label
                                class="flex items-center space-x-3 p-3 rounded-lg cursor-pointer hover:bg-purple-50 transition-all duration-200 {{ in_array($day, $selectedCompensationDays) ? 'bg-purple-50 border border-purple-200' : 'bg-gray-50 border border-gray-200' }}">
                                <input type="checkbox" name="compensation_days[]" value="{{ $day }}"
                                    class="checkbox h-5 w-5 text-purple-600 rounded border-gray-300 focus:ring-purple-500"
                                    {{ in_array($day, $selectedCompensationDays) ? 'checked' : '' }}>
                                <span class="text-gray-800">{{ $day }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Preferred Start & End Times --}}
            <div class="mb-8 animate-fade-in animate-delay-400">
                <label class="block font-medium text-xl text-indigo-800 mb-3">Optimal Learning Hours:</label>
                <div class="bg-indigo-50 p-5 rounded-xl border border-indigo-100 space-y-4">
                    @foreach ($days as $day)
                        <div
                            class="flex flex-wrap items-center bg-white p-4 rounded-lg shadow-sm hover:shadow-md transition-all duration-200">
                            <span class="w-24 font-medium text-indigo-700">{{ $day }}</span>
                            <div class="flex items-center flex-grow space-x-3">
                                <input type="time" name="preferred_start_time[{{ $day }}]"
                                    class="border border-indigo-200 p-2 rounded-lg flex-grow max-w-xs time-input bg-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                    data-day="{{ $day }}" value="{{ $preferredStartTimes[$day] ?? '' }}">
                                <span class="mx-2 text-gray-600">to</span>
                                <input type="time" name="preferred_end_time[{{ $day }}]"
                                    class="border border-indigo-200 p-2 rounded-lg flex-grow max-w-xs time-input bg-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                    data-day="{{ $day }}" value="{{ $preferredEndTimes[$day] ?? '' }}">
                            </div>
                        </div>
                    @endforeach
                </div>
                <p class="mt-3 text-sm text-gray-600 italic">Set your optimal learning times for maximum productivity
                </p>
            </div>

            {{-- Submit Button --}}
            <div class="mt-8 text-center animate-fade-in animate-delay-500">
                <button type="submit"
                    class="btn-primary px-8 py-3 text-lg font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                    Save Your Schedule
                </button>
                <p class="mt-3 text-sm text-gray-600">Your personal learning schedule will be updated immediately</p>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const workingDays = document.querySelectorAll("input[name='working_days[]']");
            const compensationDays = document.querySelectorAll("input[name='compensation_days[]']");
            const timeInputs = document.querySelectorAll("input[type='time']");

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

                toggleTimeInputs();
            }

            function toggleTimeInputs() {
                timeInputs.forEach(input => {
                    let day = input.dataset.day;
                    let isSelected = document.querySelector(`input[name='working_days[]'][value='${day}']`)
                        ?.checked ||
                        document.querySelector(`input[name='compensation_days[]'][value='${day}']`)
                        ?.checked;

                    input.disabled = !isSelected;
                    const parentRow = input.closest('.flex');
                    if (parentRow) {
                        if (isSelected) {
                            parentRow.classList.remove('opacity-50');
                        } else {
                            parentRow.classList.add('opacity-50');
                        }
                    }
                });
            }

            function checkTimeValidity(startInput, endInput) {
                if (startInput.value && endInput.value && startInput.value >= endInput.value) {
                    alert("Start time must be before end time.");
                    endInput.value = "";
                }
            }

            timeInputs.forEach(input => {
                input.addEventListener("change", function() {
                    let day = this.dataset.day;
                    let startInput = document.querySelector(
                        `input[name='preferred_start_time[${day}]']`);
                    let endInput = document.querySelector(
                        `input[name='preferred_end_time[${day}]']`);

                    if (startInput && endInput) {
                        checkTimeValidity(startInput, endInput);
                    }
                });
            });

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

            toggleTimeInputs();
        });
    </script>
</x-app-layout>
