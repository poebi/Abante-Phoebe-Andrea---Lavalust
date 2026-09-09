<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product - LavaLust CRUD</title>
    <?php $css_path = file_exists($_SERVER['DOCUMENT_ROOT'] . '/css/style.css') ? 'css/style.css' : 'public/css/style.css'; ?>
    <link rel="stylesheet" href="<?= base_url($css_path) ?>">
</head>
<body>

<div class="container" style="max-width: 600px;">
    <div class="frame-outer">
        <div class="frame-inner" style="padding: 40px;">
            <!-- Corner Accents -->
            <svg class="corner-flourish corner-tl" viewBox="0 0 40 40"><path d="M 4,36 C 4,14 14,4 36,4 M 8,28 C 8,16 16,8 28,8" /><circle cx="36" cy="4" r="2.5" fill="var(--blossom)" /></svg>
            <svg class="corner-flourish corner-tr" viewBox="0 0 40 40"><path d="M 4,36 C 4,14 14,4 36,4 M 8,28 C 8,16 16,8 28,8" /><circle cx="36" cy="4" r="2.5" fill="var(--blossom)" /></svg>
            <svg class="corner-flourish corner-bl" viewBox="0 0 40 40"><path d="M 4,36 C 4,14 14,4 36,4 M 8,28 C 8,16 16,8 28,8" /><circle cx="36" cy="4" r="2.5" fill="var(--blossom)" /></svg>
            <svg class="corner-flourish corner-br" viewBox="0 0 40 40"><path d="M 4,36 C 4,14 14,4 36,4 M 8,28 C 8,16 16,8 28,8" /><circle cx="36" cy="4" r="2.5" fill="var(--blossom)" /></svg>

            <h1 class="title-main centered">Add New Product</h1>
            
            <?php $error = lava_instance()->session->flashdata('error'); ?>
            <?php if($error): ?>
                <div class="alert alert-error"><?= $error ?></div>
            <?php endif; ?>

            <form action="<?= site_url('products/store') ?>" method="POST">
                <div class="form-group">
                    <label for="product_name">Product Name</label>
                    <input type="text" id="product_name" name="product_name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" class="form-control" style="resize:vertical; min-height:80px;"></textarea>
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" step="0.01" id="price" name="price" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="number" id="quantity" name="quantity" class="form-control" required>
                </div>
                <div style="margin-top: 20px; display: flex; gap: 10px;">
                    <button type="submit" class="btn btn-primary" style="flex: 1;">Save Product</button>
                    <a href="<?= site_url('products') ?>" class="btn btn-secondary" style="flex: 1; text-align: center;">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
