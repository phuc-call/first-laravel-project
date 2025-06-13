<li class="relative group bg-blue-600 rounded-md mb-2 md:mb-0">
    <a href="{{ url('/' . $menu->link) }}"
        class="text-white hover:bg-blue-700 font-medium px-4 py-2 inline-block transition-colors rounded-md">
        {{ $menu->name }}
    </a>

    @if (count($menu_list) > 0)
        <ul
            class="absolute left-0 top-full mt-1 hidden group-hover:block bg-white shadow-lg rounded-md z-10 min-w-[200px]">
            @foreach ($menu_list as $menu_row)
                <li>
                    <a href="{{ url('/' . $menu_row->link) }}"
                        class="block px-4 py-2 text-gray-700 hover:bg-blue-100 hover:text-blue-700 transition">
                        {{ $menu_row->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
</li>
