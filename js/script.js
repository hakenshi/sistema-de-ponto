const horaAtual = document.querySelector("#hora-atual")

// baterPonto.addEventListener('click',()=>{
//     const hora = new Date().toLocaleTimeString('pt-br',{timeStyle: "medium"})
//     const data = new Date().toLocaleDateString('pt-br',{dateStyle: "short"})
//     ultimaMarcacao.textContent = `${data} às ${hora}`
// })

function atualizaRelogio(){
    const data = new Date().toLocaleTimeString('pt-br',{timeStyle:"short"})
    horaAtual.textContent = data
}

atualizaRelogio()
setInterval(atualizaRelogio, 1000)





