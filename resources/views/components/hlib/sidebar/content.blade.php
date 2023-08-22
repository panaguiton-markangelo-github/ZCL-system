<x-perfect-scrollbar
    as="nav"
    aria-label="main"
    class="flex flex-col flex-1 gap-4 px-3"
>

    <x-sidebar.link
        title="Home"
        href="{{ route('head_librarian.dashboard') }}"
        :isActive="request()->routeIs('head_librarian.dashboard')"
    >
        <x-slot name="icon">
            <x-icons.dashboard class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>

    <x-sidebar.link
        title="Librarians"
        href="{{ route('librarians.view') }}"
        :isActive="request()->routeIs('librarians.view')"
    >
        <x-slot name="icon">
            <i class="fa-solid fa-users flex-shrink-0 w-6 h-5" aria-hidden="true"></i>
        </x-slot>
    </x-sidebar.link>

    <x-sidebar.link
        title="Books"
        href="{{ route('head_librarian.view.books') }}"
        :isActive="request()->routeIs('head_librarian.view.books')"
    >
        <x-slot name="icon">
            <i class="fa-solid fa-book flex-shrink-0 w-6 h-5" aria-hidden="true"></i>
        </x-slot>
    </x-sidebar.link>

    <x-sidebar.link
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
    </x-sidebar.link>

    <x-sidebar.link
        title="Feedback"
        href="{{ route('head_librarian.view.feedbacks') }}"
        :isActive="request()->routeIs('head_librarian.view.feedbacks')"
    >
        <x-slot name="icon">
            <i class="fa-solid fa-comments flex-shrink-0 w-6 h-5"></i>
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

