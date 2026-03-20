const form_mensaje = document.getElementById("form_mensaje");
form_mensaje.preve

const nombre = document.getElementById("nombre");
const email = document.getElementById("email");
const asunto = document.getElementById("asunto");
const mensaje = document.getElementById("mensaje");

function validarFormulario(){
    let envio = true;
    if(nombre.value == ""){
        alert("El nombre esta vacio");
        envio = false;
    }

    if(email.value == ""){
        alert("El email esta vacio");
        envio = false;
    }

    if(asunto.value == ""){
        alert("El asunto esta vacio");
        envio = false;
    }

    if(mensaje.value == ""){
        alert("El mensaje esta vacio");
        envio = false;
    }

    if(!email.value.includes("@")){
        alert("El email no es valido");
        envio = false;
    }

    return envio;
}





form_mensaje.addEventListener("submit", async (e) => {
    e.preventDefault();

    if(!validarFormulario()){
        console.error("Hubo un error");
        return 1;
    }
    
    const datos_formulario = new FormData(form_mensaje);
    const datos = Object.fromEntries(datos_formulario);

    console.log(datos)

    try{
        const respuesta = await fetch("../php/enviar_mensaje.php", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(datos)
        })

        if(respuesta.ok){
            const resultado = await respuesta.json();
            console.log("Exito", resultado);
            alert("Mensaje enviado correctamente");
        }else{
            console.error("Error: ", respuesta.status);
        }
    } catch(error){
        console.error("Error en ", error)
    }
});