<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <form action="{{ route('admin.register.post') }}" method="POST">
        @csrf
        <div>
            <label for="name">Họ và tên</label>
            <input type="text" name="name" id="name" class="border p-2" required>
        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="border p-2" required>
        </div>
        <div>
            <label for="username">Tên đăng nhập</label>
            <input type="text" name="username" id="username" class="border p-2" required>
        </div>
        <div>
            <label for="password">Mật khẩu</label>
            <input type="password" name="password" id="password" class="border p-2" required>
        </div>
        <div>
            <label for="password_confirmation">Xác nhận mật khẩu</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="border p-2" required>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2">Đăng ký</button>
    </form>
</body>

</html>