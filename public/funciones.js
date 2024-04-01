
    let chart;

    function generarGraficoLineas(valoresX, valoresY,labels,ventana,tipo) {
        var item='', xDato=[], i=0; 
        
        if (tipo=="Tre"){
        Trend=calcTrend( valoresY[0]);
        valoresY.push(Trend);} 
        
        valoresY.forEach(element => {
            item={
                    label: labels[i],
                    data: element,
                    borderColor: ((tipo=="Tre")&&(i>0))?"gray":generarColorAleatorio(i),
                    pointRadius: ((tipo=="Tre")&&(i>0))?0:4,
                    fill: false
                }
            xDato.push(item);    
            i++;
        });

        

        crearDivSiNoExiste(ventana,tipo);

        var ctx = document.getElementById(ventana).getContext('2d');
        

        if (chart) {   
            chart.destroy();} else {
                                    var chart = new Chart(ctx, {
                                        type: 'line',   
                                        data: {
                                            labels: valoresX,
                                            datasets: xDato,
                                            trendlineLinear: {
                                                style: "#3e95cd",
                                                lineStyle: "line",
                                                width: 1
                                              }
                                        },options: {
                                            plugins: {
                                                legend: {
                                                    display: ((tipo=='Tre')?false:true),
                                                    position: 'bottom'
                                                }
                                            }
                                        }
                                    });
            }
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



    function elementoExiste(id) {
        return !!document.getElementById(id);
    }

    // Función para crear un nuevo div si no existe
    function crearDivSiNoExiste(id,tipo) {
        padre=tipo+id.substring(3,id.length );
        vpdr=document.getElementById(padre);

        contenido="";
        windowDel(id);

        if (!elementoExiste(id)) {
            var nuevoDiv = document.createElement('canvas');
            nuevoDiv.id = id;
          
            if (tipo=='Tre'){
                    nuevoDiv.width="100%";
                    nuevoDiv.height="300";} else 
                {

                    nuevoDiv.width="600";
                    nuevoDiv.height="500";
                }
            nuevoDiv.textContent = contenido;
            vpdr.appendChild(nuevoDiv);
        } else {
            console.log('Ya existe un div con el id ' + id);
            // Opcionalmente, puedes actualizar el contenido del div existente aquí
        }
    }

    function windowDel(id)
    {     
        if (elementoExiste(id)) {
            elemento=document.getElementById(id);
            elemento.remove();
        }
    }

    function calcTrend(datos)  {
             const n = datos.length;

    // Calcular sumatorias
    let sum_x = 0;
    let sum_y = 0;
    let sum_xy = 0;
    let sum_x_squared = 0;

    datos.forEach((y, x) => {
        sum_x += x;
        sum_y += y;
        sum_xy += x * y;
        sum_x_squared += x * x;
    });

    // Calcular pendiente (m) y ordenada al origen (b)
    const m = (n * sum_xy - sum_x * sum_y) / (n * sum_x_squared - sum_x * sum_x);
    const b = (sum_y - m * sum_x) / n;

    // Generar puntos para la línea de tendencia
    const lineaTendencia = datos.map((y, x) => m * x + b);

    return lineaTendencia;
        }