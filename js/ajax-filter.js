const dateFormat = (dateString) => {
    const date = new Date(dateString)
    const f = new Intl.DateTimeFormat('pt-br', {
        dateStyle: "short",
        timeStyle: "medium"
    })
    return f.format(date)
}

function renderizaTabela(data) {
    if (data.length > 0) {
        $("#listar-usuarios tbody").empty();
        data.forEach(ponto => {
            let row = `
                    <tr>
                    <td class="text-center"> ${ponto.nome}
                    <td class="text-center"> ${dateFormat(ponto.ponto).replace(',', ' ')}
                    <td class="text-center"> ${ponto.ponto_tipo}
                    <td class="text-center"> ${ponto.latitude}, ${ponto.longitude}
                    `
            $("#listar-usuarios tbody").append(row);
        });

    }
}

$(function () {
    const filtrarUsuarios = $("#filtrar")

    filtrarUsuarios.on("click", () => {
        // const nome = $("#nome").val()
        // const dataInicial = $("#data-inicial").val()
        // const dataFinal = $("#data-final").val()
        // const ordem = $("#desc").is(":checked") ? 1 : 0
        // const idFuncionario = $("#id-funcionario").val()

        // console.log("Nome:", nome);
        // console.log("Data Inicial:", dataInicial);
        // console.log("Data Final:", dataFinal);
        // console.log("Ordem:", ordem);
        // console.log("ID Funcionário:", idFuncionario);

        $.ajax({
            type: "post",
            url: "app/classes/Admin.php",
            data: {
                nome: $("#nome").val(),
                dataInicial: $("#data-inicial").val(),
                dataFinal: $("#data-final").val(),
                ordem: $("#desc").is(":checked") ? 1 : 0,
                idFuncionario: $("#id-funcionario").val()
            },
            dataType: "json",
            success: function (response) {
                if (response.code === 200) {
                    response.data === false ? alert("Nenhum dado foi encontrado ") : renderizaTabela(response.data)
                }
            },
            error: (xhr, status, error) => {
                console.error(`Erro na requisição AJAX: ${status} Tipo do erro: ${error.message}`)
                console.error(xhr.responseText);
            },
        });
    })
    $("#reset").on('click', () => {
        location.reload()
    })
});