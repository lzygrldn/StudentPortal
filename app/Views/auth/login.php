<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f9fafb;
            margin-top: 60px;
        }
        h2 {
            text-align: center;
            color: #800080;
            font-weight: 600;
            margin-bottom: 25px;
        }
        form {
            max-width: 420px;
            margin: 0 auto;
        }
        .btn-primary{
            width: 100%;
            background: #800080;
            border: none;
            color: #fff;
        }
        .btn-primary:hover {
            background: #670367ff;
        }
        .btn-link {
            color: #800080;
            font-weight: 500;
            text-decoration: underline;
        }
        .btn-link:hover {
            color: #670367ff;
            text-decoration: none;
        }
        .form-control {
            border-radius: 6px;
        }
        .link {
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body class="container mt-5">

    <h2>Login</h2>

    <!-- Flash Messages -->
    <?php if(session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <!-- Login Form -->
    <form method="post" action="<?= base_url('login') ?>">
        <input type="email" name="email" value="<?= old('email') ?>" class="form-control mb-2" placeholder="Email" required>
        <input type="password" name="password" class="form-control mb-2" placeholder="Password" required>

        <button class="btn btn-primary">Login</button>

        <div class="link">
            Don't have an account?
            <a href="<?= base_url('register') ?>" class="btn btn-link p-0">Register</a>
        </div>
    </form>

</body>
</html>