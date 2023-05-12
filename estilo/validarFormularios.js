/**
 * @author Alejandro Jesús Rodríguez Fenoy
 */
function validarNombreUsuario(nombreUsuario){

    var formato = /^[a-zA-Z0-9_-]{4,15}$/;
    nombreUsuario = nombreUsuario.replace(/\+/g, '\+');
    
    mostrarValidacion('#usuario',formato.test(nombreUsuario));
}

function validarNombre(nombre){

    var formato = /^[a-zA-Z áéíóúüÁÉÍÓÜÚ]{3,15}$/;
    nombre = nombre.replace(/\+/g, '\+');
    
    mostrarValidacion('#nombre',formato.test(nombre)|| nombre=='');
}

function validarApellidos(apellidos){

    var formato = /^[a-zA-Z áéíóúüÁÉÍÓÜÚ]{4,15}$/;
    apellidos = apellidos.replace(/\+/g, '\+');
    
    mostrarValidacion('#apellidos',formato.test(apellidos) || apellidos=='');
}

function validarPassword(pass){
    pass = pass.replace(/\+/g, '\+');
    
    mostrarValidacion('#password',pass.length>=4);
}

function validarPasswordIguales(password,passwordRepetida){
    password = password.replace(/\+/g, '\+');
    passwordRepetida = passwordRepetida.replace(/\+/g, '\+');
    
    mostrarValidacion('#password2',password.length>=4 && password==passwordRepetida);
}

function validarCodMaterial(codMaterial){

    var formato = /^[0-9]{1,20}$/;
    codMaterial = codMaterial.replace(/\+/g, '\+');
    
    mostrarValidacion('#codMaterial',formato.test(codMaterial));
}

function validarDescripcion(descripcion){
    descripcion = descripcion.replace(/\+/g, '\+');
    
    mostrarValidacion('#descripcion',descripcion.length>=1 && descripcion.length <=250);
}

function validarUnidades(unidades){
    var formato = /^[0-9]{1,1000}$/;
    unidades = unidades.replace(/\+/g, '\+');
    
    mostrarValidacion('#unidades',formato.test(unidades));}


function validarUbicacion(ubicacion){
    if ($_POST['nombreMaterial'][0]){
    mostrarValidacion('#ubicacion',ubicacion ='Estantería');
}
}
/**
 * Cambia el estilo del input para indicar si es valido o no
 * 
 * @param nombreCampo Nombre del campo
 * @param valido boolean
 */
function mostrarValidacion(nombreCampo,valido){
    if (valido){
        $(document).ready(function(){
            $(nombreCampo).css('border','1px solid #7ca22c');
            $(nombreCampo).css('box-shadow','0 0 2px 1px #7ca22c');
        });
    }
    else{
        $(document).ready(function(){
            $(nombreCampo).css('border','1px solid red');
            $(nombreCampo).css('box-shadow','0 0 2px 1px red');
        }); 
    }
}