<?php echo $this->extend('plantilla'); ?>

<?php echo $this->Section('contenido'); ?>

<div class="container mt-4 mb-4">
    <div class="card shadow">
        <div class="card-body">
            <h2 class="card-title mb-4">Actualizar Datos del Usuario</h2>

            <form action="<?= base_url('usuarios/' . $usuario['id']); ?>" method="post">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="usuario_id" value="<?= $usuario['id'] ?>">

                <!-- Nombre -->
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" required value="<?= $usuario['nombre'] ?>">
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control" name="email" id="email" required value="<?= $usuario['email'] ?>">
                </div>

                <!-- Contraseña -->
                <div class="mb-3">
                    <label for="contraseña" class="form-label">Nueva Contraseña</label>
                    <input type="password" class="form-control" name="contraseña" id="contraseña" placeholder="Ingresa tu nueva contraseña">

                    <!-- Progreso de requisitos -->
                    <div class="progress mt-2" style="height: 10px;">
                        <div id="passwordProgress" class="progress-bar" role="progressbar" style="width: 0%;"></div>
                    </div>
                    <div id="passwordStrength" class="form-text mt-1 fw-semibold"></div>
                    <small class="form-text text-muted">
                        Deja este campo vacío si no deseas cambiar la contraseña.<br>
                        Debe tener al menos 8 caracteres, una mayúscula, un número y un carácter especial.
                    </small>
                </div>

                <!-- Confirmar contraseña -->
                <div class="mb-3">
                    <label for="confirmar" class="form-label">Confirmar Nueva Contraseña</label>
                    <input type="password" class="form-control" name="confirmar" id="confirmar" placeholder="Confirma tu nueva contraseña">
                </div>

                <!-- Fechas -->
                <div class="mb-3">
                    <label class="form-label">Fecha de creación:</label>
                    <input type="text" class="form-control" value="<?= date('d/m/Y H:i', strtotime($usuario['fecha_crea'])) ?>" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Última actualización:</label>
                    <input type="text" class="form-control" value="<?= date('d/m/Y H:i', strtotime($usuario['fecha_actu'])) ?>" readonly>
                </div>

                <!-- Botones -->
                <div class="d-flex justify-content-between mt-4">
                    <a href="<?= base_url('usuarios') ?>" class="btn btn-secondary">Regresar</a>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </form>

            <!-- Mensajes de error -->
            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger mt-4">
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <p><?= esc($error) ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <!-- Mensaje de éxito -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success mt-4">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Script para barra de fortaleza -->
<script>
    const passwordInput = document.getElementById('contraseña');
    const strengthText = document.getElementById('passwordStrength');
    const progressBar = document.getElementById('passwordProgress');

    passwordInput.addEventListener('input', function() {
        const value = passwordInput.value;
        let strength = 0;

        if (value.length >= 8) strength++;
        if (/[A-Z]/.test(value)) strength++;
        if (/[0-9]/.test(value)) strength++;
        if (/[\W_]/.test(value)) strength++;

        const percent = (strength / 4) * 100;
        progressBar.style.width = percent + '%';

        let color = 'bg-danger';
        let texto = 'Muy débil';

        if (strength === 2) {
            color = 'bg-warning';
            texto = 'Débil';
        } else if (strength === 3) {
            color = 'bg-info';
            texto = 'Aceptable';
        } else if (strength === 4) {
            color = 'bg-success';
            texto = 'Fuerte';
        }

        progressBar.className = `progress-bar ${color}`;
        strengthText.textContent = texto;
        strengthText.style.color = color === 'bg-danger' ? 'red' :
            color === 'bg-warning' ? 'orange' :
            color === 'bg-info' ? 'blue' : 'green';
    });
</script>

<?php $this->endSection(); ?>