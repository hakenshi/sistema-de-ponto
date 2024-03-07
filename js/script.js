const horaAtual = document.querySelector("#hora-atual")
const nome = document.querySelector('#nome')

function atualizaRelogio(){
    const data = new Date().toLocaleTimeString('pt-br',{timeStyle:"short"})
    horaAtual.textContent = data
}


atualizaRelogio()
setInterval(atualizaRelogio, 1000)





