<!DOCTYPE html>
<html>
<head>
<title>Lupa Password</title>

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

    <h2>Lupa Password</h2>

    <form method="POST" action="/forgot-password">
        @csrf


        <input type="email" name="email" placeholder="Email" required>

        <input type="password" id="p1" name="password" placeholder="Password Baru" required>

        <input type="password" id="p2" name="password_confirmation" placeholder="Konfirmasi Password Baru" required>

        <label>
            <input type="checkbox" onclick="toggle()"> Show Password
        </label>

        <button type="submit">Kirim</button>
    </form>

    <a href="/login">Kembali ke Login</a>

</div>

<script>
function toggle(){
    let a = document.getElementById("p1");
    let b = document.getElementById("p2");

    a.type = a.type === "password" ? "text" : "password";
    b.type = b.type === "password" ? "text" : "password";
}
</script>

</body>
</html>