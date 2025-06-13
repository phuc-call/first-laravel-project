<x-layout--admin>
    <div class="basis-4/5 bg-white ml-3 rounded-sm h-full">
        <div class="menufd">
            <div class="menu flex justify-between">
                <h1 class="title m-4 text-blue-500 font-[500] text-2xl">VÙNG NHỚ TẠM</h1>

                <div class="update-delete flex">
                    <a class="bg-green-500 rounded-xl mr-2 scale-75" href="{{ route('product.create') }}">
                        <div>
                            <div class="updata m-4 font-[500] text-2xl text-white"><i class="fas fa-plus-square"></i>
                                Thêm</div>
                        </div>
                    </a>
                    <a class="bg-green-500 rounded-xl mr-2 scale-75" href="{{ route('product.index') }}">
                        <div>
                            <div class="updata m-4 font-[500] text-2xl text-white">
                                Về danh mục</div>
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
                        <th class="border border-gray-500 px-4 py-2">Hình</th>
                        <th class="border border-gray-500 px-4 py-2">Tên sản phẩm</th>
                        <th class="border border-gray-500 px-4 py-2">Tên thư mục</th>
                        <th class="border border-gray-500 px-4 py-2">Tên thương hiệu</th>
                        <th class="border border-gray-500 px-4 py-2">ID</th>
                        <th class="border border-gray-500 px-4 py-2">Số lượng</th>
                        <th class="border border-gray-500 px-4 py-2">Status</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($list as $item)
                        <tr class="bg-gray-100 hover:bg-gray-200">
                            <td class="border border-gray-500 px-4 py-2">
                                @if (!empty($item->thumbnail))
                                    <img class="w-32 h-32 object-cover"
                                        src="{{ asset('assets/images/product/' . $item->thumbnail) }}" alt="">
                                @endif
                            </td>
                            <td class="border border-gray-500 px-4 py-2">{{ $item->name }}</td>
                            <td class="border border-gray-500 px-4 py-2">{{ $item->categoryname }}</td>
                            <td class="border border-gray-500 px-4 py-2">{{ $item->brandname }}</td>
                            <td class="border border-gray-500 px-4 py-2">{{ $item->id }}</td>
                            <td class="border border-gray-500 px-4 py-2">{{ $item->qty }}</td>
                            <td class="border border-gray-500 px-4 py-2">
                                <!-- Khôi phục -->
                                <a href="{{ route('product.restore', ['product' => $item->id]) }}">
                                    <i class="fa-solid fa-trash-arrow-up text-green-600 text-4xl"></i>
                                </a>

                                <!-- Xóa vĩnh viễn -->
                                <a href="{{ route('product.delete', ['product' => $item->id]) }}"
                                    onclick="return confirm('Bạn có chắc muốn xóa vĩnh viễn không?');">
                                    <i class="fa-solid fa-ban text-red-600 text-4xl ml-2"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $list->links() }}
    </div>
</x-layout--admin>
