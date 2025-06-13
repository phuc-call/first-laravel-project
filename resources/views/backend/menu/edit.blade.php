<x-layout--admin>
    @include('backend.notifications')
    <form action="{{ route('menu.update', ['menu' => $menu->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="content-wrapper">
            <!-- Header -->
            <div class="border border-blue-100 mb-4 rounded-lg p-3 flex justify-between items-center bg-blue-50">
                <h2 class="text-xl font-bold text-blue-600">THÊM MENU</h2>
                <a class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition"
                    href="{{ route('menu.index') }}">
                    <i class="fa fa-arrow-left"></i> Về danh sách
                </a>
            </div>

            <div class="border border-blue-100 rounded-lg p-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                <!-- Cột 1: Thông tin danh mục -->
                <div class="col-span-2 space-y-3">
                    <!-- nhập tên danh mục -->
                    <div>
                        <label for="name" class="font-semibold">Tên danh mục</label>
                        <input type="text" name="name" id="name"
                            class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-300"
                            placeholder="Nhập tên danh mục" value="{{ old('name') }}">

                    </div>
                    <div>
                        <label for="name" class="font-semibold">Đừng link</label>
                        <input type="text" name="link" id="link"
                            class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-300"
                            placeholder="Nhập tên danh mục" value="{{ old('link') }}">

                    </div>
                    <!-- nhập miêu tả -->
                    <label for="type"><strong>Vai trò</strong></label>
                    <select name="type" id="type" class="w-full border border-gray-300 rounded-lg p-2">

                        <option value="custom">Custom</option>
                    </select>

                </div>

                <!-- Cột 2: Cấu hình danh mục -->
                <div class="space-y-3">
                    <div>
                        <label for="parent_id" class="font-semibold">parent_id</label>
                        <input type="number" value="{{ old('parent_id') }}" name="parent_id" id="parent_id"
                            class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-400"
                            placeholder="" value="{{ old('parent_id') }}">

                    </div>
                    <div>
                        <label for="sort_order" class="font-semibold">sort_order</label>
                        <input type="number" value="{{ old('sort_order') }}" name="sort_order" id="sort_order"
                            class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-400"
                            placeholder="">

                    </div>

                    <div>
                        <label for="image" class="font-semibold">Hình ảnh</label>
                        <input type="file" name="image" id="image"
                            class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-300">
                    </div>

                    <div>
                        <label for="status" class="font-semibold">Trạng thái</label>
                        <select name="status" id="status"
                            class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-300">
                            <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Xuất bản</option>
                            <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Không xuất bản</option>
                        </select>
                    </div>

                    <div>
                        <button type="submit"
                            class="w-full bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
                            Lưu danh mục
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-layout--admin>
