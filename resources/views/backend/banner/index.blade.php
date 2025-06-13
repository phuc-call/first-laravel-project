<x-layout--admin>
    <div class="basis-4/5 bg-white ml-3 rounded-sm h-full">
        <div class="menufd">
            <div class="menu flex justify-between">
                <div class="title m-4 text-blue-500 font-[500] text-2xl">QUAN LY BANNER</div>
                <div class="update-delete flex">
                    <a class="bg-green-500 rounded-xl mr-2 scale-75" href="{{ route('banner.create') }}">
                        <div>
                            <div class="updata m-4 font-[500] text-2xl text-white"><i class="fas fa-plus-square"></i> Thêm
                            </div>
                        </div>
                    </a>
                    <a class="bg-red-500 rounded-xl mr-2 scale-75" href="{{ route('banner.trash') }}">
                        <div>
                            <div class="delete m-4 font-[500] text-2xl text-white"><i class="fas fa-trash"></i> Thùng
                                rác</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <!-- bảng product -->
        <div class="table w-full mt-3">
            <table class="table-auto border-collapse border border-gray-400 w-full">
                <thead>
                    <tr class="bg-gray-800 text-white">
                        <th class="border border-gray-500 px-4 py-2">ID</th>
                        <th class="border border-gray-500 px-4 py-2">Name</th>
                        <th class="border border-gray-500 px-4 py-2">Image</th>
                        <th class="border border-gray-500 px-4 py-2">slug</th>
                        <th class="border border-gray-500 px-4 py-2">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($list as $item)
                        <tr class="bg-gray-100 hover:bg-gray-200">
                            <td class="border border-gray-500 px-4 py-2">{{ $item->id }}</td>
                            <td class="border border-gray-500 px-4 py-2">{{ $item->name }}</td>
                            <td class="border border-gray-500 px-4 py-2">
                                @if (!empty($item->image))
                                    <img class="w-32 h-32 object-cover"
                                        src="{{ asset('assets/images/banner/' . $item->image) }}" alt="">
                                @endif
                            </td>
                            <td class="border border-gray-500 px-4 py-2">{{ $item->slug }}</td>
                            <td class="border border-gray-500 px-4 py-2">
                                <!-- create a icon for status -->
                                <a href="{{ route('banner.status', ['banner' => $item->id]) }}">
                                    @if ($item->status == 1)
                                        <i class="fa-solid fa-toggle-on text-green-500 text-4xl"></i>
                                    @else
                                        <i class="fa-solid fa-toggle-off text-red-500 text-4xl"></i>
                                    @endif
                                </a>
                                <a href="{{ route('banner.edit', ['banner' => $item->id]) }}">
                                    <i class="far fa-edit text-blue-500 text-4xl ml-2"></i>
                                </a>
                                <a href="{{ route('banner.show', ['banner' => $item->id]) }}"
                                    class="text-blue-500 hover:text-blue-900 visited:text-red-500 cursor-pointer">Xem
                                    chi
                                    tiết</a>
                                <!-- create a icon for edit and url -->
                                <form action="{{ route('banner.destroy', ['banner' => $item->id]) }}" method="POST"
                                    style="display:inline;"
                                    onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">
                                        <i class="fas fa-trash text-red-500 text-4xl ml-2"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination mt-2">
                {{ $list->links() }}
            </div>

        </div>
    </div>
</x-layout--admin>
