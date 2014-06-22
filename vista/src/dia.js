date = new Date();
var dia = date.getDay();
var mes = date.getMonth();
var dias = ['domingo', 'lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado'];
var meses = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'nomviembre', 'diciembre'];

document.getElementById("dia").innerHTML = dias[dia] + ' ' + date.getDate() + ' de ' + meses[mes] + ' de ' + date.getFullYear();

