
// FUNCIONES GENERALES DE AJAX

function nuevoAjax() {
	/*
	 * Crea el objeto AJAX. Esta funcion es generica para cualquier utilidad de
	 * este tipo, por lo que se puede copiar tal como esta aqui
	 */
	var xmlhttp = false;
	try {
		// Creacion del objeto AJAX para navegadores no IE
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
		try {
			// Creacion del objet AJAX para IE
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (E) {
			xmlhttp = false;
		}
	}
	if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
		xmlhttp = new XMLHttpRequest();
	}

	return xmlhttp;
}


			
function gestionaCiclo(accion,codigo, codigo_nuevo, cod_ciclo_maestro, nombre, familia_profesional, centro, modalidad, activo) {
    // Obtendo la capa donde se muestran las respuestas del servidor
    var capa = document.getElementById("notificacion");
    // Creo el objeto AJAX
    var ajax = nuevoAjax();
	
    // Abro la conexión y envío los datos
    ajax.open("POST", "gestionaCiclo.php", true);
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("accion="+accion+"&codigo=" + codigo +"&codigo_nuevo=" + codigo_nuevo +"&cod_ciclo_maestro=" + cod_ciclo_maestro + "&nombre=" + nombre 
	+"&familia_profesional=" + familia_profesional +"&centro=" + centro
	+ "&modalidad=" + modalidad +"&activo="+activo);

    ajax.onreadystatechange = function() {
		if (ajax.readyState == 4) {
			if(accion=='duplicar'){
				window.location.reload();
			}
			else{
				if(accion=='eliminar'){
					window.location.reload();				
				}else{
					// Respuesta recibida. Coloco el texto plano en la capa correspondiente
					capa.innerHTML = ajax.responseText;
					if (ajax.responseText != "") {
						location.href = "verCiclos.php";
					}
				}
			}
		}
    }

}
   
function gestionaEmpresaAcuerdo(accion,id, alumno, cod_ciclo, curso,id_empresa) {
    // Obtendo la capa donde se muestran las respuestas del servidor
    var capa = document.getElementById("notificacion");
    // Creo el objeto AJAX
    var ajax = nuevoAjax();
	
    // Abro la conexión y envío los datos
    ajax.open("POST", "gestionaEmpresaAcuerdo.php", true);
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("accion="+accion+"&id=" + id + "&alumno=" + alumno + "&cod_ciclo=" + cod_ciclo+"&curso="+curso+"&id_empresa="+id_empresa);

    ajax.onreadystatechange = function() {
		if (ajax.readyState == 4) {
			if(accion=='eliminar'){
				window.location.reload();
			}
			else{
				// Respuesta recibida. Coloco el texto plano en la capa correspondiente
				capa.innerHTML = ajax.responseText;
				if (ajax.responseText != "") {
					location.href = "verEmpresa.php?id="+id_empresa;
				}
			}
		}
    }
}

function gestionaEmpresaPersona(accion,id, nombre, telefono, email,observaciones,id_empresa) {
    // Obtendo la capa donde se muestran las respuestas del servidor
    var capa = document.getElementById("notificacion");
    // Creo el objeto AJAX
    var ajax = nuevoAjax();
	
    // Abro la conexión y envío los datos
    ajax.open("POST", "gestionaEmpresaPersona.php", true);
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("accion="+accion+"&id=" + id + "&nombre=" + nombre + "&telefono=" + telefono+"&email="+email+"&observaciones="+observaciones+"&id_empresa="+id_empresa);

    ajax.onreadystatechange = function() {
		if (ajax.readyState == 4) {
			if(accion=='eliminar'){
				window.location.reload();
			}
			else{
				// Respuesta recibida. Coloco el texto plano en la capa correspondiente
				capa.innerHTML = ajax.responseText;
				if (ajax.responseText != "") {
					location.href = "verEmpresa.php?id="+id_empresa;
				}
			}
		}
    }
}



