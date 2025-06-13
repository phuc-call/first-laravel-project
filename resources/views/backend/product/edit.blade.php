<x-layout--admin>
    @include('backend.notifications') <!-- Thêm dòng này -->

    <form action="{{ route('product.update', ['product' => $product->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="content-wrapper">
            <!-- Tiêu đề + nút quay về -->
            <div class="border border-blue-100 mb-3 rounded-lg p-4 shadow-md flex items-center justify-between">
                <h2 class="text-xl font-bold text-blue-600">Cập nhật sản phẩm</h2>
                <a class="bg-green-500 hover:bg-green-600 transition rounded-xl px-4 py-2 text-white flex items-center"
                    href="{{ route('product.index') }}">
                    <i class="fa fa-arrow-left mr-2"></i> Về danh sách
                </a>
            </div>

            <!-- Form nhập liệu -->
            <div class="border border-blue-100 rounded-lg p-4 shadow-md">
                <!-- Chia thành 2 cột (responsive) -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Cột 1 & 2: Thông tin sản phẩm -->
                    <div class="col-span-2 space-y-3">
                        <!-- Nhập tên & danh mục -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="name" class="font-semibold">Tên sản phẩm</label>
                                <input value="{{ old('name', $product->name) }}" type="text"
                                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-400"
                                    placeholder="Nhập tên sản phẩm" name="name" id="name">
                                @if ($errors->has('name'))
                                    <div class="text-red-500 text-sm mt-1">{{ $errors->first('name') }}</div>
                                @endif
                            </div>
                            <div>
                                <label for="category_id" class="font-semibold">Danh mục</label>
                                <select name="category_id" id="category_id"
                                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-400">
                                    @foreach ($list_category as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Chi tiết sản phẩm -->
                        <div>
                            <label for="detail" class="font-semibold">Chi tiết sản phẩm</label>
                            <textarea name="detail" id="detail"
                                class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-400"
                                placeholder="Nhập chi tiết sản phẩm">{{ old('detail', $product->detail) }}</textarea>
                            @if ($errors->has('detail'))
                                <div class="text-red-500 text-sm mt-1">{{ $errors->first('detail') }}</div>
                            @endif
                        </div>

                        <!-- Thương hiệu & trạng thái -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="brand_id" class="font-semibold">Thương hiệu</label>
                                <select name="brand_id" id="brand_id"
                                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-400">
                                    @foreach ($list_brand as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $product->brand_id == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="status" class="font-semibold">Trạng thái</label>
                                <select name="status" id="status"
                                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-400">
                                    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Xuất bản
                                    </option>
                                    <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Không xuất bản
                                    </option>
                                </select>
                            </div>
                        </div>

                        <!-- Mô tả -->
                        <div>
                            <label for="description" class="font-semibold">Mô tả</label>
                            <textarea name="description" id="description"
                                class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-400"
                                placeholder="Nhập mô tả sản phẩm">{{ old('description') }}</textarea>
                        </div>
                    </div>

                    <!-- Cột 3: Ảnh sản phẩm + Giá -->
                    <div class="space-y-3">
                        <div>
                            <label for="thumbnail" class="font-semibold">Hình ảnh</label>
                            <input type="file"
                                class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-400"
                                name="thumbnail" id="thumbnail">
                            @if ($errors->has('thumbnail'))
                                <div class="text-red-500 text-sm mt-1">{{ $errors->first('thumbnail') }}</div>
                            @endif
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                            <div>
                                <label for="price_root" class="font-semibold">Giá</label>
                                <input type="number" value="{{ old('price_root') }}" name="price_root" id="price_root"
                                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-400"
                                    placeholder="Nhập giá">
                                @if ($errors->has('price_root'))
                                    <div class="text-red-500 text-sm mt-1">
                                        {{ $errors->first('price_root', $product->price_root) }}</div>
                                @endif
                            </div>
                            <div>
                                <label for="price_sale" class="font-semibold">Giá khuyến mãi</label>
                                <input type="number" value="{{ old('price_sale') }}" name="price_sale" id="price_sale"
                                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-400"
                                    placeholder="Nhập giá khuyến mãi">
                                @if ($errors->has('price_sale'))
                                    <div class="text-red-500 text-sm mt-1">{{ $errors->first('price_sale') }}</div>
                                @endif
                            </div>
                            <div>
                                <label for="qty" class="font-semibold">Số lượng</label>
                                <input type="number" value="{{ old('qty') }}" name="qty" id="qty"
                                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-400"
                                    placeholder="Nhập số lượng">
                                @if ($errors->has('qty'))
                                    <div class="text-red-500 text-sm mt-1">{{ $errors->first('qty', $product->qty) }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Nút lưu sản phẩm -->
                <div class="text-right mt-6">
                    <button
                        class="bg-green-500 hover:bg-green-600 transition rounded-xl px-6 py-3 text-white text-lg font-semibold">
                        <i class="fa fa-save mr-2"></i> Lưu sản phẩm
                    </button>
                </div>
            </div>
        </div>
    </form>
</x-layout--admin>
