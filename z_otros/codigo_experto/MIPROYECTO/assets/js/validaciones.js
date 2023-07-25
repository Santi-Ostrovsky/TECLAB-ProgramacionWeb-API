$("form#form_categoria").on("submit", function(){
    var nombre = $.trim($("#categoria_nombre").val());
    var error = new Array();

    if (nombre == ""){
        error.push("Por favor, complete el nombre");
    }
    
    if (error.length > 0){
        alert(error.join("\n"));
        return false;
    }
    
    return true;
});


$("form#form_producto").on("submit", function(){
    var nombre = $.trim($("#producto_nombre").val());
    var categoria = $("#producto_categoria").val();
    var imagen = $("#imagen_producto").val();
    var error = new Array();
    if (nombre == ""){
        error.push("Por favor, complete el nombre");
    }
    if (categoria == "" || categoria == null){
        error.push("Por favor, seleccione categoria");
    }
    if (imagen == ""){
        error.push("Cargue una imagen para el producto");
    }
    
    if (error.length > 0){
        alert(error.join("\n"));
        return false;
    }
    
    return true;
});