function gestionaModulo(accion,cod_ciclo, cod_modulo, nombre, descripcion,cod_programacion,cod_materiales) {
    // Obtendo la capa donde se muestran las respuestas del servidor
    var capa = document.getElementById("notificacion");
    // Creo el objeto AJAX
    var ajax = nuevoAjax();
	
    // Abro la conexión y envío los datos
    ajax.open("POST", "gestionaModulo.php", true);
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("accion="+accion+"&cod_ciclo=" + cod_ciclo +"&cod_modulo="+cod_modulo+"&cod_programacion="+cod_programacion+"&cod_materiales="+cod_materiales+"&nombre=" + nombre + "&descripcion=" + descripcion);

    ajax.onreadystatechange = function() {
		if (ajax.readyState == 4) {
			if(accion=='eliminar'){
				window.location.reload();
			}
			else{
				// Respuesta recibida. Coloco el texto plano en la capa correspondiente
				capa.innerHTML = ajax.responseText;
				if (ajax.responseText != "") {
					location.href = "verCiclo.php?codigo=" + cod_ciclo;
				}
			}
		}
    }
}
   
   
function gestionaUnidad(accion,cod_ciclo, cod_modulo, num_unidad,nuevo_numero,nombre, fecha_inicio,fecha_entrega) {
	codigo = cod_ciclo + "_" + cod_modulo + "_" + num_unidad;
	
	// Obtendo la capa donde se muestran las respuestas del servidor
    var capa = document.getElementById("notificacion");

	// COMRPOBAR PARAMETROS
	if(accion=="anadir"){
		if (num_unidad == "" || nombre == "") {
			capa.innerHTML = "Rellene todos los campos";
			exit();
		}
		if (num_unidad >= 0 || num_unidad < 0) {
		} else {
			capa.innerHTML = "El campo numero debe contener un numero";
			exit();
		}	
	}
		

	
    // Abro la conexión y envío los datos
	var ajax = nuevoAjax();
    ajax.open("POST", "gestionaModuloUnidad.php", true);
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("accion="+accion+"&cod_ciclo=" + cod_ciclo +"&cod_modulo="+cod_modulo+"&num_unidad="+num_unidad+ "&nuevo_numero=" + nuevo_numero+"&nombre=" + nombre + "&fecha_inicio=" + fecha_inicio+ "&fecha_entrega=" + fecha_entrega);		
			
    ajax.onreadystatechange = function() {
		if (ajax.readyState == 4) {
			if(accion=='eliminar'){
				window.location.reload();
			}
			else{
				// Respuesta recibida. Coloco el texto plano en la capa correspondiente
				capa.innerHTML = ajax.responseText;
				if (ajax.responseText != "") {
					location.href = "verModulo.php?codigoCiclo=" + cod_ciclo + "&codigo=" + cod_modulo;
				}
			}
		}
    }

}
   
