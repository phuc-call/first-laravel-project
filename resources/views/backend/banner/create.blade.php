<x-layout--admin>
    <form action="{{ route('banner.store') }}" method="post" enctype="multipart/form-data" class="p-4 bg-white shadow-md rounded-lg">
        @csrf
        <div class="content-wrapper">
            <!-- Header -->
            <div class="border border-blue-100 mb-4 rounded-lg p-3 flex justify-between items-center bg-blue-50">
                <h2 class="text-xl font-bold text-blue-600">KHU VỰC BANNER</h2>
                <a class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition"
                    href="{{route('banner.index')}}">
                    <i class="fa fa-arrow-left"></i> Về danh sách
                </a>
            </div>

            <div class="border border-blue-100 rounded-lg p-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                <!-- Cột 1: Thông tin danh mục -->
                <div class="col-span-2 space-y-3">
                    <!-- nhập tên danh mục -->
                    <div>
                        <label for="name" class="font-semibold">Tên thương hiệu</label>
                        <input type="text" name="name" id="name"
                            class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-300"
                            placeholder="Nhập tên danh mục" value="{{ old('name') }}">
                        @if($errors->has('name'))
                        <div class="text-red-500">{{$errors->first('name')}}</div>
                        @endif
                    </div>
                    <!-- nhập miêu tả -->
                    <div>
                        <label for="description" class="font-semibold">Mô tả</label>
                        <textarea name="description" id="description"
                            class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-300"
                            rows="4">{{ old('description') }}</textarea>
                        @if($errors->has('description'))
                        <div class="text-red-500">{{$errors->first('description')}}</div>
                        @endif
                    </div>
                </div>

                <!-- Cột 2: Cấu hình danh mục -->
                <div class="space-y-3">

                    <div>
                        <label for="sort_order" class="font-semibold">sort_order</label>
                        <input type="number" value="{{ old('sort_order') }}" name="sort_order" id="sort_order" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-400" placeholder="">
                        @if($errors->has('sort_order'))
                        <div class="text-red-500">{{$errors->first('sort_order')}}</div>
                        @endif
                    </div>

                    <div>
                        <label for="image" class="font-semibold">Hình ảnh</label>
                        <input type="file" name="image" id="image"
                            class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-300">
                        @if($errors->has('image'))
                        <div class="text-red-500">{{$errors->first('image')}}</div>
                        @endif
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
    <!-- bảng product -->
</x-layout--admin>