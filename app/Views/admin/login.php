<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Maekuki</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Warna Branding Maekuki */
        :root {
            --color-primary: #8B4513; /* Coklat Tua */
            --color-secondary: #DAA520; /* Emas */
            --color-light: #F5F5DC; /* Krem */
            --color-text-dark: #333;
        }

        body {
            font-family: 'Poppins', sans-serif; /* Gunakan font Poppins yang Anda pakai di website */
            background-color: var(--color-light); 
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        /* Container Login yang Diperbarui */
        .login-container {
            background-color: #fff;
            padding: 40px; /* Padding lebih besar */
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15); /* Bayangan lebih halus */
            width: 100%;
            max-width: 400px; /* Lebar lebih besar */
            text-align: center;
        }

        /* Logo Maekuki */
        .login-logo {
            margin-bottom: 25px;
        }
        .login-logo img {
            width: 80px; /* Ukuran Logo */
            height: auto;
        }

        /* Judul */
        .login-container h2 {
            font-size: 1.8rem;
            text-align: center;
            color: var(--color-primary); 
            margin-bottom: 30px;
            font-weight: 700;
        }

        /* Form Group */
        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }
        
        /* Label */
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--color-text-dark);
            font-size: 0.95rem;
        }
        
        /* Ikon pada Label */
        .form-group label i {
            margin-right: 8px;
            color: var(--color-secondary); /* Ikon Emas */
        }

        /* Input Fields yang Diperbarui */
        .form-group input[type="email"],
        .form-group input[type="password"] {
            width: 100%;
            padding: 10px 15px;
            border: 1px solid #D6BC91; /* Border Coklat Muda */
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 1rem;
            transition: all 0.3s;
        }

        /* Efek Fokus Input */
        .form-group input:focus {
            border-color: var(--color-secondary);
            box-shadow: 0 0 0 3px rgba(218, 165, 32, 0.2); /* Bayangan Emas Muda */
            outline: none;
        }

        /* Tombol Login yang Diperbarui */
        .btn-login {
            width: 100%;
            padding: 12px;
            background-color: var(--color-primary); /* Coklat Tua */
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            cursor: pointer;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: background-color 0.3s;
        }
        .btn-login:hover {
            background-color: #6a350e; /* Coklat yang sedikit lebih gelap */
        }
        
        /* Styling Alert (Tetap) */
        .alert {
            padding: 10px;
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            border-radius: 4px;
            margin-bottom: 15px;
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="login-container">
        
        <div class="login-logo">
            <img src="<?= base_url('assets/Asset/maekukilogo.png') ?>" alt="Maekuki Logo">
        </div>

        <h2>Admin Login</h2>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('admin/login') ?>" method="post">
            
            <div class="form-group">
                <label for="email"><i class="fas fa-envelope"></i> Email</label>
                <input type="email" id="email" name="email" value="<?= old('email') ?>" required>
            </div>

            <div class="form-group">
                <label for="password"><i class="fas fa-lock"></i> Password</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit" class="btn-login">Login</button>
        </form>
    </div>

</body>
</html>