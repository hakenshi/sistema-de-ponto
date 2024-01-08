function alterarStatus(idFuncionario, status){ 
        $.ajax({
            type: "post",
            url: "app/classes/Admin.php",
            data:{
                idFuncionario: idFuncionario,
                status: status
            },
            dataType: "json",
            success: function (response) {
                if(response.code == 200)
                alert(response.mensagem)
                location.reload()
            },
            error: (xhr, status, error)=>{
                console.error(`Erro na requisição AJAX: ${status} Tipo do erro: ${error}`)
            }
        });
    }
    

$(()=>{
    const cadastrarFuncionario = $("#cadastrar-funcionario")

    const editarFuncionario = $("#editar-funcionario")

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
                    location.replace('/sistema-de-ponto/list_data_page.php')
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
    editarFuncionario.on("submit", e =>{
        e.preventDefault()
        $.ajax({
            type: "post",
            url: "app/classes/Admin.php",
            data: {
                id_funcionario: $("#id").val(),
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
                    console.log(response)
                    location.replace('/sistema-de-ponto/list_data_page.php')
                }
                
            },
            error: (xhr, status, error)=>{
                console.error(`Erro na requisição AJAX: ${status} Tipo do erro: ${error}`)
            }
        })
    })
})