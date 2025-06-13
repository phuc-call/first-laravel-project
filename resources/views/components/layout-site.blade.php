<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Trang chủ' }}</title>
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
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    {{ $header ?? '' }}
    <style>
        #product-container {
            scrollbar-width: none;
            /* Ẩn thanh cuộn trên Firefox */
            -ms-overflow-style: none;
            /* Ẩn thanh cuộn trên Internet Explorer và Edge */
        }

        #product-container::-webkit-scrollbar {
            display: none;
            /* Ẩn thanh cuộn trên Chrome, Safari và Edge */
        }

        /* Thêm vào file CSS của bạn */
        .overflow-x-auto {
            scroll-behavior: smooth;
        }

        /* Thêm vào file CSS của bạn */
        .product_hot {
            position: relative;
        }

        .product_hot button {
            z-index: 10;
        }

        .product_hot .flex {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body>
    <header class="bg-black text-white shadow-md">
        <div class="mx-auto"> <!-- Căn giữa ngang (mx-auto) -->

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 py-4 px-4 items-center">

                <div class="md:hidden"> <!-- md:hidden: ẩn khi màn hình ≥768px -->
                    <button id="menu-toggle" class="focus:outline-none">
                        <i class="fa-solid fa-bars text-2xl"></i> <!-- text-2xl: kích thước font lớn (~1.5rem) -->
                    </button>
                </div>

                <div class="flex items-center space-x-1">

                    <img src="{{ asset('asset/images/9d42196f-40a9-44b6-b683-98b8e8479258 (1).webp') }}" alt="logo"
                        class="h-20">
                    <h1 class="text-[1.5rem] text-red-500">ĐIỆN MÁY ĐỎ</h1>
                </div>

                <div class="relative w-full max-w-lg mx-auto">
                    <input type="search" name="query" placeholder="Tìm kiếm..."
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">

                </div>

                <div class="hidden md:flex justify-between md:justify-end space-x-6 text-white">

                    <a href="{{ route('site.home') }}"
                        class="{{ Route::is('site.home') ? 'text-red-500' : 'hover:text-red-500' }} nav-active">TRANG
                        CHỦ</a>
                    <!-- text-red-600: chữ đỏ tươi -->
                    <a href="{{ route('site.contact') }}"
                        class="nav-active hover:text-red-500  {{ Route::is('site.contact') ? 'text-red-500' : 'hover:text-red-500' }}">LIÊN
                        HỆ</a>
                    <a href="{{ route('site.product') }}"
                        class="nav-active hover:text-red-500 {{ Route::is('site.product*') ? 'text-red-500' : 'hover:text-red-500' }}">SẢN
                        PHẨM</a>

                    <a href="#" class="nav-active flex items-center space-x-2 hover:text-red-500">
                        <i class="fa-solid fa-basket-shopping text-xl"></i> <!-- text-xl: cỡ chữ lớn (~1.25rem) -->
                        <span>GIỎ HÀNG</span>
                    </a>
                </div>
            </div>
            <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 hidden z-40">
            </div>

            <div id="mobile-menu" class="fixed top-0 left-0 h-full w-1/4 bg-black text-white px-4 py-4 z-50 hidden">
                <div class="flex flex-col gap-4 h-full">
                    <a href="#" class="nav-active text-red-600 menu-item">TRANG CHỦ</a>
                    <a href="#" class="nav-active hover:text-red-500 menu-item">LIÊN HỆ</a>
                    <a href="#" class="nav-active flex items-center space-x-2 hover:text-red-500 menu-item">
                        GIỎ HÀNG
                    </a>
                </div>
            </div>
        </div>

    </header>


    <!-- JS Toggle -->
    <script>
        const menuToggle = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        const overlay = document.getElementById('overlay');
        const menuItems = document.querySelectorAll('.menu-item');

        menuToggle.addEventListener('click', () => {
            mobileMenu.classList.remove('hidden');
            overlay.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        });
        // Close menu when clicking outside
        const naveActive = document.querySelectorAll('.nav-active');
        naveActive.forEach(item => {
            item.addEventListener('click', () => {
                naveActive.forEach(i => i.classList.remove('text-red-600'));
                item.classList.add('text-red-600');
            });
        });

        overlay.addEventListener('click', closeMenu);
        menuItems.forEach(item => item.addEventListener('click', closeMenu));

        function closeMenu() {
            mobileMenu.classList.add('hidden');
            overlay.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }
    </script>
    <x-main-menu />
    <div class="flex flex-col gap-4 justify-between mx-auto">
        {{-- silder --}}
        {{-- postlist --}}
        <x-list-post />
    </div>





    {{ $slot }}

    <div class="">
        {{-- postlist --}}
        <x-list-topic />
    </div>
    <footer id="footer" class="bg-[#F5F5F5] max-w-full">
        <div class="footer flex max-w-6xl mx-auto">
            <div class="content-1 my-10 basis-6/12">
                <div class="logo mt-6">
                    <img src="{{ asset('asset/images/logo1.webp') }}" alt="">
                </div>
                <div class="text mt-6">
                    <div class="mt-5 flex items-center gap-x-3 hover:text-green-400">
                        <i class="text-green-700 fa-solid fa-location-dot"></i>
                        <a href=""> <span class="cursor-default">Tầng 6 toà nhà Ladeco, 266 Đội Cấn, Ba Đình, Hà
                                Nội </span></a>
                    </div>
                    <div class="mt-5 flex items-center gap-x-3 hover:text-green-400">
                        <i class="text-green-700 fa-solid fa-phone"></i>
                        <a href=""><span> 1900 6750</span></a>
                    </div>
                    <div class="mt-5 flex items-center gap-x-3 hover:text-green-400">
                        <i class="text-green-700 fa-solid fa-envelope"></i>
                        <a href=""> <span class="text-green-700 font-medium">support@sapo.vn</span></a>

                    </div>
                </div>
            </div>
            <div class="content-2 my-10 basis-6/12 ">
                <div class="output">
                    <div class="flex gap-x-10">
                        <div class="basis-6/12"> <input type="text" placeholder="Họ tên"
                                class="border w-full rounded-3xl px-4 py-3"></div>
                        <div class="basis-6/12"><input type="text" placeholder="Email"
                                class="border w-full rounded-3xl px-4 py-3"></div>
                    </div>
                    <div class="flex mt-5">
                        <div class="basis-full">
                            <input type="text" placeholder="Họ tên" class="border w-full rounded-3xl px-4 py-3">
                        </div>
                    </div>
                    <div class="flex mt-5">
                        <div class="basis-full text-right">
                            <button class="bg-green-500 text-white rounded-3xl px-10 py-3">Gửi</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </footer>
    {{ $footer ?? '' }}
</body>

</html>
