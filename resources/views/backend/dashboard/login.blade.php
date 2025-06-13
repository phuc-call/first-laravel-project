<form method="POST" action="{{ route('admin.login.post') }}">
    @csrf
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Mật khẩu" required><br>
    <button type="submit">Đăng nhập</button>
</form>
<a href="{{ route('admin.register') }}">Đăng ký tài khoản</a>
