<x-layout--admin>
    @if($errors->any())
    <div
        x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 5000)"
        x-show="show"
        class="bg-red-500 text-white px-4 py-3 rounded-md shadow-md flex items-center justify-between transition-all duration-300">
        <span>Vui lòng xem lại</span>
        <button @click="show = false" class="ml-4 text-black font-bold">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>
    @endif

    <form action="{{ route('topic.store') }}" method="post" enctype="multipart/form-data" class="p-4 bg-white shadow-md rounded-lg">
        @csrf
        <div class="content-wrapper">
            <!-- Header -->
            <div class="border border-blue-100 mb-4 rounded-lg p-3 flex justify-between items-center bg-blue-50">
                <h2 class="text-xl font-bold text-blue-600">THÊM DANH MỤC</h2>
                <a class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition"
                    href="{{route('topic.index')}}">
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
                        @if($errors->has('name'))
                        <div class="text-red-500">{{$errors->first('name')}}</div>
                        @endif
                    </div>

                    <!-- nhập slug -->
                    <div>
                        <label for="slug" class="font-semibold">Slug</label>
                        <input type="text" name="slug" id="slug"
                            class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-300"
                            placeholder="Tạo tự động hoặc nhập slug" value="{{ old('slug') }}">
                        @if($errors->has('slug'))
                        <div class="text-red-500">{{$errors->first('slug')}}</div>
                        @endif
                    </div>

                    <!-- nhập mô tả -->
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
                    <!-- Trạng thái -->
                    <div>
                        <label for="status" class="font-semibold">Trạng thái</label>
                        <select name="status" id="status"
                            class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-300">
                            <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Xuất bản</option>
                            <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Không xuất bản</option>
                        </select>
                        @if($errors->has('status'))
                        <div class="text-red-500">{{$errors->first('status')}}</div>
                        @endif
                    </div>

                    <!-- Nút submit -->
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