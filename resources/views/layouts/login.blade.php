<!DOCTYPE html>
<html>
<head>
<title>Register</title>

<style>
body{
    margin:0;
    font-family:Arial;
    background:#f4f7f1;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
}

.box{
    background:white;
    padding:30px;
    border-radius:15px;
    width:350px;
    text-align:center;
}

input{
    width:100%;
    padding:10px;
    margin:10px 0;
    border-radius:8px;
    border:1px solid #ccc;
}

button{
    width:100%;
    padding:10px;
    background:#4f7f16;
    color:white;
    border:none;
    border-radius:8px;
}

a{
    display:block;
    margin-top:10px;
    color:#4f7f16;
    text-decoration:none;
}
</style>
</head>

<body>

<div class="box">

    <h2>LOGIN</h2>
<form method="POST" action="/login">
    @csrf

    <input type="email" name="email" placeholder="Email" required>

    <input type="password" id="pass" name="password" placeholder="Password" required>

    <label>
        <input type="checkbox" onclick="toggle()"> Show Password
    </label>

    <button type="submit">Login</button>
</form>

<a href="/register">Belum punya akun?</a>

<script>
function toggle(){
    let p = document.getElementById("pass");
    p.type = (p.type === "password") ? "text" : "password";
}
</script>
</body>
</html>