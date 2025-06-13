<x-layout--admin>
    <div class="basis-4/5 bg-white ml-3 rounded-sm h-full">
        <div class="menufd">
            <div class="menu flex justify-between">
                <div class="title m-4 text-blue-500 font-[500] text-2xl">USER</div>
                <div class="update-delete flex">
                    <a class="bg-green-500 rounded-xl mr-2 scale-75" href="{{ route('user.create') }}">
                        <div>
                            <div class="updata m-4 font-[500] text-2xl text-white"><i class="fas fa-plus-square"></i> Thêm
                            </div>
                        </div>
                    </a>
                    <a class="bg-red-500 rounded-xl mr-2 scale-75" href="{{ route('user.trash') }}">
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
                        <th class="border border-gray-500 px-4 py-2">Phone</th>
                        <th class="border border-gray-500 px-4 py-2">Email</th>
                        <th class="border border-gray-500 px-4 py-2">Address</th>
                        <th class="border border-gray-500 px-4 py-2">Password</th>
                        <th class="border border-gray-500 px-4 py-2">Status</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($list as $item)
                        <tr class="bg-gray-100 hover:bg-gray-200">
                            <td class="border border-gray-500 px-4 py-2">{{ $item->id }}</td>
                            <td class="border border-gray-500 px-4 py-2">{{ $item->name }}</td>
                            <td class="border border-gray-500 px-4 py-2">{{ $item->phone }}</td>
                            <td class="border border-gray-500 px-4 py-2">{{ $item->email }}</td>
                            <td class="border border-gray-500 px-4 py-2">{{ $item->address }}</td>
                            <td class="border border-gray-500 px-4 py-2">{{ $item->password }}</td>
                            <td class="border border-gray-500 px-4 py-2 flex justify-center">
                                <a class="text-blue-500 visited:text-red-500 hover:text-blue-900"
                                    href="{{ route('user.show', ['user' => $item->id]) }}">
                                    xem chi tiết
                                </a>
                                <!-- create a icon for status -->
                                <a href="{{ route('user.status', ['user' => $item->id]) }}">
                                    @if ($item->status == 1)
                                        <i class="fa-solid fa-toggle-on text-green-500 text-4xl"></i>
                                    @else
                                        <i class="fa-solid fa-toggle-off text-red-500 text-4xl"></i>
                                    @endif
                                </a>
                                <a href="{{ route('user.edit', ['user' => $item->id]) }}">
                                    <i class="far fa-edit text-blue-500 text-4xl ml-2"></i>
                                </a>
                                <!-- create a icon for edit and url -->
                                <form action="{{ route('user.destroy', ['user' => $item->id]) }}" method="POST"
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

</x-layout--admin>
