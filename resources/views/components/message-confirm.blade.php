<script>
    $(function () {
        $("form").on("submit", function (evento) {
            evento.preventDefault();
            Swal.fire({
                title: "¿Estás seguro?",
                text: "{{ $text }}",
                icon: "warning",
                showCancelButton: true,
                cancelButtonColor: "#dc3545",
                confirmButtonColor: "#007bff",
                cancelButtonText: "No,Cancelar",
                confirmButtonText: "Si,Eliminar",
            }).then((result) => {
                if (result.value) {
                    this.submit();
                }
            });
        });
    });
</script>