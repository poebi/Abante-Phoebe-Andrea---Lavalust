<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - LavaLust CRUD</title>
    <?php $css_path = file_exists($_SERVER['DOCUMENT_ROOT'] . '/css/style.css') ? 'css/style.css' : 'public/css/style.css'; ?>
    <link rel="stylesheet" href="<?= base_url($css_path) ?>">
</head>
<body>

<div class="container" style="max-width: 450px;">
    <div class="frame-outer">
        <div class="frame-inner">
            <!-- Corner Accents -->
            <svg class="corner-flourish corner-tl" viewBox="0 0 40 40"><path d="M 4,36 C 4,14 14,4 36,4 M 8,28 C 8,16 16,8 28,8" /><circle cx="36" cy="4" r="2.5" fill="var(--blossom)" /></svg>
            <svg class="corner-flourish corner-tr" viewBox="0 0 40 40"><path d="M 4,36 C 4,14 14,4 36,4 M 8,28 C 8,16 16,8 28,8" /><circle cx="36" cy="4" r="2.5" fill="var(--blossom)" /></svg>
            <svg class="corner-flourish corner-bl" viewBox="0 0 40 40"><path d="M 4,36 C 4,14 14,4 36,4 M 8,28 C 8,16 16,8 28,8" /><circle cx="36" cy="4" r="2.5" fill="var(--blossom)" /></svg>
            <svg class="corner-flourish corner-br" viewBox="0 0 40 40"><path d="M 4,36 C 4,14 14,4 36,4 M 8,28 C 8,16 16,8 28,8" /><circle cx="36" cy="4" r="2.5" fill="var(--blossom)" /></svg>

            <h1 class="title-main centered">Login</h1>

            <?php $error = lava_instance()->session->flashdata('error'); ?>
            <?php if($error): ?>
                <div class="alert alert-error"><?= $error ?></div>
            <?php endif; ?>

            <form action="<?= site_url('login') ?>" method="POST">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 10px;">Log In</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>
