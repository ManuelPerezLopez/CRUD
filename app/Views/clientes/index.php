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
                                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                                    <li class="breadcrumb-item active">Clientes</li>
                                </div>
                            </div>
                        </div>
                        <!-- END BREADCRUMB -->
                        <div class="row">
                            <div class="col-xl-12 col-lg-12">
                                <div class="card card-transparent">
                                    <div class="card-body">
                                        <h1>Catálogo de Clientes del Usuario #<?= esc($usuarioId) ?></h1>
                                        <p class="m-b-20">Administra los clientes asociados a tu cuenta.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END JUMBOTRON -->

            <!-- START CONTAINER FLUID -->
            <div class="container-fluid container-fixed-lg">
                <!-- BEGIN PlACE PAGE CONTENT HERE -->
                <div class="card card-default">
                    <div class="card-header">
                        <div class="card-title">
                            Listado de Clientes
                        </div>
                        <div class="tools">
                            <a href="<?= base_url('clientes/new/' . $usuarioId) ?>" class="btn btn-success btn-sm">
                                <i class="fi fi-rr-user"></i> Agregar Cliente
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="get" class="mb-3">
                            <div class="input-group">
                                <input type="text" name="buscar" class="form-control" placeholder="Buscar por nombre, correo o estatus" value="<?= esc($buscar) ?>">
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
                                        <th>Correo</th>
                                        <th>Teléfono</th>
                                        <th>Estatus</th>
                                        <th>Creado</th>
                                        <th>Modificado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($clientes)): ?>
                                        <tr>
                                            <td colspan="7" class="text-center">No hay clientes registrados.</td>
                                        </tr>
                                    <?php else: ?>
                                        <?php foreach ($clientes as $cliente): ?>
                                            <tr>
                                                <td><?= esc($cliente['nombre']) ?></td>
                                                <td><?= esc($cliente['correo']) ?></td>
                                                <td><?= esc($cliente['telefono']) ?></td>
                                                <td>
                                                    <span class="badge badge-<?= $cliente['estatus'] === 'activo' ? 'success' : 'secondary' ?>">
                                                        <?= esc(ucfirst($cliente['estatus'])) ?>
                                                    </span>
                                                </td>
                                                <td><?= esc($cliente['created_at']) ?></td>
                                                <td><?= esc($cliente['updated_at']) ?></td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="<?= base_url('clientes/edit/' . $cliente['id']) ?>" class="btn btn-xs btn-primary">
                                                            <i class="pg-icon">Editar</i>
                                                        </a>
                                                        <a href="<?= base_url('clientes/delete/' . $cliente['id']) ?>" class="btn btn-xs btn-danger" onclick="return confirm('¿Eliminar este cliente?')">
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
                        <!-- BOTÓN DE REGRESO -->
                        <div class="mt-4">
                            <a href="<?= base_url(); ?>" class="btn btn-secondary">Regresar</a>
                        </div>

                    </div>
                </div>
                <!-- END PLACE PAGE CONTENT HERE -->
            </div>
            <!-- END CONTAINER FLUID -->
        </div>
    </div>
</div>
<?= $this->endSection() ?>