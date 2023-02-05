<nav
    aria-label="secondary"
    x-data="{ open: false }"
    class="sticky top-0 z-10 flex items-center justify-between px-4 py-4 sm:px-6 transition-transform duration-500 bg-white dark:bg-dark-eval-1"
    :class="{
        '-translate-y-full': scrollingDown,
        'translate-y-0': scrollingUp,
    }">

    <div class="flex items-center gap-3">
        <x-button
            type="button"
            class="md:hidden"
            icon-only
            variant="secondary"
            sr-text="Toggle dark mode"
            x-on:click="toggleTheme"
        >
            <x-heroicon-o-moon
                x-show="!isDarkMode"
                aria-hidden="true"
                class="w-6 h-6"
            />

            <x-heroicon-o-sun
                x-show="isDarkMode"
                aria-hidden="true"
                class="w-6 h-6"
            />
        </x-button>
    </div>

    <div class="flex items-center gap-3">
        <x-button
            type="button"
            class="hidden md:inline-flex"
            icon-only
            variant="secondary"
            sr-text="Toggle dark mode"
            x-on:click="toggleTheme"
        >
            <x-heroicon-o-moon
                x-show="!isDarkMode"
                aria-hidden="true"
                class="w-6 h-6"
            />

            <x-heroicon-o-sun
                x-show="isDarkMode"
                aria-hidden="true"
                class="w-6 h-6"
            />
        </x-button>

        
        <div class="mx-2 inline-flex relative w-fit">
            @if(Cart::content()->count() >= 1)
                <div class="absolute inline-block top-0 right-0 bottom-auto left-auto translate-x-2/4 -translate-y-1/2 rotate-0 skew-x-0 skew-y-0 scale-x-100 scale-y-100 py-1 px-2.5 text-xs leading-none text-center whitespace-nowrap align-baseline font-bold bg-red-600 dark:bg-red-500 text-white rounded-full z-10">{{ Cart::content()->count() }}</div>
            @endif
            <div class="px-2 py-2 text-sm font-medium text-gray-500 rounded-md hover:text-gray-700 focus:outline-none focus:ring focus:ring-purple-500 focus:ring-offset-1 focus:ring-offset-white dark:focus:ring-offset-dark-eval-1 dark:text-gray-400 dark:hover:text-gray-200">
                <div>
                    <a href="{{ route('cart.view') }}">
                        <i class="fa-sharp fa-solid fa-cart-shopping"></i>
                    </a>
                </div>
            </div>
          </div>
        

        
        <!--Notifications-->
        <x-dropdown align="right" width="48">
            
            <x-slot name="trigger">
                <div class="mx-2 inline-flex relative w-fit">                
                <button
                    class="inline-block flex items-center px-2 py-2 text-sm font-medium text-gray-500 rounded-md transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none focus:ring focus:ring-purple-500 focus:ring-offset-1 focus:ring-offset-white dark:focus:ring-offset-dark-eval-1 dark:text-gray-400 dark:hover:text-gray-200"
                >

                    <div> 
                        @if(auth()->user()->unreadNotifications->count() == 0)
                        <i class="fa-regular fa-bell"></i> 
                        @else
                            <i class="fa-regular fa-bell"></i>
                            <div class="absolute inline-block top-0 right-0 bottom-auto left-auto translate-x-2/4 -translate-y-1/2 rotate-0 skew-x-0 skew-y-0 scale-x-100 scale-y-100 py-1 px-2.5 text-xs leading-none text-center whitespace-nowrap align-baseline font-bold bg-red-600 dark:bg-red-500 text-white rounded-full z-10">
                                {{ auth()->user()->unreadNotifications->count() }}

                            </div>   
                        @endif
                    </div>

                </button>
            </div>
            </x-slot>

            <x-slot name="content">
                {{-- Notifications here --}}
                
                @forelse (auth()->user()->unreadNotifications as $notification)

                <a href="{{url('/markAsRead')}}/{{$notification->id}}" class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out dark:focus:text-white dark:focus:bg-dark-eval-3 dark:text-gray-400 dark:hover:text-gray-200 dark:hover:bg-dark-eval-3">
                    <p> {{ $notification->data['data'] }}</p>
                    <br>
                    <p> Remarks: {{ $notification->data['remarks'] }}</p>
                    <hr>
                </a>

                @empty
                <p> </p>
                @endforelse 
                    

                @if (auth()->user()->unreadNotifications->count() == 0)
                    <p style="font-size: 0.9rem;padding:.9rem;" class="text-center">No new notification</p>
                    
                @endif
                    

            </x-slot>
            
        </x-dropdown>
        


        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                <button
                    class="flex items-center p-2 text-sm font-medium text-gray-500 rounded-md transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none focus:ring focus:ring-purple-500 focus:ring-offset-1 focus:ring-offset-white dark:focus:ring-offset-dark-eval-1 dark:text-gray-400 dark:hover:text-gray-200"
                >
                    <div>{{ Auth::user()->firstName }}</div>

                    <div class="ml-1">
                        <svg
                            class="w-4 h-4 fill-current"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"
                            />
                        </svg>
                    </div>
                </button>
            </x-slot>

            <x-slot name="content">
                <!-- Profile -->
                <x-dropdown-link
                    :href="route('profile.edit')"
                >
                    {{ __('Profile') }}
                </x-dropdown-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-dropdown-link
                        :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();"
                    >
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>



    </div>
</nav>

<!-- Mobile bottom bar -->
<div
    class="fixed inset-x-0 bottom-0 flex items-center justify-between px-4 py-4 sm:px-6 transition-transform duration-500 bg-white md:hidden dark:bg-dark-eval-1"
    :class="{
        'translate-y-full': scrollingDown,
        'translate-y-0': scrollingUp,
    }"
>
    <x-button
        type="button"
        icon-only
        variant="secondary"
        sr-text="Search"
    >
        <x-heroicon-o-search aria-hidden="true" class="w-6 h-6" />
    </x-button>

    <a href="{{ route('dashboard') }}">
        <x-application-logo aria-hidden="true" class="w-10 h-10" />

        <span class="sr-only">Dashboard</span>
    </a>

    <x-button
        type="button"
        icon-only
        variant="secondary"
        sr-text="Open main menu"
        x-on:click="isSidebarOpen = !isSidebarOpen"
    >
        <x-heroicon-o-menu
            x-show="!isSidebarOpen"
            aria-hidden="true"
            class="w-6 h-6"
        />

        <x-heroicon-o-x
            x-show="isSidebarOpen"
            aria-hidden="true"
            class="w-6 h-6"
        />
    </x-button>
</div>
