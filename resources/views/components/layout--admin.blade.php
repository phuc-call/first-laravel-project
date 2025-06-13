<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Trang quản lý' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="/tailwind.config.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.css" />
</head>

<body>
    <header class="bg-blue-600 text-white flex items-center px-4 py-2">
        <div class="basis-2/12 font-bold text-lg">
            QUẢN LÝ
        </div>

        <div class="basis-10/12 flex justify-end items-center space-x-4 text-sm">
            <span class="flex items-center">
                @if (Auth::user()->avatar && file_exists(public_path('assets/images/avatar/' . Auth::user()->avatarFile)))
                    <img src="{{ asset('assets/images/avatar/' . Auth::user()->avatar) }}" alt="Avatar"
                        class="w-8 h-8 rounded-full mr-2">
                @else
                    <i class="fas fa-user mr-2"></i>
                @endif

                {{ Auth::user()->name }}
            </span>
            <span class="flex items-center">
                <i class="fas fa-clock mr-1"></i> <a href="{{ route('admin.logout') }}">Đăng xuất</a>
            </span>
        </div>
    </header>

    <main class="flex w-full min-h-screen">
        <!-- Cột trái: Sidebar -->
        <aside class="basis-2/12 bg-blue-50 border-r border-gray-200 p-2">
            <ul class="space-y-2">
                <li class="p-2 bg-yellow-100 rounded-4xl"> <a href="">Bảng điều khiển</a></li>
                <li class="p-2  bg-yellow-100 rounded-4xl"> <a href="">Quản lý sản phẩm</a>
                    <ul>
                        <li class="p-2  rounded"><a href="{{ route('product.index') }}">Sản phẩm</a></li>
                        <li class="p-2  rounded"> <a href="{{ route('category.index') }}">Danh mục</a></li>
                        <li class="p-2  rounded"><a href="{{ route('brand.index') }}">Thương hiệu</a></li>
                    </ul>
                </li>
                <!--  -->
                <li class="p-2  bg-yellow-100 rounded-4xl">
                    <a href="">Quản lý bài viết</a>
                    <ul>
                        <li class="p-2  rounded"><a href="{{ route('post.index') }}">Bài viết</a></li>
                        <li class="p-2  rounded"><a href="{{ route('topic.index') }}">Chủ đề</a></li>
                    </ul>
                </li>

                <li class="p-2  bg-yellow-100 rounded-4xl"><a href="">Giao diện</a>
                    <ul>
                        <li class="p-2  rounded"><a href="{{ route('menu.index') }}">Menu</a></li>
                        <li class="p-2  rounded"><a href="{{ route('banner.index') }}">Banner</a></li>
                    </ul>
                </li>

                <li class="p-2  bg-yellow-100 rounded-4xl"><a href="{{ route('contact.index') }}">Liên hệ</a></li>
                <li class="p-2  bg-yellow-100 rounded-4xl"><a href="{{ route('order.index') }}">Đơn hàng</a></li>
                <li class="p-2  bg-yellow-100 rounded-4xl"><a href="{{ route('user.index') }}">Khách hàng</a></li>
                <li class="p-2  bg-yellow-100 rounded-4xl"><a href="">Thành viên</a></li>
            </ul>
        </aside>

        <!-- Cột phải: Nội dung chính -->
        <section class="basis-10/12 p-4">
            <!-- Thanh tiêu đề & nút -->
            {{ $slot }}
        </section>
    </main>


    <footer class="bg-blue-500">
        <div class="border-t-2 border-pink-500 py-3 text-center text-white">THIẾT KẾ WEB BỞI : Võ Hồng Phúc</div>
    </footer>
    {{ $footer ?? '' }}
</body>

</html>
