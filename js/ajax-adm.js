$(()=>{
    const cadastrarFuncionario = $("#cadastrar-funcionario")

    const status = $("#status")
    
    status.on("click", ()=>{
        $.ajax({
            type: "post",
            url: "app/classes/Admin.php",
            data:{
                status: $("#status-funcionario").val(),
                idFuncionario: $("#id-funcionario").val()
            },
            dataType: "json",
            success: function (response) {
                alert(response.mensagem)
                location.reload()
            }
        });
    })

    cadastrarFuncionario.on("submit", e =>{
        e.preventDefault()
        $.ajax({
            type: "post",
            url: "app/classes/Admin.php",
            data: {
                nome: $('#nome').val(),
                turno: $('#turno').val(),
                tipo_funcionario: $('#tipo_funcionario').val(),
                email: $('#email').val(),
                senha: $('#senha').val(),
                cpf: $('#cpf').val(),
                matricula: $('#matricula').val(),
                cargo: $('#cargo').val(),
                data_nascimento: $('#data_nascimento').val(),
            },
            dataType: "json",
            success: function (response) {
                if(response.code === 200){
                    alert(response.mensagem)
                    location.replace('/list_data_page.php')
                }
                else{
                    alert("Erro ao cadastrar funcionário")
                }
            },
            error: (xhr, status, error)=>{
                console.error(`Erro na requisição AJAX: ${status} Tipo do erro: ${error}`)
            }
        })
    })
})