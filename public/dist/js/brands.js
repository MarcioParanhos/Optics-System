let activeBrand = document.getElementById("activeBrand");
activeBrand.classList.add("active");

document.addEventListener("DOMContentLoaded", function () {
    const session_message = document.getElementById("session_message");

    function showToast(icon, title) {
        const Toast = Swal.mixin({
            toast: true,
            position: "center",
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener("mouseenter", Swal.stopTimer);
                toast.addEventListener("mouseleave", Swal.resumeTimer);
            },
        });

        Toast.fire({
            icon: icon,
            title: title,
        });
    }

    if (session_message) {
        if (session_message.value === "deleted") {
            showToast("success", "Marca excluída com sucesso!");
        } else if (session_message.value === "success") {
            showToast("success", "Marca adicionada com sucesso!");
        } else if (session_message.value === "updated") {
            showToast("success", "Marca atualizada com sucesso!");
        } else if (session_message.value === "error") {
            showToast(
                "error",
                "Erro ao excluir a marca: há armações associadas a esta marca!"
            );
        }
    }
});

function update(id) {
    link = "/brands/update";
    // Fazer uma solicitação AJAX para buscar a marca selecionada
    fetch(`/brands/select/${id}`)
        .then((response) => response.json())
        .then((data) => {
            // Exibir a marca no modal
            let modal = new bootstrap.Modal(
                document.getElementById("update_modal_brand")
            );
            let modal_update_brand_name = document.getElementById(
                "modal_update_brand_name"
            );
            let brand_upate = document.getElementById("brand_upate");
            let update_release_date = document.getElementById(
                "update_release_date"
            );
            let update_additional_information = document.getElementById(
                "update_additional_information"
            );
            let update_brand_id = document.getElementById("update_brand_id");
            let situation_selected =
                document.getElementById("situation_selected");
            let promotion_selected =
                document.getElementById("promotion_selected");
            var createdAt = data.brand.created_at.split("T")[0];
            modal_update_brand_name.innerHTML = ` ${data.brand.name}`;
            brand_upate.value = ` ${data.brand.name}`;
            update_brand_id.value = data.brand.id;
            update_additional_information.innerHTML = data.brand.description;
            update_release_date.value = createdAt;
            if (data.brand.situation_id == 1) {
                situation_selected.innerHTML = "ATIVO";
                situation_selected.value = data.brand.situation_id;
            } else {
                situation_selected.innerHTML = "INATIVO";
                situation_selected.value = data.brand.situation_id;
            }
            // if (data.brand.promotion == 0) {
            //     promotion_selected.innerHTML = "SIM"
            //     promotion_selected.value = data.brand.situation_id;
            // } else {
            //     promotion_selected.innerHTML = "NÃO"
            //     promotion_selected.value = data.brand.situation_id;
            // }

            // Obtem todos os elementos de radio buttons com o name "category"
            let radioButtons = document.getElementsByName("category");
            // Percorre os elementos de radio buttons
            for (let i = 0; i < radioButtons.length; i++) {
                // Verifica se o valor do radio button corresponde à categoria da marca
                if (radioButtons[i].value === data.brand.category) {
                    // Define o atributo "checked" no radio button correspondente
                    radioButtons[i].checked = true;
                    break; // Sai do loop, pois já encontramos a correspondência
                }
            }
            modal.show();
            // Define o atributo "action" do formulário com o link desejado
            let updateForm = document.getElementById("update_form");
            updateForm.action = link;
        })
        .catch((error) => {
            console.error("Erro ao buscar a marca: " + error);
        });
}

// Destroy Function
function destroy(id) {
    let link = "/brands/destroy/" + id; // Cria o link dinamicamente
    let modal = new bootstrap.Modal(document.getElementById("delete_modal"));
    let deleteButton = document.querySelector("#delete_modal a.btn-danger"); // Seleciona o botão dentro do modal
    deleteButton.href = link; // Define o atributo href do botão com o link dinâmico
    modal.show();
}
