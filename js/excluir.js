function popUpExc(id){
    fundExc = document.querySelector(".fundExc")
    fundExc.style.display="flex"
    const cancelar = document.querySelector(".cancelar")
    cancelar.addEventListener("click", function(){
        closePopup()
    })
    const excluir = document.querySelector(".excluir")
    excluir.addEventListener("click", function(){
        const link = `autorExcluir.php?id=${id}`
        window.location = link
    }) 
}

function closePopup(){
    fundExc.style.display="none"
}