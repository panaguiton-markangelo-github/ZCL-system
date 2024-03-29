<x-perfect-scrollbar
    as="nav"
    aria-label="main"
    class="flex flex-col flex-1 gap-4 px-3"
>

    <x-sidebar.link
        title="Home"
        href="{{ route('borrowing_librarian.dashboard') }}"
        :isActive="request()->routeIs('borrowing_librarian.dashboard')"
    >
        <x-slot name="icon">
            <x-icons.dashboard class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>

    <x-sidebar.link
        title="Borrowed Books / Returned Books"
        href="{{ route('borrowing_librarian.borrowed_books.view') }}"
        :isActive="request()->routeIs('borrowing_librarian.borrowed_books.view')"
    >
        <x-slot name="icon">
            <i class="fa-solid fa-book-open-reader flex-shrink-0 w-6 h-5" aria-hidden="true"></i>
        </x-slot>
    </x-sidebar.link>

    <x-sidebar.link
        title="Requested Books"
        href="{{ route('borrowing_librarian.requested_books.view') }}"
        :isActive="request()->routeIs('borrowing_librarian.requested_books.view')"
    >
        <x-slot name="icon">
            <i class="fa-solid fa-book flex-shrink-0 w-6 h-5" aria-hidden="true"></i>
        </x-slot>
    </x-sidebar.link>

    <x-sidebar.link
        title="Borrower's card"
        href="{{ route('borrowing_librarian.borrower_card_app.view') }}"
        :isActive="request()->routeIs('borrowing_librarian.borrower_card_app.view')"
    >
        <x-slot name="icon">
            <i class="fa-solid fa-users-rectangle flex-shrink-0 w-6 h-5" aria-hidden="true"></i>
        </x-slot>
    </x-sidebar.link>

    <x-sidebar.link
        title="Notifications"
        href="{{ route('borrowing_librarian.noty.view') }}"
        :isActive="request()->routeIs('borrowing_librarian.noty.view')"
    >
        <x-slot name="icon">

            @if (auth()->guard('librarians')->user()->unreadNotifications->count() > 0)
                <i class="fa-solid fa-bell fa-shake flex-shrink-0 w-6 h-5"></i>
            @else
                <i class="fa-regular fa-bell flex-shrink-0 w-6 h-5" aria-hidden="true"></i>
            @endif

            @if (auth()->guard('librarians')->user()->unreadNotifications->count() > 0)
                <div class="py-1 px-2.5 text-xs leading-none text-center whitespace-nowrap align-baseline font-bold bg-red-600 dark:bg-red-500 text-white rounded-full">
                    {{ auth()->guard('librarians')->user()->unreadNotifications->count() }}
                </div>
            @endif
    
        </x-slot>
        
    </x-sidebar.link>

    
    {{-- <x-sidebar.link
        title="Events"
        href="{{ route('head_librarian.view.events') }}"
        :isActive="request()->routeIs('head_librarian.view.events')"
    >
        <x-slot name="icon">
            <i class="fa-solid fa-calendar-days flex-shrink-0 w-6 h-5" aria-hidden="true"></i>
        </x-slot>
    </x-sidebar.link>

    <x-sidebar.link
        title="Announcements"
        href="{{ route('head_librarian.view.announcements') }}"
        :isActive="request()->routeIs('head_librarian.view.announcements')"
    >
        <x-slot name="icon">
            <i class="fa-solid fa-bullhorn flex-shrink-0 w-6 h-5"></i>
        </x-slot>
    </x-sidebar.link> --}}

     
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

