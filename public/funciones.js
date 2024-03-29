
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

        crearDivSiNoExiste(ventana);

        var ctx = document.getElementById(ventana).getContext('2d');
        

        if (chart) {   
            chart.destroy();} else {
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
    function crearDivSiNoExiste(id) {
        padre="Mac"+id.substring(3,id.length );
        vpdr=document.getElementById(padre);

        contenido="";
        windowDel(id);

        if (!elementoExiste(id)) {
            var nuevoDiv = document.createElement('canvas');
            nuevoDiv.id = id;
            nuevoDiv.width="600";
            nuevoDiv.height="500";
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