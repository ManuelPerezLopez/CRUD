<?php echo $this->extend('plantilla'); ?>

<?php echo $this->section('contenido'); ?>

<div class="container">
    <h2 class="mb-4 mt-4">Tabla de Usuarios</h2>

    <!-- Mensajes -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <!-- Botón nuevo usuario -->
    <div class="mb-3 d-flex justify-content-end">
        <a href="<?= base_url('usuarios/new'); ?>" class="btn btn-success">Nuevo Usuario</a>
    </div>

    <!-- FORMULARIO DE BÚSQUEDA -->
    <form class="mb-4" method="get" action="<?= base_url('usuarios') ?>">
        <div class="input-group">
            <input type="text" name="buscar" class="form-control" placeholder="Buscar por nombre o email..." value="<?= esc($buscar ?? '') ?>">
            <button class="btn btn-outline-primary" type="submit">Buscar</button>
        </div>
    </form>

    <!-- TABLA DE USUARIOS -->
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Fecha de Creación</th>
                    <th>Última Actualización</th>
                    <th class="text-center">Opciones</th>
                    <th>Clientes</th>
                    <th>Productos</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario) : ?>
                    <tr>
                        <td><?= esc($usuario['nombre']); ?></td>
                        <td><?= esc($usuario['email']); ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($usuario['fecha_crea'])) ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($usuario['fecha_actu'])) ?></td>
                        <td class="text-center">
                            <a href="<?= base_url('usuarios/' . $usuario['id'] . '/edit') ?>" class="btn btn-sm btn-primary">Editar</a>
                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#eliminaModal" data-bs-id="<?= base_url('usuarios/' . $usuario['id']) ?>">Eliminar</button>
                        </td>
                        <td>
                            <a href="<?= base_url('clientes/index/' . $usuario['id']) ?>" class="btn btn-sm btn-info">Clientes</a>
                        </td>
                        <td>
                            <a href="<?= base_url('productos/' . $usuario['id']) ?>" class="btn btn-sm btn-warning">Productos</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- MODAL DE ELIMINACIÓN -->
    <?php echo $this->include('usuarios/delete'); ?>
</div>

<?php $this->endSection(); ?>
