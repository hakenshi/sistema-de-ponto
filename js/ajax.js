const getLocation = ()=>{
    return new Promise((resolve,reject)=>{
        navigator.geolocation.watchPosition((position)=>{
            const latitude = position.coords.latitude
            const longitude = position.coords.longitude
            const userCoords = {latitude, longitude}
            resolve(userCoords)
        },
        (error)=>{
            reject("Erro ao obter localização do usuário",error.message)
        }
        )
    })
}

const ocultarBotao = e =>{
    if(e){
        $("#espera").show()
        $("#bater-ponto").hide()
    }
    else{
        $("#espera").hide()
        $("#bater-ponto").show()
    }
}

$(function () {

    exibeMarcacao()
    
   
    const baterPonto = $("#bater-ponto")
    const ultimaMarcacao = $("#ultima-marcacao")
    const result = $("#result")



    baterPonto.on('click', () => {
        ocultarBotao(true)
        getLocation()
        .then((location)=>{
        $.ajax({
            type: "POST",
            url: "app/classes/User.php",
            data: {
                id_funcionario: $("#id-funcionario").val(),
                latitude: location.latitude,
                longitude: location.longitude
            },
            dataType: 'json',
            success: (response) => {
                ocultarBotao(false)
                if(response.code == 401){
                    alert("Funcionário inativado do sistema, não foi possível bater ponto")
                    return
                }
                else{
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
            }}
            },
            error: (jqXHR, textStauts, errorTrown) => {
                ocultarBotao(false)
                console.log(`Erro na requisição jquery: ${textStauts} \nTipo do erro: ${errorTrown}`)

            }
        });
    })
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




