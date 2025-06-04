<div class="modal fade" id="eliminaModal" tabindex="-1" aria-hidden="true"> <!--se enlaza el modal y boton de eliminar con el id -->
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eliminaModalLabel">Confirmar Eliminación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                ¿Estás seguro de que quieres eliminar este usuario?
            </div>

            <div class="modal-footer">
                <form id="deleteForm" method="post">
                    <input type="hidden" name="_method" value="DELETE"> <!-- es para simular el metodo delete, como en el metodo put -->
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- es el script de boostrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous">
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var deleteButtons = document.querySelectorAll('button[data-bs-toggle="modal"]'); //selecciona los botones con data-bs-toggle="modal"

    deleteButtons.forEach(function(button) { //itera sobre los botones encontrados
        button.addEventListener('click', function() {
            var url = button.getAttribute('data-bs-id');
            var form = document.getElementById('deleteForm');
            form.action = url;
      });
    });
  });

</script>