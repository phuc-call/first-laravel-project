<x-layout--admin>
    @include('backend.notifications')
    <form action="{{ route('order.update', ['order' => $order->id]) }}" method="post" enctype="multipart/form-data"
        class="p-4 bg-white shadow-md rounded-lg">
        @csrf
        @method('PUT')
        <div class="content-wrapper">
            <!-- Header -->
            <div class="border border-blue-100 mb-4 rounded-lg p-3 flex justify-between items-center bg-blue-50">
                <h2 class="text-xl font-bold text-blue-600">QUẢN LÝ ĐƠN HÀNG</h2>
                <a class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition"
                    href="{{ route('order.index') }}">
                    <i class="fa fa-arrow-left"></i> Về danh sách
                </a>
            </div>

            <div class="border border-blue-100 rounded-lg p-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                <!-- Cột 1: Thông tin order -->
                <div class="col-span-2 space-y-3">
                    <!-- nhập tên người dùng -->
                    <div>
                        <label for="user_id" class="font-semibold">User ID</label>
                        <input type="text" name="user_id" id="user_id"
                            class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-300"
                            placeholder="Nhập User ID" value="{{ old('user_id') }}">

                    </div>

                    <!-- nhập tên người nhận -->
                    <div>
                        <label for="name" class="font-semibold">Tên người nhận</label>
                        <input type="text" name="name" id="name"
                            class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-300"
                            placeholder="Nhập tên người nhận" value="{{ old('name') }}">

                    </div>

                    <!-- nhập số điện thoại -->
                    <div>
                        <label for="phone" class="font-semibold">Số điện thoại</label>
                        <input type="text" name="phone" id="phone"
                            class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-300"
                            placeholder="Nhập số điện thoại" value="{{ old('phone') }}">

                    </div>

                    <!-- nhập email -->
                    <div>
                        <label for="email" class="font-semibold">Email</label>
                        <input type="email" name="email" id="email"
                            class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-300"
                            placeholder="Nhập email" value="{{ old('email') }}">

                    </div>

                    <!-- nhập địa chỉ -->
                    <div>
                        <label for="address" class="font-semibold">Địa chỉ</label>
                        <textarea name="address" id="address"
                            class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-300" rows="4">{{ old('address') }}</textarea>

                    </div>
                </div>

                <!-- Cột 2: Cấu hình order -->
                <div class="space-y-3">
                    <!-- nhập trạng thái -->
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
                            Lưu order
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- bảng product -->
</x-layout--admin>