function gestionaCategoria(accion, cod_ciclo, cod_modulo, id_categoria, nombre, descripcion, evaluador, puntuacion) {
    // Obtendo la capa donde se muestran las respuestas del servidor
    var capa = document.getElementById("notificacion");
	
	// COMRPOBAR PARAMETROS
	if(accion=="anadir"){
		if (nombre == "" || puntuacion == "") {
			capa.innerHTML = "Rellene todos los campos";
			exit();
		}
		if (puntuacion >= 0 || puntuacion < 0) {
		} else {
			capa.innerHTML = "El campo puntuacion debe contener un numero";
			exit();
		}	
	}

	
    // Abro la conexión y envío los datos	
	var ajax = nuevoAjax();	
	ajax.open("POST", "gestionaCategoria.php", true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("accion="+accion+"&cod_ciclo="+ cod_ciclo + "&cod_modulo=" + cod_modulo +"&id_categoria=" + id_categoria + "&nombre=" + nombre + "&descripcion=" + descripcion + "&evaluador=" + evaluador + "&puntuacion=" + puntuacion );	
						
    ajax.onreadystatechange = function() {
		if (ajax.readyState == 4) {
			if(accion=='eliminar'){
				window.location.reload();
			}
			else{
				// Respuesta recibida. Coloco el texto plano en la capa correspondiente
				capa.innerHTML = ajax.responseText;
				if (ajax.responseText != "") {
					location.href = "verModuloEjercicios.php?codigoCiclo=" + cod_ciclo + "&codigo=" + cod_modulo;
				}
			}
		}
    }
}
   
   



  
// permite mostrar y ocultar idevices
function muestra_oculta_div(id){
	if (document.getElementById){ //se obtiene el id
		var el = document.getElementById(id); //se define la variable "el" igual a nuestro div
		el.style.display = (el.style.display == 'none') ? 'block' : 'none'; //damos un atributo display:none que oculta el div
	}
}


  
// VALIDAR ENTRADAS
	function comprobar_num_decimal(entrada){
		entrada.value=parseFloat(entrada.value).toFixed(2)	
	}


	function permitir_num_enteros(e){
	    var is_ie = navigator.userAgent.toLowerCase().indexOf('msie ') > -1;
		var codigo = e.which;
		if(is_ie)codigo=e.keyCode;
		if ((codigo > 47 && codigo < 58) ||  codigo==8 || codigo==127 || codigo==9 || codigo==0)
		{
		    if(codigo==46){//Caracter punto
		    	if (is_ie)valor = document.getElementById(e.srcElement.id).value.toString();
		    	else valor = document.getElementById(e.target.id).value.toString();
		        if(valor.indexOf(".")>-1){
			        continuarEvento(e,false);
	                return false;
		        }
		    }
	        continuarEvento(e,true);
	        return true;
		}
		else
		{
				continuarEvento(e,false);
		        return false;
		}
	}


	function no_permitir_escritura(e){
				continuarEvento(e,false);
		        return true;	
	}
	
	function permitir_num_decimales(e){
	    var is_ie = navigator.userAgent.toLowerCase().indexOf('msie ') > -1;
		var codigo = e.which;
		if(is_ie)codigo=e.keyCode;
		if ((codigo > 47 && codigo < 58) || codigo==46 || codigo==8 || codigo==127 || codigo==9 || codigo==0)
		{
		    if(codigo==46){//Caracter punto
		    	if (is_ie)valor = document.getElementById(e.srcElement.id).value.toString();
		    	else valor = document.getElementById(e.target.id).value.toString();
		        if(valor.indexOf(".")>-1){
			        continuarEvento(e,false);
	                return false;
		        }
		    }
	        continuarEvento(e,true);
	        return true;
		}
		else
		{
				continuarEvento(e,false);
		        return false;
		}
	}

	function continuarEvento(evento,continuar)
	{ 
		if (evento.preventDefault && !continuar)
		{
			evento.preventDefault();
			evento.stopPropagation();
		}
		return continuar;
	}
	
	
 function fechaSumarDias(num_dias, fecha) {
 
 var Fecha = new Date();
 var sFecha = fecha || (Fecha.getDate() + "/" + (Fecha.getMonth() +1) + "/" + Fecha.getFullYear()); 

 var sep = sFecha.indexOf('/') != -1 ? '/' : '-'; 
 var aFecha = sFecha.split(sep);
 
 var dias = num_dias || 0; 
 
 var fFecha = Date.UTC(aFecha[2],aFecha[1],aFecha[0])+(86400000*dias); // 86400000 son los milisegundos que tiene un día

 var fechaFinal = new Date(fFecha);
 
 var anno = fechaFinal.getFullYear();
 var mes = fechaFinal.getMonth();
 var dia = fechaFinal.getDate();
 var mes = (mes < 10) ? ("0" + mes) : mes;
 var dia = (dia < 10) ? ("0" + dia) : dia;
 var fechaFinal = dia+sep+mes+sep+anno;
 
 return (fechaFinal);
 
 }
 
	




