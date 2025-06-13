<x-layout--admin>
    @if (session('thongbao') && !$errors->any())
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show"
            class="bg-green-500 text-white px-4 py-3 rounded-md shadow-md flex items-center justify-between transition-all duration-300">
            <span>{{ session('thongbao') }}</span>
            <button @click="show = false" class="ml-4 text-white font-bold">
                ✖
            </button>
        </div>
    @endif
    @include('backend.notifications') <!-- Hiển thị thông báo -->


    <div class="basis-4/5 bg-white ml-3 rounded-sm h-full">
        <div class="menufd">
            <div class="menu flex justify-between">
                <h1 class="title m-4 text-blue-500 font-[500] text-2xl">QUAN LÝ SẢN PHẨM</h1>

                <div class="update-delete flex">
                    <a class="bg-green-500 rounded-xl mr-2 scale-75" href="{{ route('product.create') }}">
                        <div>
                            <div class="updata m-4 font-[500] text-2xl text-white"><i class="fas fa-plus-square"></i>
                                Thêm</div>
                        </div>
                    </a>
                    <a class="bg-red-500 rounded-xl mr-2 scale-75" href="{{ route('product.trash') }}">
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
                                <a class="text-blue-500 visited:text-red-500 hover:text-blue-900"
                                    href="{{ route('product.show', ['product' => $item->id]) }}">Xem
                                    chi tiết
                                </a>
                                <!-- create a icon for status -->
                                <a href="{{ route('product.status', ['product' => $item->id]) }}">
                                    @if ($item->status == 1)
                                        <i class="fa-solid fa-toggle-on text-green-500 text-4xl"></i>
                                    @else
                                        <i class="fa-solid fa-toggle-off text-red-500 text-4xl"></i>
                                    @endif
                                </a>
                                <a href="{{ route('product.edit', ['product' => $item->id]) }}">
                                    <i class="far fa-edit text-blue-500 text-4xl ml-2"></i>
                                </a>
                                <!-- create a icon for edit and url -->
                                <form action="{{ route('product.destroy', ['product' => $item->id]) }}" method="POST"
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
        </div>
        {{ $list->links() }}
    </div>
</x-layout--admin>
