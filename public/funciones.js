let chart;

function generarGraficoLineas(valoresX, valoresY,labels,ventana) {
    var item='', xDato=[], i=0; 
    valoresY.forEach(element => {
        item={
                label: labels[i],
                data: element,
                borderColor: generarColorAleatorio(i),
                fill: false
            }
        xDato.push(item);    
        i++;
    });

    var ctx = document.getElementById(ventana).getContext('2d');
    console.log(ctx);
    if (chart) { chart.destroy();}
    var chart = new Chart(ctx, {
        type: 'line',   
        data: {
            labels: valoresX,
            datasets: xDato
        },options: {
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom'
                }
            }
        }
    });

}

function prueba()
{
    console.log('Se ejecuta prueba');
}

function generarColorAleatorio(indc) {
var coloresBasicos = [
"#FF0000", // Rojo
"#00FF00", // Verde
"#0000FF", // Azul
"#95a20f", // Amarillo
"#FF00FF", // Magenta
"#00FFFF", // Cian
"#800000", // Marrón
"#008000", // Verde claro
"#000080", // Azul marino
"#808080", // Gris
"#C0C0C0", // Plata
"#FFA500", // Naranja
"#A52A2A", // Marrón claro
"#800080", // Púrpura
"#008080", // Verde oliva
"#000000"  // Negro
];

// Devuelve un color aleatorio de los 16 colores básicos
if (indc>coloresBasicos.length) indc=0;
return coloresBasicos[indc];;

}