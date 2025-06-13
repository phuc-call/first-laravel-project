<x-layout-site>
    <x-slot:title>Liên hệ</x-slot:title>
    @if (session('success'))
        <div id="success" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
            role="alert">
            <strong class="font-bold">Thành công!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20">
                    <title>Close</title>
                    <path
                        d="M14.348 14.849a1 1 0 01-1.414 0L10 11.914l-2.934 2.935a1 1 0 01-1.414-1.414l2.935-2.934-2.935-2.934a1 1 0 011.414-1.414L10 9.086l2.934-2.935a1 1 0 011.414 1.414L11.414 10l2.935 2.934a1 1 0 010 1.415z" />
                </svg>
            </span>
        </div>
    @endif
    <script>
        setTimeout(() => {
            const alert = document.getElementById('success');
            if (alert) {
                alert.style.transition = 'opacity 3s ease';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 3000); //xóa tất cả hiệu ứng
            }
        }, 3000); //3 giây
    </script>

    <!-- Main Content -->
    <main class="flex justify-center items-center m-3 max-w-7xl mx-auto">
        <div class="bg-white p-8 rounded-lg shadow-xl w-full transform transition duration-500  hover:shadow-2xl">
            <h2 class="text-2xl font-semibold text-gray-700 mb-6">Liên hệ với chúng tôi</h2>

            <form action="{{ route('contact.store') }}" method="POST" enctype="multipart/form-data"
                class="p-4 bg-white shadow-md rounded-lg">
                @csrf

                <!-- Tên -->
                <div class="mb-4">
                    <label for="name" class="block text-gray-600">Tên Của Bạn</label>
                    <input type="text" id="name" name="name" required
                        class="w-full p-3 mt-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out transform hover:border-blue-500"
                        placeholder="Nhập tên của bạn">
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-gray-600">Email Của Bạn</label>
                    <input type="email" id="email" name="email" required
                        class="w-full p-3 mt-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out transform hover:border-blue-500"
                        placeholder="Nhập email của bạn">
                </div>

                <!--Phone-->
                <div class="mb-4">
                    <label for="phone" class="block text-gray-600">Phone Của Bạn</label>
                    <input type="phone" id="phone" name="phone" required
                        class="w-full p-3 mt-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out transform hover:border-blue-500"
                        placeholder="Nhập số điện thoại của bạn">
                </div>

                <div>
                    <label for="title" class="font-semibold">Tiêu đề</label>
                    <input type="text" name="title" id="title"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-300" required>

                </div>

                <div>
                    <label for="content" class="font-semibold">content</label>
                    <input type="text" name="content" id="content"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-300" required>
                </div>

                <div>
                    <label for="status" class="font-semibold">Trạng thái</label>
                    <select name="status" id="status"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-300 mb-5">
                        <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Công khai</option>
                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Không công khai  </option>
                    </select>
                </div>

                <!-- Nút Gửi -->
                <div class="flex justify-center">
                    <button type="submit"
                        class="w-full py-3 px-4 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500">Gửi</button>
                </div>
            </form>
        </div>
    </main>
</x-layout-site>
<!-- Footer -->
