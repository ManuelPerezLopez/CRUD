<!-- app/Views/auth/login.php -->
<?= $this->extend('plantilla') ?>

<?= $this->section('contenido') ?>

<div class="container mt-5">
    <h2>Iniciar Sesión</h2>
    <form action="<?= base_url('api/login') ?>" method="post">
        <div class="mb-3">
            <label for="email" class="form-label">Correo:</label>
            <input type="email" class="form-control" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña:</label>
            <input type="password" class="form-control" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Ingresar</button>
    </form>
</div>

<?= $this->endSection() ?>
