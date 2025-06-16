<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="page-container">
    <div class="page-content-wrapper">
        <div class="content">
            <div class="jumbotron" data-pages="parallax">
                <div class="container-fluid container-fixed-lg">
                    <div class="inner">
                        <div class="row">
                            <div class="col-xl-7 col-lg-6">
                                <div class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                                    <li class="breadcrumb-item active">Productos/Servicios</li>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12 col-lg-12">
                                <div class="card card-transparent">
                                    <div class="card-body">
                                        <h1>Catálogo de Productos o Servicios</h1>
                                        <p class="m-b-20">Administra los productos o servicios que ofrece la empresa.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid container-fixed-lg">
                <div class="card card-default">
                    <div class="card-header">
                        <div class="card-title">Listado</div>
                        <div class="tools">
                            <a href="<?= base_url('productos/' . $usuarioId . '/new') ?>" class="btn btn-success btn-sm">
                                <i class="fi fi-rr-box"></i> Agregar Producto/Servicio
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="get" class="mb-3">
                            <div class="input-group">
                                <input type="text" name="buscarProducto" class="form-control" placeholder="Buscar por nombre, categoría o estatus" value="<?= esc($buscarProducto ?? '') ?>">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="pg-icon">Buscar</i>
                                    </button>
                                </div>
                            </div>
                        </form>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Precio</th>
                                        <th>Unidad</th>
                                        <th>Categoría</th>
                                        <th>Estatus</th>
                                        <th>Archivo</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($productos)): ?>
                                        <tr>
                                            <td colspan="8" class="text-center">No hay productos registrados.</td>
                                        </tr>
                                    <?php else: ?>
                                        <?php foreach ($productos as $producto): ?>
                                            <tr>
                                                <td><?= esc($producto['nombre']) ?></td>
                                                <td><?= esc($producto['descripcion']) ?></td>
                                                <td>$<?= number_format($producto['precio'], 2) ?></td>
                                                <td><?= esc($producto['unidad_medida']) ?></td>
                                                <td><?= esc($producto['categoria']) ?></td>
                                                <td>
                                                    <span class="badge badge-<?= $producto['estatus'] === 'activo' ? 'success' : 'secondary' ?>">
                                                        <?= esc(ucfirst($producto['estatus'])) ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <?php if (!empty($producto['archivo'])): ?>
                                                        <a href="<?= base_url('uploads/' . $producto['archivo']) ?>" target="_blank">Ver</a>
                                                    <?php else: ?>
                                                        N/A
                                                    <?php endif ?>
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="<?= base_url('productos/edit/' . $producto['id']) ?>" class="btn btn-xs btn-primary">
                                                            <i class="pg-icon">Editar</i>
                                                        </a>
                                                        <a href="<?= base_url('productos/delete/' . $producto['id']) ?>" class="btn btn-xs btn-danger" onclick="return confirm('¿Eliminar este producto?')">
                                                            <i class="pg-icon">Eliminar</i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    <?php endif ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            <a href="<?= base_url(); ?>" class="btn btn-secondary">Regresar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>