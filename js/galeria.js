const proyectos = document.getElementsByClassName("centrar_contenedor");
const botones = document.getElementsByClassName("proyecto_barra");

function ocultarProyectos(){
    for(let i = 0; i < proyectos.length; i++){
        proyectos[i].classList.add("proyecto_oculto");
    }
}









for(let i = 0; i < proyectos.length; i++){
    botones[i].onclick = () => {
        ocultarProyectos();
        proyectos[i].classList.remove("proyecto_oculto");
    }
}