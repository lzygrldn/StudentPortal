<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
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
    <h2>Register</h2>

    <!-- Flash success message -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <!-- Validation errors -->
    <?php if (isset($validation)): ?>
        <div class="alert alert-danger">
            <?= $validation->listErrors() ?>
        </div>
    <?php endif; ?>

    <!-- Registration Form -->
    <form method="post" action="<?= base_url('register') ?>">
        <input type="text" name="name" class="form-control mb-2" placeholder="Name" value="<?= set_value('name') ?>">
        <input type="email" name="email" class="form-control mb-2" placeholder="Email" value="<?= set_value('email') ?>">
        <input type="password" name="password" class="form-control mb-2" placeholder="Password">
        <input type="password" name="password_confirm" class="form-control mb-2" placeholder="Confirm Password">
        <button class="btn btn-primary">Register</button>
        <div>Already have an account?
        <a href="<?= base_url('login') ?>" class="btn btn-link">Login</a>
        </div>
    </form>
</body>
</html>