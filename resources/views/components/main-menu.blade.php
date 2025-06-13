<ul class="flex flex-wrap justify-evenly bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 p-4 mx-auto max-w-full">
    @foreach($menu_list as $menu_row)
    <x-main-menu-item :menurow="$menu_row" />
  @endforeach
</ul>