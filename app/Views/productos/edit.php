<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid container-fixed-lg">
    <h2>Editar Producto o Servicio</h2>
    <form action="<?= base_url('productos/update/' . $producto['id']) ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <input type="hidden" name="_method" value="PUT">

        <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control" value="<?= esc($producto['nombre']) ?>" required>
        </div>

        <div class="form-group">
            <label>Descripción</label>
            <textarea name="descripcion" class="form-control" required><?= esc($producto['descripcion']) ?></textarea>
        </div>

        <div class="form-group">
            <label>Precio</label>
            <input type="number" name="precio" step="0.01" class="form-control" value="<?= esc($producto['precio']) ?>" required>
        </div>

        <div class="form-group">
            <label>Unidad de Medida</label>
            <input type="text" name="unidad_medida" class="form-control" value="<?= esc($producto['unidad_medida']) ?>" required>
        </div>

        <div class="form-group">
            <label>Categoría</label>
            <input type="text" name="categoria" class="form-control" value="<?= esc($producto['categoria']) ?>" required>
        </div>

        <div class="form-group">
            <label>Estatus</label>
            <select name="estatus" class="form-control" required>
                <option value="activo" <?= $producto['estatus'] == 'activo' ? 'selected' : '' ?>>Activo</option>
                <option value="inactivo" <?= $producto['estatus'] == 'inactivo' ? 'selected' : '' ?>>Inactivo</option>
            </select>
        </div>

        <div class="form-group">
            <label>Imagen o Archivo (opcional)</label>
            <input type="file" name="archivo" class="form-control-file">
            <?php if (!empty($producto['archivo'])): ?>
                <p>Archivo actual: <a href="<?= base_url('uploads/' . $producto['archivo']) ?>" target="_blank">Ver</a></p>
            <?php endif ?>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="<?= base_url('productos/' . $producto['usuario_id']) ?>" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
<?= $this->endSection() ?>