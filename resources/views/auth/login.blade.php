<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login DOSIMAL</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap">
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Poppins', sans-serif;
      background: url('adminlte/dist/img/bg_login.png') no-repeat center center fixed;
      background-size: cover;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .container {
      width: 100%;
      height: 100%;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .login-box {
      background: #FFFFFF;
      width: 350px; /* Lebih kecil */
      padding: 30px; /* Sesuaikan padding */
      box-shadow: 0px 5px 5px rgba(0, 0, 0, 0.25);
      border-radius: 15px;
      text-align: center;
    }

    .logo img {
      width: 80px; /* Ukuran logo lebih kecil */
      height: 80px;
      margin: 0 auto 15px auto; /* Tambahkan margin bawah */
    }

    .title {
      font-size: 22px; /* Ukuran font judul lebih kecil */
      font-weight: 600;
      color: #003399;
      margin: 15px 0 10px;
    }

    .subtitle {
      font-size: 14px; /* Ukuran subtitle lebih kecil */
      font-weight: 600;
      color: #CF4111;
      margin-bottom: 20px;
    }

    .login-form .login-message {
      font-size: 13px; /* Ukuran teks login lebih kecil */
      font-weight: 300;
      color: #000000;
      margin-bottom: 15px;
    }

    .input-group {
      display: flex;
      align-items: center;
      background: #FFFFFF;
      border: 1px solid #000000;
      border-radius: 10px;
      padding: 10px;
      margin-bottom: 10px; /* Kurangi jarak antar input */
    }

    .input-group i {
      margin-right: 10px;
      color: #000000;
    }

    .input-group input {
      border: none;
      outline: none;
      flex: 1;
      font-size: 14px; /* Ukuran font input lebih kecil */
      color: rgba(0, 0, 0, 0.5);
    }

    .remember-me {
      display: flex;
      align-items: center;
      margin: 10px 0; /* Kurangi margin atas dan bawah */
    }

    .remember-me input {
      margin-right: 5px;
    }

    .remember-me label {
      font-size: 12px; /* Ukuran font label lebih kecil */
      color: rgba(0, 0, 0, 0.5);
    }

    .login-button {
      background: #CF4111;
      color: #FFFFFF;
      border: none;
      padding: 10px 20px;
      border-radius: 10px;
      font-size: 14px; /* Ukuran font tombol lebih kecil */
      font-weight: 800;
      cursor: pointer;
      width: 100%;
      margin-top: 15px;
    }

    .login-button:hover {
      background: #b8350e;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="login-box">
      <div class="logo">
        <img src="adminlte/dist/img/polinema.png" alt="Logo Polinema">
      </div>
      <h1 class="title">DOSIMAL</h1>
      <p class="subtitle">JURUSAN TEKNOLOGI INFORMASI</p>
      <form class="login-form">
        <p class="login-message">Login to your account</p>
        <div class="input-group">
          <i class="fas fa-user"></i>
          <input type="text" placeholder="Username">
        </div>
        <div class="input-group">
          <i class="fas fa-lock"></i>
          <input type="password" placeholder="Password">
        </div>
        <div class="remember-me">
          <input type="checkbox" id="remember">
          <label for="remember">Remember me</label>
        </div>
        <button type="submit" class="login-button">LOGIN</button>
      </form>
    </div>
  </div>
</body>
</html>
