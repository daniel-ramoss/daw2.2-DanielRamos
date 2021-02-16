window.onload = inicializaciones;
var tablaCategorias;
// TODO ¿Útil para mantener un control de eliminaciones, etc.?     var categorias;



function inicializaciones() {
    tablaCategorias = document.getElementById("tablaCategorias");
    document.getElementById('submitCrearCategoria').addEventListener('click', clickCrearCategoria);
    cargarTodasLasCategorias();

}

function cargarTodasLasCategorias() {
    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var categorias = JSON.parse(this.responseText);
            for (var i=0; i<categorias.length; i++) {
                insertarCategoria(categorias[i]);
            }
        }
    };

    request.open("GET", "CategoriaObtenerTodas.php");
    request.send();
}

function clickCrearCategoria() {
    alert("Creando categoria --> clickCrearCategoria()");
    var campoNombre = document.getElementById("nombre").value;
    alert("CampoNombre: "+campoNombre);
    if (campoNombre!=""){
        var request = new XMLHttpRequest();
        request.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                alert("Request de clickCrearCategoria");
                var categoria = JSON.parse(this.responseText);
                insertarCategoria(categoria);
                document.getElementById("nombre").value= "";
            }
        };
        request.open("GET", "CategoriaCrear.php?nombre="+campoNombre);
        request.send();
        alert("Se va a realizar una inserción...");
    }
}

function insertarCategoria(categoria) {
    // TODO Que la categoría se inserte en el lugar que le corresponda según un orden alfabético.
    // Usar esto: https://www.w3schools.com/jsref/met_node_insertbefore.asp

    var tr = document.createElement("tr");
    var td = document.createElement("td");
    var a = document.createElement("a");
    var btnEliminar = document.createElement("input");
    btnEliminar.type="button";
    btnEliminar.id="btnEliminar"+categoria.id;
    btnEliminar.value="Eliminar";
    a.setAttribute("href","CategoriaFicha.php?id=" + categoria.id);
    var textoContenido = document.createTextNode(categoria.nombre);

    a.appendChild(textoContenido);
    a.appendChild(btnEliminar);
    td.appendChild(a);
    tr.appendChild(td);
    tablaCategorias.appendChild(tr);
}

function eliminarCategoria(id) {
}

function modificarCategoria(categoria) {
    // TODO Pendiente de hacer.
}

// TODO Actualizar lo local si actualizan el servidor. Poner timestamp de modificación en la tabla y pedir categoriaObtenerModificadasDesde(timestamp)