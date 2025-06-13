@if (session('error'))
    <div style="color: red">{{ session('error') }}</div>
@endif

@if ($errors->any())
    <div style="color: red">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('admin.register.post') }}" enctype="multipart/form-data">
    @csrf
    <input type="text" name="name" placeholder="Tên" required><br>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="text" name="phone" placeholder="Số điện thoại" required><br>
    <input type="text" name="username" placeholder="Tên đăng nhập" required><br>
    <input type="text" name="address" placeholder="Địa chỉ" required><br>
    <input type="password" name="password" placeholder="Mật khẩu" required><br>
    <input type="password" name="password_confirmation" placeholder="Xác nhận mật khẩu" required><br>
    <input type="file" name="avatar" accept="image/*"><br> <!-- Không yêu cầu ảnh, có thể để trống -->
        <button type="submit">Đăng ký</button>
</form>

<a href="{{ route('admin.login') }}">Quay lại đăng nhập</a>
