<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex items-center">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('patients.index')" :active="request()->routeIs('patients.*')">
                        {{ __('Patients') }}
                    </x-nav-link>
                    <x-nav-link :href="route('doctors.index')" :active="request()->routeIs('doctors.*')">
                        {{ __('Doctors') }}
                    </x-nav-link>
                    <x-nav-link :href="route('appointments.index')" :active="request()->routeIs('appointments.*')">
                        {{ __('Appointments') }}
                    </x-nav-link>
                    <x-nav-link :href="route('device-data.index')" :active="request()->routeIs('device-data.*')">
                        {{ __('Device Data') }}
                    </x-nav-link>
                    <x-nav-link :href="route('billing.index')" :active="request()->routeIs('billing.*')">
                        {{ __('Billing') }}
                    </x-nav-link>
                    <!-- Dark Mode Toggle Button (Desktop) -->
                    <button
                        id="theme-toggle"
                        class="ml-4 p-2 rounded focus:outline-none focus:ring"
                        aria-label="Toggle Dark Mode"
                        title="Toggle Dark Mode"
                    >
                        <svg id="theme-toggle-dark-icon" class="w-5 h-5 hidden" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M17.293 13.293a8 8 0 01-11.586 0 8 8 0 0111.586 0zm-2.121 2.122a6 6 0 01-8.486 0 6 6 0 018.486 0z"></path>
                        </svg>
                        <svg id="theme-toggle-light-icon" class="w-5 h-5 hidden" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 2a1 1 0 110-2 1 1 0 010 2zm0 16a1 1 0 110 2 1 1 0 010-2zm8-8a1 1 0 110 2 1 1 0 010-2zm-16 0a1 1 0 110 2 1 1 0 010-2zm12.071-7.071a1 1 0 01.707 1.707l-1.414 1.414a1 1 0 01-1.414-1.414l1.414-1.414a1 1 0 011.707.707zm-10.142 0a1 1 0 00-1.707.707 1 1 0 00.293.707l1.414 1.414a1 1 0 001.414-1.414L2.636 2.636a1 1 0 00-.707-.293zm10.142 14.142a1 1 0 01.707-1.707l1.414 1.414a1 1 0 01-1.414 1.414l-1.414-1.414a1 1 0 01.707-.707zm-10.142 0a1 1 0 00.707 1.707 1 1 0 00.707-.293l1.414-1.414a1 1 0 00-1.414-1.414L2.636 17.364a1 1 0 00-.293.707zM10 6a4 4 0 100 8 4 4 0 000-8z"></path>
                        </svg>Theme
                    </button>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('patients.index')" :active="request()->routeIs('patients.*')">
                {{ __('Patients') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('doctors.index')" :active="request()->routeIs('doctors.*')">
                {{ __('Doctors') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('appointments.index')" :active="request()->routeIs('appointments.*')">
                {{ __('Appointments') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('device-data.index')" :active="request()->routeIs('device-data.*')">
                {{ __('Device Data') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('billing.index')" :active="request()->routeIs('billing.*')">
                {{ __('Billing') }}
            </x-responsive-nav-link>
            <!-- Dark Mode Toggle Button (Mobile) -->
            <button
                id="theme-toggle-mobile"
                class="mt-2 p-2 rounded focus:outline-none focus:ring"
                aria-label="Toggle Dark Mode"
                title="Toggle Dark Mode"
            >
                <svg id="theme-toggle-dark-icon-mobile" class="w-5 h-5 hidden" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M17.293 13.293a8 8 0 01-11.586 0 8 8 0 0111.586 0zm-2.121 2.122a6 6 0 01-8.486 0 6 6 0 018.486 0z"></path>
                </svg>
                <svg id="theme-toggle-light-icon-mobile" class="w-5 h-5 hidden" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 2a1 1 0 110-2 1 1 0 010 2zm0 16a1 1 0 110 2 1 1 0 010-2zm8-8a1 1 0 110 2 1 1 0 010-2zm-16 0a1 1 0 110 2 1 1 0 010-2zm12.071-7.071a1 1 0 01.707 1.707l-1.414 1.414a1 1 0 01-1.414-1.414l1.414-1.414a1 1 0 011.707.707zm-10.142 0a1 1 0 00-1.707.707 1 1 0 00.293.707l1.414 1.414a1 1 0 001.414-1.414L2.636 2.636a1 1 0 00-.707-.293zm10.142 14.142a1 1 0 01.707-1.707l1.414 1.414a1 1 0 01-1.414 1.414l-1.414-1.414a1 1 0 01.707-.707zm-10.142 0a1 1 0 00.707 1.707 1 1 0 00.707-.293l1.414-1.414a1 1 0 00-1.414-1.414L2.636 17.364a1 1 0 00-.293.707zM10 6a4 4 0 100 8 4 4 0 000-8z"></path>
                </svg>
            </button>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
