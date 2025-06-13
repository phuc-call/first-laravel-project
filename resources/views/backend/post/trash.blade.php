<x-layout--admin>
    @include('backend.notifications')
    <div class="basis-4/5 bg-white ml-3 rounded-sm h-full">
        <div class="postfd">
            <div class="post flex justify-between">
                <div class="title m-4 text-blue-500 font-[500] text-2xl">QUAN LY BÀI VIẾT</div>
                <div class="update-delete flex">
                    <a class="bg-green-500 rounded-xl mr-2 scale-75" href="{{ route('post.create') }}">
                        <div>
                            <div class="updata m-4 font-[500] text-2xl text-white"><i class="fas fa-plus-square"></i> Thêm
                            </div>
                        </div>
                    </a>
                    <a class="bg-green-500 rounded-xl mr-2 scale-75" href="{{ route('post.index') }}">
                        <div>
                            <div class="delete m-4 font-[500] text-2xl text-white">Về danh
                                mục</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <!-- bảng post -->
        <div class="table w-full mt-3">
            <table class="table-auto border-collapse border border-gray-400 w-full">
                <thead>
                    <tr class="bg-gray-800 text-white">
                        <th class="border border-gray-500 px-4 py-2">ID</th>
                        <th class="border border-gray-500 px-4 py-2">Image</th>
                        <th class="border border-gray-500 px-4 py-2">slug</th>
                        <th class="border border-gray-500 px-4 py-2">title</th>

                        <th class="border border-gray-500 px-4 py-2">Status</th>
                        <th class="border border-gray-500 px-4 py-2">Discription</th>
                        <th class="border border-gray-500 px-4 py-2">Detail</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($list as $item)
                        <tr class="bg-gray-100 hover:bg-gray-200">
                            <td class="border border-gray-500 px-4 py-2">{{ $item->id }}</td>
                            <td class="border border-gray-500 px-4 py-2">

                                @if (!empty($item->thumbnail))
                                    <img src="{{ asset('assets/thumbnail/post/' . $item->thumbnail) }}" alt=""
                                        class="w-20 h-20 object-cover rounded">
                                @endif

                            </td>
                            <td class="border border-gray-500 px-4 py-2">{{ $item->slug }}</td>
                            <td class="border border-gray-500 px-4 py-2">{{ $item->title }}</td>

                            <td class="border border-gray-500 px-4 py-2">{{ $item->detail }}</td>
                            <td class="border border-gray-500 px-4 py-2">{{ $item->description }}</td>


                            <td class="border border-gray-500 px-4 py-2">
                                <!-- Khôi phục -->
                                <a href="{{ route('post.restore', ['post' => $item->id]) }}">
                                    <i class="fa-solid fa-trash-arrow-up text-green-600 text-4xl"></i>
                                </a>

                                <!-- Xóa vĩnh viễn -->
                                <a href="{{ route('post.delete', ['post' => $item->id]) }}"
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
