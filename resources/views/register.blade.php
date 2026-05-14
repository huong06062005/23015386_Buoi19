<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>

<h1>ĐĂNG KÝ TÀI KHOẢN</h1>

@if($errors->any())
    <div style="color:red">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<form method="POST" action="{{ url('/register') }}">

    @csrf

    <div>
        Họ tên
    </div>

    <input type="text" name="name" value="{{ old('name') }}">

    <br><br>

    <div>
        Username
    </div>

    <input type="text" name="username" value="{{ old('username') }}">

    <br><br>

    <div>
        Password
    </div>

    <input type="password" name="password">

    <br><br>

    <button type="submit">
        Register
    </button>

</form>

<br>

<a href="{{ url('/login') }}">
    Đã có tài khoản? Đăng nhập
</a>

</body>
</html>