let activeBrand = document.getElementById("activeBrand")
activeBrand.classList.add('active')

document.addEventListener("DOMContentLoaded", function() {
    const session_message = document.getElementById("session_message");

    function showToast(icon, title) {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3500,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: icon,
            title: title
        })
    }

    if (session_message) {
        if (session_message.value === "deleted") {
            showToast('success', 'Marca excluída com sucesso!');
        } else if (session_message.value === "success") {
            showToast('success', 'Marca adicionada com sucesso!');
        } else if (session_message.value === "updated") {
            showToast('success', 'Marca atualizada com sucesso!');
        }
    }

});