<x-layout--admin>
    <div class="basis-4/5 bg-white ml-3 rounded-sm h-full">
        <div class="menufd">
            <div class="menu flex justify-between">
                <div class="title m-4 text-blue-500 font-[500] text-2xl">QUAN LÝ GIỚI HIỆU</div>
                <div class="update-delete flex">
                    <a class="bg-green-500 rounded-xl mr-2 scale-75" href="{{ route('contact.create') }}">
                        <div>
                            <div class="updata m-4 font-[500] text-2xl text-white"><i class="fas fa-plus-square"></i> Thêm
                            </div>
                        </div>
                    </a>
                    <a class="bg-green-500 rounded-xl mr-2 scale-75" href="{{ route('contact.index') }}">
                        <div>
                            <div class="delete m-4 font-[500] text-2xl text-white">Về danh mục</div>
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
                                <!-- Khôi phục -->
                                <a href="{{ route('contact.restore', ['contact' => $item->id]) }}">
                                    <i class="fa-solid fa-trash-arrow-up text-green-600 text-4xl"></i>
                                </a>

                                <!-- Xóa vĩnh viễn -->
                                <a href="{{ route('contact.delete', ['contact' => $item->id]) }}"
                                    onclick="return confirm('Bạn có chắc muốn xóa vĩnh viễn không?');">
                                    <i class="fa-solid fa-ban text-red-600 text-4xl ml-2"></i>
                                </a>
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
