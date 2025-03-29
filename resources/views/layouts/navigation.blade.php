<nav x-data="{ open: false }" class="bg-gradient-to-r from-indigo-600 to-purple-700 shadow-lg">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center animate-float">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                        <x-application-logo class="block h-10 w-auto text-white" />
                        <span class="text-white text-2xl font-bold">PrepIt</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-1 sm:flex ml-10">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                        class="px-3 py-2 rounded-lg text-white hover:bg-white/10 transition-all duration-300 {{ request()->routeIs('dashboard') ? 'bg-white/20 font-medium' : '' }}">
                        <span class="stagger-item animate-slide-in">{{ __('Dashboard') }}</span>
                    </x-nav-link>
                    <x-nav-link :href="route('timeslots.index')" :active="request()->routeIs('timeslots.index')"
                        class="px-3 py-2 rounded-lg text-white hover:bg-white/10 transition-all duration-300 {{ request()->routeIs('timeslots.index') ? 'bg-white/20 font-medium' : '' }}">
                        <span class="stagger-item animate-slide-in">{{ __('Timeslots') }}</span>
                    </x-nav-link>
                    <x-nav-link :href="route('goals.index')" :active="request()->routeIs('goals.index')"
                        class="px-3 py-2 rounded-lg text-white hover:bg-white/10 transition-all duration-300 {{ request()->routeIs('goals.index') ? 'bg-white/20 font-medium' : '' }}">
                        <span class="stagger-item animate-slide-in">{{ __('Goals') }}</span>
                    </x-nav-link>
                    <x-nav-link :href="route('tasks.index')" :active="request()->routeIs('tasks.index')"
                        class="px-3 py-2 rounded-lg text-white hover:bg-white/10 transition-all duration-300 {{ request()->routeIs('tasks.index') ? 'bg-white/20 font-medium' : '' }}">
                        <span class="stagger-item animate-slide-in">{{ __('Tasks') }}</span>
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 animate-fade-in animate-delay-300">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="group flex items-center px-4 py-2 text-white bg-white/10 border border-white/20 rounded-lg hover:bg-white hover:text-indigo-700 transition-all duration-300">
                            <div class="me-2">{{ Auth::user()->name }}</div>
                            <div>
                                <svg class="fill-current h-4 w-4 transition-transform duration-300 transform group-hover:rotate-180"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="py-2 bg-white rounded-lg shadow-lg border border-indigo-100 overflow-hidden">
                            <x-dropdown-link :href="route('profile.edit')"
                                class="flex items-center px-4 py-2 hover:bg-indigo-50 text-indigo-700 transition-all duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    class="flex items-center px-4 py-2 hover:bg-indigo-50 text-indigo-700 transition-all duration-200"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                        <polyline points="16 17 21 12 16 7"></polyline>
                                        <line x1="21" y1="12" x2="9" y2="12"></line>
                                    </svg>
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger (Mobile Menu) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-lg text-white hover:bg-white hover:text-indigo-700 transition-all duration-300">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'max-h-screen opacity-100': open, 'max-h-0 opacity-0': !open }"
        class="sm:hidden overflow-hidden transition-all duration-300 ease-in-out">
        <div class="pt-2 pb-3 space-y-1 bg-white shadow-lg rounded-b-lg mx-4 mb-4">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                class="block px-4 py-2 text-indigo-700 hover:bg-indigo-50 rounded-lg transition-all duration-200">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2">
                        <rect x="3" y="3" width="7" height="7"></rect>
                        <rect x="14" y="3" width="7" height="7"></rect>
                        <rect x="14" y="14" width="7" height="7"></rect>
                        <rect x="3" y="14" width="7" height="7"></rect>
                    </svg>
                    {{ __('Dashboard') }}
                </div>
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('timeslots.index')" :active="request()->routeIs('timeslots.index')"
                class="block px-4 py-2 text-indigo-700 hover:bg-indigo-50 rounded-lg transition-all duration-200">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                    {{ __('Timeslots') }}
                </div>
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('goals.index')" :active="request()->routeIs('goals.index')"
                class="block px-4 py-2 text-indigo-700 hover:bg-indigo-50 rounded-lg transition-all duration-200">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2">
                        <path d="M20 6L9 17l-5-5"></path>
                    </svg>
                    {{ __('Goals') }}
                </div>
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('tasks.index')" :active="request()->routeIs('tasks.index')"
                class="block px-4 py-2 text-indigo-700 hover:bg-indigo-50 rounded-lg transition-all duration-200">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2">
                        <path d="M9 11l3 3L22 4"></path>
                        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                    </svg>
                    {{ __('Tasks') }}
                </div>
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-indigo-200 bg-white shadow-lg rounded-b-lg mx-4 mb-4">
            <div class="px-4">
                <div class="font-medium text-base text-indigo-700">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-indigo-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')"
                    class="block px-4 py-2 text-indigo-700 hover:bg-indigo-50 rounded-lg transition-all duration-200">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        {{ __('Profile') }}
                    </div>
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        class="block px-4 py-2 text-indigo-700 hover:bg-indigo-50 rounded-lg transition-all duration-200"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                <polyline points="16 17 21 12 16 7"></polyline>
                                <line x1="21" y1="12" x2="9" y2="12"></line>
                            </svg>
                            {{ __('Log Out') }}
                        </div>
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
