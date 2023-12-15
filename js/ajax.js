$(function () {

    exibeMarcacao()
    
    const baterPonto = $("#bater-ponto")
    const ultimaMarcacao = $("#ultima-marcacao")
    const result = $("#result")
    baterPonto.on('click', () => {
        const idFuncionario = $("#id-funcionario").val()
        
        $.ajax({
            type: "POST",
            url: "app/classes/User.php",
            data: {
                id_funcionario: idFuncionario
            },
            dataType: 'json',
            success: (response) => {
                ultimaMarcacao.html(`${response.data} `)

                if(response.code === 200){
                result.addClass("alert alert-success")
                result.html(`${response.mensagem}`)
                result.fadeOut(7000,()=>{
                result.remove()
                });
                
            }
            else{
                result.addClass("alert alert-danger")
                result.html(response.mensagem)
                result.fadeOut(7000,()=>{
                result.remove()
                });
            }
            },
            error: (jqXHR, textStauts, errorTrown) => {
                
                console.log(`Erro na requisição jquery: ${textStauts} \nTipo do erro: ${errorTrown}`)

            }
        });

    })

    function exibeMarcacao() {

        const idFuncionario = $("#id-funcionario").val()

        $.ajax({
            type: "GET",
            url: "app/classes/User.php",
            data: {
                ultima_marcacao: idFuncionario
            },
            success: (response) => {
                
                const jsonData = response
                const maxEntrada = JSON.parse(jsonData)

                if(maxEntrada === null){
                    ultimaMarcacao.html("Nenhum Ponto Batido Recentemente")
                }
                else{
                    const formatDate = new Intl.DateTimeFormat('pt-BR',{
                        dateStyle: "short",
                        timeStyle: "short"
                    }).format(new Date(maxEntrada))
                    
                    ultimaMarcacao.html(formatDate.replace(",", ' '))
                }
           },
            error: (jqXHR, textStauts, errorTrown) => {
                console.log(`Erro na requisição ajax: ${textStauts}\nTipo de erro: ${errorTrown}`)
            }
        });

    }
    


   
    
})




