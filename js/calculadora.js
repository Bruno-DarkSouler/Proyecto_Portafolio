const pantalla = document.getElementById('pantalla');

function agregar(valor) {
    pantalla.value += valor;
}

function limpiar() {
    pantalla.value = '';
}

function borrarUno() {
    pantalla.value = pantalla.value.slice(0, -1);
}

function calcular() {
    const expresion = pantalla.value;
    
    // Validamos que no esté vacío
    if (!expresion) return;

    try {
        // Usamos el constructor de Función como alternativa segura a eval
        // Esto crea una función que retorna el resultado de la operación matemática
        const resultado = Function(`'use strict'; return (${expresion})`)();
        
        // Verificamos si el resultado es un número válido
        if (isNaN(resultado) || !isFinite(resultado)) {
            throw new Error("Operación inválida");
        }
        
        pantalla.value = resultado;
    } catch (error) {
        pantalla.value = 'Error';
        setTimeout(limpiar, 1500);
    }
}