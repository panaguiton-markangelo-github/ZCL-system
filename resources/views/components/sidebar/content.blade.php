<x-perfect-scrollbar
    as="nav"
    aria-label="main"
    class="flex flex-col flex-1 gap-4 px-3"
>

    <x-sidebar.link
        title="Catalog"
        href="{{ route('dashboard') }}"
        :isActive="request()->routeIs('dashboard')"
    >
        <x-slot name="icon">
            <x-icons.dashboard class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>

    <x-sidebar.link
        title="Basket"
        href="{{ route('cart.view') }}"
        :isActive="request()->routeIs('cart.view')"
    >
        <x-slot name="icon">
            @if(Cart::content()->count() >= 1)
                <i class="fa-solid fa-cart-shopping fa-bounce flex-shrink-0 w-6 h-5"></i>
                <div class="py-1 px-2.5 text-xs leading-none text-center whitespace-nowrap align-baseline font-bold bg-red-600 dark:bg-red-500 text-white rounded-full">
                    {{ Cart::content()->count() }}
                </div>
            @else
                <i class="fa-solid fa-cart-shopping flex-shrink-0 w-6 h-5" aria-hidden="true"></i>
            @endif
        </x-slot>
    </x-sidebar.link>

    
    @if (session('member.0.id'))
        @if (session('member.0.status') == "APPROVED")
            <x-sidebar.link
                title="Transactions"
                href="{{ route('trans.view') }}"
                :isActive="request()->routeIs('trans.view')"
            >
                <x-slot name="icon">

                    <i class="fa-solid fa-receipt flex-shrink-0 w-6 h-5"></i>    
                </x-slot>
                
            </x-sidebar.link>
        @endif
    @endif

    <x-sidebar.link
        title="Notifications"
        href="{{ route('noty.view') }}"
        :isActive="request()->routeIs('noty.view')"
    >
        <x-slot name="icon">

            @if (auth()->user()->unreadNotifications->count() > 0)
                <i class="fa-solid fa-bell fa-shake flex-shrink-0 w-6 h-5"></i>
            @else
                <i class="fa-regular fa-bell flex-shrink-0 w-6 h-5" aria-hidden="true"></i>
            @endif

            @if (auth()->user()->unreadNotifications->count() > 0)
                <div class="py-1 px-2.5 text-xs leading-none text-center whitespace-nowrap align-baseline font-bold bg-red-600 dark:bg-red-500 text-white rounded-full">
                    {{ auth()->user()->unreadNotifications->count() }}
                </div>
            @endif
    
        </x-slot>
        
    </x-sidebar.link>

    {{-- <x-sidebar.dropdown
        title="Buttons"
        :active="Str::startsWith(request()->route()->uri(), 'buttons')"
    >
        <x-slot name="icon">
            <x-heroicon-o-view-grid class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>

        <x-sidebar.sublink
            title="Text button"
            href="{{ route('buttons.text') }}"
            :active="request()->routeIs('buttons.text')"
        />
        <x-sidebar.sublink
            title="Icon button"
            href="{{ route('buttons.icon') }}"
            :active="request()->routeIs('buttons.icon')"
        />
        <x-sidebar.sublink
            title="Text with icon"
            href="{{ route('buttons.text-icon') }}"
            :active="request()->routeIs('buttons.text-icon')"
        />
    </x-sidebar.dropdown> --}}

    {{-- <div
        x-transition
        x-show="isSidebarOpen || isSidebarHovered"
        class="text-sm text-gray-500"
    >
        Dummy Links
    </div>

    @php
        $links = array_fill(0, 1, '');
    @endphp

    @foreach ($links as $index => $link)
        <x-sidebar.link title="test {{ $index + 1 }}" href="#" />
    @endforeach --}}

</x-perfect-scrollbar>

