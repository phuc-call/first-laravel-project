<x-layout--admin>
    <div class="basis-4/5 bg-white ml-3 rounded-sm h-full">
        <div class="menufd">
            <div class="menu flex justify-between">
                <div class="title m-4 text-blue-500 font-[500] text-2xl">QUAN LÝ GIỚI HIỆU</div>
                <div class="update-delete flex">
                    <a class="bg-red-500 rounded-xl mr-2 scale-75" href="{{ route('contact.trash') }}">
                        <div>
                            <div class="delete m-4 font-[500] text-2xl text-white"><i class="fas fa-trash"></i> Thùng
                                rác</div>
                        </div>
                    </a>
                    <a class="bg-green-500 rounded-xl mr-2 scale-75" href="{{ route('contact.create') }}">
                        <div>
                            <div class="delete m-4 font-[500] text-2xl text-white">Thêm</div>
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
                        <th class="border border-gray-500 px-4 py-2">email</th>
                        <th class="border border-gray-500 px-4 py-2">phone</th>
                        <th class="border border-gray-500 px-4 py-2">title</th>
                        <th class="border border-gray-500 px-4 py-2">content</th>
                        <th class="border border-gray-500 px-4 py-2">Status</th>


                    </tr>
                </thead>
                <tbody>
                    @foreach ($list as $item)
                        <tr class="bg-gray-100 hover:bg-gray-200">
                            <td class="border border-gray-500 px-4 py-2">{{ $item->id }}</td>
                            <td class="border border-gray-500 px-4 py-2">{{ $item->name }}</td>
                            <td class="border border-gray-500 px-4 py-2">
                                {{ $item->email }}
                            </td>
                            <td class="border border-gray-500 px-4 py-2">{{ $item->phone }}</td>
                            <td class="border border-gray-500 px-4 py-2">{{ $item->title }}</td>
                            <td class="border border-gray-500 px-4 py-2">{{ $item->content }}</td>


                            <td class="border border-gray-500 px-4 py-2">
                                <a class="text-blue-500 visited:text-red-500 hover:text-blue-900"
                                    href="{{ route('contact.show', ['contact' => $item->id]) }}">Xem chi tiết</a>
                                <!-- create a icon for status -->
                                <a href="{{ route('contact.status', ['contact' => $item->id]) }}">
                                    @if ($item->status == 1)
                                        <i class="fa-solid fa-toggle-on text-green-500 text-4xl"></i>
                                    @else
                                        <i class="fa-solid fa-toggle-off text-red-500 text-4xl"></i>
                                    @endif
                                </a>

                                <a href="{{ route('contact.edit', ['contact' => $item->id]) }}">
                                    <i class="far fa-edit text-blue-500 text-4xl ml-2"></i>
                                </a>
                                <!-- create a icon for edit and url -->
                                <form action="{{ route('contact.destroy', ['contact' => $item->id]) }}" method="POST"
                                    style="display: inline"
                                    onsubmit="return confirm('bạn chắc chắn muốn xóa sản phẩm này không?')">
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
