<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    .gallery-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
    }

    .gallery-item {
        position: relative;
        width: 300px;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.1);
        background-color: #fff;
        transition: transform 0.3s ease;
    }

    .gallery-item:hover {
        transform: scale(1.03);
    }

    .gallery-item img {
        width: 100%;
        height: 250px;
        object-fit: contain;
        background-color: #f8f9fa;
    }

    .product-header {
        padding: 10px 15px;
        background-color: #f8f9fa;
        font-family: 'Segoe UI', sans-serif;
    }

    .product-header .title {
        font-weight: bold;
        font-size: 16px;
        display: inline-block;
        color: #333;
    }

    .product-header .price {
        float: right;
        font-weight: bold;
        font-size: 15px;
        color: #28a745;
    }

    .overlayer {
        position: absolute;
        bottom: 55px;
        left: 0;
        width: 100%;
        height: 0;
        overflow: hidden;
        background: rgba(0, 0, 0, 0.8);
        color: #fff;
        padding: 0 15px;
        transition: height 0.3s ease;
        z-index: 1;
    }

    .gallery-item:hover .overlayer {
        height: 45%;
        padding-top: 10px;
        padding-bottom: 10px;
    }

    .item-info {
        font-size: 14px;
    }

    .thumbnail-wrapper {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-top: 8px;
    }

    .thumbnail-wrapper i {
        font-size: 20px;
        color: #f8f9fa;
        background-color: #6c757d;
        padding: 6px;
        border-radius: 50%;
    }

    .rating i {
        color: gold;
        font-size: 12px;
        margin-right: 1px;
    }

    .btn-plus {
        position: absolute;
        top: 8px;
        right: 8px;
        background-color: rgba(255, 255, 255, 0.9);
        border: none;
        padding: 6px 10px;
        border-radius: 6px;
        font-size: 18px;
        color: #333;
        cursor: pointer;
        z-index: 2;
    }

    .btn-plus:hover {
        background-color: #ddd;
    }
</style>

<div class="container my-5">
    <h2 class="text-center mb-5">Catálogo de Productos</h2>

    <div class="gallery-container">
        <?php foreach ($productos as $producto): ?>
            <div class="gallery-item">
                <!-- Imagen -->
                <?php if (!empty($producto['archivo'])): ?>
                    <img src="<?= base_url('uploads/' . $producto['archivo']) ?>" alt="<?= esc($producto['nombre']) ?>">
                <?php else: ?>
                    <img src="<?= base_url('uploads/default.png') ?>" alt="Sin imagen">
                <?php endif; ?>

                <!-- Botón flotante -->
                <button class="btn-plus">+</button>

                <!-- Nombre y precio visibles -->
                <div class="product-header">
                    <span class="title"><?= esc($producto['nombre']) ?></span>
                    <span class="price">$<?= number_format($producto['precio'], 2) ?></span>
                </div>

                <!-- Overlay visible solo en hover -->
                <div class="overlayer">
                    <div class="item-info">
                        <div class="thumbnail-wrapper">
                            <i class="fas fa-user"></i>
                            <div>
                                <div><?= esc($producto['unidad_medida']) ?> | <?= esc($producto['categoria']) ?></div>
                                <small><?= esc($producto['descripcion']) ?></small>
                            </div>
                        </div>

                        <div class="rating mt-2">
                            <i class="fa fa-star rated"></i>
                            <i class="fa fa-star rated"></i>
                            <i class="fa fa-star rated"></i>
                            <i class="fa fa-star rated"></i>
                            <i class="fa fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="text-center mt-5">
        <a href="<?= base_url(); ?>" class="btn btn-secondary">Regresar</a>
    </div>
</div>

<!-- Asegúrate de tener Font Awesome en tu layout para los íconos -->
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"> -->

<?= $this->endSection() ?>