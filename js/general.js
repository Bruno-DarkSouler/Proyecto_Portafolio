const boton_cerrar = document.getElementById("boton_cerrar");
const filtro_negro = document.getElementById("filtro_negro");
const menu_desplegable = document.getElementById("menu_desplegable");
const cuerpo_menu = document.getElementById("cuerpo_menu")

function alternarMenu(){
    filtro_negro.classList.toggle("ausente");
    cuerpo_menu.classList.toggle("cerrado");
}

boton_cerrar.onclick = alternarMenu;
filtro_negro.onclick = alternarMenu;
menu_desplegable.onclick = alternarMenu;