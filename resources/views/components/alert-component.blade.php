@if (session('store'))
    <script>
        Swal.fire({
            title: 'Registro criado',
            text: '{{ session('store') }}',
            icon: 'success',
            timer: 5000,
            showConfirmButton: false,
            allowOutsideClick: true
        });
    </script>
@elseif (session('update'))
    <script>
        Swal.fire({
            title: 'Registro atualizado',
            text: '{{ session('update') }}',
            icon: 'info',
            timer: 5000,
            showConfirmButton: false,
            allowOutsideClick: true
        });
    </script>
@elseif (session('trash'))
    <script>
        Swal.fire({
            title: 'Registro enviado a lixeira',
            text: '{{ session('trash') }}',
            icon: 'warning',
            timer: 5000,
            showConfirmButton: false,
            allowOutsideClick: true
        });
    </script>
@elseif (session('restored'))
    <script>
        Swal.fire({
            title: 'Registro restaurado',
            text: '{{ session('restored') }}',
            icon: 'success',
            timer: 5000,
            showConfirmButton: false,
            allowOutsideClick: true
        });
    </script>
@elseif (session('destroy'))
    <script>
        Swal.fire({
            title: 'Registro excluído',
            text: '{{ session('destroy') }}',
            icon: 'success',
            timer: 5000,
            showConfirmButton: false,
            allowOutsideClick: true
        });
    </script>
@elseif (session('error'))
<script>
    Swal.fire({
        title: 'Erro',
        text: '{{ session('error') }}',
        icon: 'error',
        timer: 7000,
        showConfirmButton: false,
        allowOutsideClick: true
    });
</script>
@endif
