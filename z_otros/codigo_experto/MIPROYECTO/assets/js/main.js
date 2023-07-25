$("#selector_categoria").on("change", function(){
    var valor_filtro = $(this).val();
    document.location.href = "http://localhost/MIPROYECTO/?filtro_categoria=" + valor_filtro;
});

