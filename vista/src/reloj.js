

	setInterval( function mostrarReloj  () {
	
	var dateNow = new Date();
	//var horas = dateFin.getHours() - dateNow.getHours();
	//var minutos = dateFin.getMinutes() - dateNow.getMinutes();
	//var segundos = dateFin.getSeconds() - dateNow.getSeconds();
	
	var horas = dateNow.getHours();
	var minutos =  dateNow.getMinutes();
	var segundos = dateNow.getSeconds();
	if(horas >= 0 && horas <= 9){
		horas = '0' + horas;
	}
	if(minutos >= 0 && minutos <= 9){
		minutos = '0' + minutos;
	}
	if(segundos >= 0 && segundos <= 9){
		segundos = '0' + segundos;
	}
	
	document.getElementById("horas").innerHTML = horas;
	document.getElementById("minutos").innerHTML = minutos;
	document.getElementById("segundos").innerHTML = segundos;
	
	}, 1000);

