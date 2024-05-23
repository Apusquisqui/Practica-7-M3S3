document.addEventListener('DOMContentLoaded', function() {
    fetch('inicio.php')
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                console.error('Error fetching data:', data.error);
                document.getElementById('userName').textContent = 'Invitado';
                document.getElementById('userFullName').textContent = 'N/A';
                document.getElementById('userAge').textContent = 'N/A';
                document.getElementById('userEmail').textContent = 'No disponible';
            } else {
                document.getElementById('userName').textContent = data.user;
                document.getElementById('userFullName').textContent = data.nomr;
                document.getElementById('userAge').textContent = data.edad;
                document.getElementById('userEmail').textContent = data.email;
            }
        })
        .catch(error => console.error('Error en la petición AJAX:', error));
});


function confirmarEliminacion() {
    if (confirm('¿Estás seguro de que deseas eliminar tu cuenta? Esta acción no se puede deshacer.')) {
        fetch('borrarCuenta.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'eliminar=true'
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                alert('Cuenta eliminada con éxito.');
                window.location = 'In.html'; // Redirige al login o a la página de inicio
            } else {
                alert('Error al eliminar la cuenta.');
            }
        })
        .catch(error => console.error('Error:', error));
    }
}