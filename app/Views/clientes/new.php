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
                                    <li class="breadcrumb-item"><a href="<?= base_url('clientes/index/' . $usuarioId) ?>">Clientes</a></li>
                                    <li class="breadcrumb-item active">Agregar Cliente</li>
                                </div>
                            </div>
                        </div>
                        <!-- END BREADCRUMB -->

                        <div class="row">
                            <div class="col-xl-12 col-lg-12">
                                <div class="card card-transparent">
                                    <div class="card-body">
                                        <h1>Agregar un nuevo Cliente</h1>
                                        <p class="m-b-20">Llena el formulario para registrar un nuevo cliente asociado a tu cuenta.</p>
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
                        <div class="card-title">Formulario de Cliente</div>
                    </div>
                    <div class="card-body">
                        <?php if (session('error')): ?>
                            <div class="alert alert-danger"><?= session('error') ?></div>
                        <?php endif; ?>

                        <form method="post" action="<?= base_url('clientes/create/' . $usuarioId) ?>">
                            <div class="form-group">
                                <label>Nombre</label>
                                <input type="text" name="nombre" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Correo</label>
                                <input type="email" name="correo" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Teléfono</label>
                                <input type="text" name="telefono" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Estatus</label>
                                <select name="estatus" class="form-control">
                                    <option value="activo">Activo</option>
                                    <option value="inactivo">Inactivo</option>
                                </select>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                                <a href="<?= base_url('clientes/index/' . $usuarioId) ?>" class="btn btn-secondary">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- END CONTAINER -->
        </div>
    </div>
</div>
<?= $this->endSection() ?>
