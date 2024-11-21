
function frmLogin(event) {
    event.preventDefault();

    const usuario = document.getElementById('usuario');
    const password = document.getElementById('password');

    const formData = new FormData();
    formData.append('usuario', usuario.value);
    formData.append('password', password.value);

    fetch(`${base_url}Login/acceder`, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {

            window.location.href = base_url + 'Inicio/index';
        } else {
            document.querySelector('.modal-body').innerText = data.msg; 
            const errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
            errorModal.show();
        }
    })
    .catch(error => console.error('Error:', error));
}
document.getElementById('errorModal').addEventListener('hidden.bs.modal', () => {
    document.getElementById('usuario').value = '';
    document.getElementById('password').value = '';
});
