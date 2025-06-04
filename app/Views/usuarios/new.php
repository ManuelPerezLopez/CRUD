<?php echo $this->extend('plantilla'); ?>

<?php echo $this->Section('contenido'); ?>

<div class="container mt-4 mb-4">
    <div class="card shadow">
        <div class="card-body">
            <h2 class="card-title mb-4">Registro de Usuario</h2>

            <form action="<?= base_url('usuarios'); ?>" method="post">
                <!-- Nombre -->
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingresa tu nombre" required>
                    <div class="invalid-feedback">El nombre debe tener al menos 3 caracteres.</div>

                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Ingresa tu correo electrónico" required>
                    <div class="invalid-feedback">Introduce un correo electrónico válido.</div>

                </div>

                <!-- Contraseña -->
                <div class="mb-3">
                    <label for="contraseña" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" name="contraseña" id="contraseña" placeholder="Ingresa tu contraseña" required>

                    <!-- Barra de progreso -->
                    <div class="progress mt-2" style="height: 10px;">
                        <div id="passwordProgress" class="progress-bar" role="progressbar" style="width: 0%;"></div>
                    </div>
                    <div id="passwordStrength" class="form-text mt-1 fw-semibold"></div>

                    <small class="form-text text-muted">
                        La contraseña debe tener al menos 8 caracteres, una mayúscula, un número y un carácter especial.
                    </small>

                    <!-- Ejemplos válidos -->
                    <div class="alert alert-secondary mt-2 p-2">
                        <strong>Ejemplos válidos:</strong>
                        <ul class="mb-0 small" id="passwordExamples"></ul>
                    </div>
                </div>

                <!-- Confirmar contraseña -->
                <div class="mb-3">
                    <label for="confirmar" class="form-label">Confirmar Contraseña</label>
                    <input type="password" class="form-control" name="confirmar" id="confirmar" placeholder="Confirma tu contraseña" required>
                </div>

                <!-- Botones -->
                <div class="d-flex justify-content-between mt-4">
                    <a href="<?= base_url('usuarios') ?>" class="btn btn-secondary">Regresar</a>
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </div>
            </form>

            <!-- Mensajes -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success mt-4">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger mt-4">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Scripts -->
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

        let color = 'bg-danger',
            texto = 'Muy débil';
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
        strengthText.style.color = color === 'bg-danger' ? 'red' : (color === 'bg-warning' ? 'orange' : (color === 'bg-info' ? 'blue' : 'green'));
    });

    // Generador de contraseñas válidas
    function generarContraseña() {
        const mayus = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        const minus = "abcdefghijklmnopqrstuvwxyz";
        const nums = "0123456789";
        const especiales = "!@#$%^&*()_+-=[]{};:,.<>?";
        const todo = mayus + minus + nums + especiales;

        let pass = "";
        pass += mayus[Math.floor(Math.random() * mayus.length)];
        pass += minus[Math.floor(Math.random() * minus.length)];
        pass += nums[Math.floor(Math.random() * nums.length)];
        pass += especiales[Math.floor(Math.random() * especiales.length)];

        for (let i = 0; i < 8; i++) {
            pass += todo[Math.floor(Math.random() * todo.length)];
        }

        return pass;
    }

    // Mostrar ejemplos
    const lista = document.getElementById('passwordExamples');
    for (let i = 0; i < 3; i++) {
        const ejemplo = generarContraseña();
        const item = document.createElement('li');
        item.innerHTML = `<code>${ejemplo}</code>`;
        lista.appendChild(item);
    }
</script>

<script>
    // Validación en tiempo real para nombre
    const nombreInput = document.getElementById('nombre');
    nombreInput.addEventListener('input', () => {
        const nombre = nombreInput.value.trim();
        if (nombre.length < 3) {
            nombreInput.classList.add('is-invalid');
            nombreInput.classList.remove('is-valid');
        } else {
            nombreInput.classList.remove('is-invalid');
            nombreInput.classList.add('is-valid');
        }
    });

    // Validación en tiempo real para email
    const emailInput = document.getElementById('email');
    emailInput.addEventListener('input', () => {
        const email = emailInput.value.trim();
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            emailInput.classList.add('is-invalid');
            emailInput.classList.remove('is-valid');
        } else {
            emailInput.classList.remove('is-invalid');
            emailInput.classList.add('is-valid');
        }
    });
</script>

<!-- Agregado por Manuel para probar GIT :v-->


<?php $this->endSection(); ?>