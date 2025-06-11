<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="page-container">
    <div class="page-content-wrapper">
        <div class="content">
            <!-- START JUMBOTRON -->
            <div class="jumbotron" data-pages="parallax">
                <div class="container-fluid container-fixed-lg">
                    <div class="inner">
                        <!-- START BREADCRUMB -->
                        <div class="row">
                            <div class="col-xl-7 col-lg-6">
                                <div class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Inicio</a></li>
                                    <li class="breadcrumb-item"><a href="<?= base_url('clientes/index/' . $cliente['usuario_id']) ?>">Clientes</a></li>
                                    <li class="breadcrumb-item active">Editar Cliente</li>
                                </div>
                            </div>
                        </div>
                        <!-- END BREADCRUMB -->

                        <div class="row">
                            <div class="col-xl-12 col-lg-12">
                                <div class="card card-transparent">
                                    <div class="card-body">
                                        <h1>Editar Cliente</h1>
                                        <p class="m-b-20">Modifica los datos del cliente asociado a tu cuenta.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- END JUMBOTRON -->

            <!-- START CONTAINER -->
            <div class="container-fluid container-fixed-lg">
                <div class="card card-default">
                    <div class="card-header">
                        <div class="card-title">Formulario de Edición</div>
                    </div>
                    <div class="card-body">
                        <?php if (session('error')): ?>
                            <div class="alert alert-danger"><?= session('error') ?></div>
                        <?php endif; ?>

                        <form method="post" action="<?= base_url('clientes/update/' . $cliente['id']) ?>">
                            <input type="hidden" name="usuario_id" value="<?= esc($cliente['usuario_id']) ?>">

                            <div class="form-group">
                                <label>Nombre</label>
                                <input type="text" name="nombre" class="form-control" value="<?= esc($cliente['nombre']) ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Correo</label>
                                <input type="email" name="correo" class="form-control" value="<?= esc($cliente['correo']) ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Teléfono</label>
                                <input type="text" name="telefono" class="form-control" value="<?= esc($cliente['telefono']) ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Estatus</label>
                                <select name="estatus" id="estatusSelect" class="form-control">
                                    <option value="activo" <?= $cliente['estatus'] === 'activo' ? 'selected' : '' ?>>Activo</option>
                                    <option value="inactivo" <?= $cliente['estatus'] === 'inactivo' ? 'selected' : '' ?>>Inactivo</option>
                                </select>
                            </div>

                            <style>
                                .activo {
                                    background-color: #d4edda;
                                    /* verde claro */
                                    color: #155724;
                                    /* verde oscuro */
                                }

                                .inactivo {
                                    background-color: #f8d7da;
                                    /* rojo claro */
                                    color: #721c24;
                                    /* rojo oscuro */
                                }
                            </style>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary">Actualizar</button>
                                <a href="<?= base_url('clientes/index/' . $cliente['usuario_id']) ?>" class="btn btn-secondary">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- END CONTAINER -->
        </div>
    </div>
</div>
<script>
    const estatusSelect = document.getElementById('estatusSelect');

    function actualizarColor() {
        if (estatusSelect.value === 'activo') {
            estatusSelect.classList.add('activo');
            estatusSelect.classList.remove('inactivo');
        } else if (estatusSelect.value === 'inactivo') {
            estatusSelect.classList.add('inactivo');
            estatusSelect.classList.remove('activo');
        }
    }

    // Ejecutar al cargar la página para el valor seleccionado inicialmente
    actualizarColor();

    // Cambiar color cuando el usuario cambie la opción
    estatusSelect.addEventListener('change', actualizarColor);
</script>
<?= $this->endSection() ?>