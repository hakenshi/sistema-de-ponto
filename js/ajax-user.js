const editarUsuario = $("#editUser")

// const profileImage = document.querySelector("#profile-file")
// const image = document.querySelector("#profile-image")

// profileImage.onchange = e => {
//     const [file] = profileImage.files

//     if (file) {
//         image.src = URL.createObjectURL(file)
//     }
// }



editarUsuario.on("submit", e => {
    e.preventDefault();

    try {
        const username = $("#username").val();
        const birthDate = $("#birth-date").val();
        const email = $("#email").val();
        const password = $("#password").val();
        const confirmPassword = $("#password-confirm").val();

        if (password !== confirmPassword) {
            alert("As senhas não coincidem");
            return;
        }

        $.ajax({
            type: "POST",
            url: "app/classes/ajax-handlers/User/editarUsuario.php",
            data: {
                username: username,
                email: email,
                birthDate: birthDate,
                password: password
            },
            dataType: "json",
            success: function(response) {
                if (response.status === 200) {
                    alert(response.mensagem);
                    location.replace("user_page.php");
                } else {
                    alert(response.mensagem);
                }
            },
            error: function(xhr, status, error) {
                alert(`status: ${status}\nerror: ${error}\nxhr: ${xhr}`);
            }
        });

    } catch (error) {
        alert(`Erro ao enviar o formulário: ${error}`);
    }
});
