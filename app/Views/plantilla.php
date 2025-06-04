<!DOCTYPE html>
<html lang="es" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trabajo CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="css/estilos.css" rel="stylesheet">

</head>

<body class="d-flex flex-column h-100 ">

    <!-- contenido -->
    <main class="flex-shrink-1"> <!--aqui se aplica el css -->
        <div class="container-fluid">
            <?php echo $this->renderSection('contenido'); ?> <!--define que se va a usar una vista para mostar el contenido -->
        </div>
    </main>

</body>

<footer class="container-fluid text-center p-2 fixed-bottom bg-dark text-light">
    <h6 class="small">copyrigth | 2025</h6>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>

<?php echo $this->renderSection('script'); ?>


</html>