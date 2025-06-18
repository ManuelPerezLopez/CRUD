<?= $this->extend('layouts/main') ?>

<?php if (session('errors')) : ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach (session('errors') as $error) : ?>
                <li><?= esc($error) ?></li>
            <?php endforeach ?>
        </ul>
    </div>
<?php endif; ?>

<?= $this->section('content') ?>
<div class="container-fluid container-fixed-lg">
    <h2>Agregar Producto o Servicio</h2>
    <form action="<?= base_url('productos/' . $usuarioId . '/store') ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control" value="<?= old('nombre') ?>" required>
        </div>

        <div class="form-group">
            <label>Descripción</label>
            <textarea name="descripcion" class="form-control" required><?= old('descripcion') ?></textarea>
        </div>

        <div class="form-group">
            <label>Precio</label>
            <input type="number" name="precio" step="0.01" class="form-control" value="<?= old('precio') ?>" required>
        </div>

        <div class="form-group">
            <label>Unidad de Medida</label>
            <input type="text" name="unidad_medida" class="form-control" value="<?= old('unidad_medida') ?>" required>
        </div>

        <div class="form-group">
            <label>Categoría</label>
            <input type="text" name="categoria" class="form-control" value="<?= old('categoria') ?>" required>
        </div>

        <div class="form-group">
            <label>Estatus</label>
            <select name="estatus" class="form-control" required>
                <option value="activo" <?= old('estatus') == 'activo' ? 'selected' : '' ?>>Activo</option>
                <option value="inactivo" <?= old('estatus') == 'inactivo' ? 'selected' : '' ?>>Inactivo</option>
            </select>
        </div>

        <div class="form-group">
            <label>Imagen o Archivo</label>
            <input type="file" name="archivo" class="form-control-file">
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="<?= base_url('productos/' . $usuarioId) ?>" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
<?= $this->endSection() ?>