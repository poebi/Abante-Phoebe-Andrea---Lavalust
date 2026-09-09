<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - LavaLust CRUD</title>
    <?php $css_path = file_exists($_SERVER['DOCUMENT_ROOT'] . '/css/style.css') ? 'css/style.css' : 'public/css/style.css'; ?>
    <link rel="stylesheet" href="<?= base_url($css_path) ?>">
</head>
<body>

<div class="container" style="max-width: 1000px;">
    <div class="frame-outer">
        <div class="frame-inner" style="padding: 40px;">
            <!-- Corner Accents -->
            <svg class="corner-flourish corner-tl" viewBox="0 0 40 40"><path d="M 4,36 C 4,14 14,4 36,4 M 8,28 C 8,16 16,8 28,8" /><circle cx="36" cy="4" r="2.5" fill="var(--blossom)" /></svg>
            <svg class="corner-flourish corner-tr" viewBox="0 0 40 40"><path d="M 4,36 C 4,14 14,4 36,4 M 8,28 C 8,16 16,8 28,8" /><circle cx="36" cy="4" r="2.5" fill="var(--blossom)" /></svg>
            <svg class="corner-flourish corner-bl" viewBox="0 0 40 40"><path d="M 4,36 C 4,14 14,4 36,4 M 8,28 C 8,16 16,8 28,8" /><circle cx="36" cy="4" r="2.5" fill="var(--blossom)" /></svg>
            <svg class="corner-flourish corner-br" viewBox="0 0 40 40"><path d="M 4,36 C 4,14 14,4 36,4 M 8,28 C 8,16 16,8 28,8" /><circle cx="36" cy="4" r="2.5" fill="var(--blossom)" /></svg>

            <div class="header-actions">
                <h1 class="title-main" style="margin-bottom: 0;">Products Inventory</h1>
                <div class="action-buttons">
                    <a href="<?= site_url('products/create') ?>" class="btn btn-primary">Add New Product</a>
                    <a href="<?= site_url('logout') ?>" class="btn btn-secondary">Logout</a>
                </div>
            </div>

            <?php $success = lava_instance()->session->flashdata('success'); ?>
            <?php if($success): ?>
                <div class="alert alert-success"><?= $success ?></div>
            <?php endif; ?>

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($products)): ?>
                            <?php foreach($products as $product): ?>
                                <tr>
                                    <td><?= html_escape($product['id']) ?></td>
                                    <td><?= html_escape($product['product_name']) ?></td>
                                    <td><?= html_escape($product['description']) ?></td>
                                    <td>$<?= html_escape($product['price']) ?></td>
                                    <td><?= html_escape($product['quantity']) ?></td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="<?= site_url('products/edit/' . $product['id']) ?>" class="btn btn-warning">Edit</a>
                                            <a href="<?= site_url('products/delete/' . $product['id']) ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6">
                                    <div class="empty-state">No products found in the inventory.</div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</body>
</html>
