const horaAtual = document.querySelector("#hora-atual")
const nome = document.querySelector('#nome')

function bloqueiaNumeros(input){
    
}

function atualizaRelogio(){
    const data = new Date().toLocaleTimeString('pt-br',{timeStyle:"short"})
    horaAtual.textContent = data
}

bloqueiaNumeros(nome)
atualizaRelogio()
setInterval(atualizaRelogio, 1000)





