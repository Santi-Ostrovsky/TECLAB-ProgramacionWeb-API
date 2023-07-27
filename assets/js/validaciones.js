// Definir variables globales
let intentos_categorias = 0;
let intentos_productos = 0;

/// -------------------------------

// $(document).ready(function () {
//   alert("Sitio Listo!");
// });

/*          SINTAXIS JQUERY  

$("identificador-de-elemento").evento(function () {
    [bloque-de-código]
})                                              */

// HANDLER - CATEGORIAS
$("#form-carga-categorias").submit(function (e) {
  // Anular recarga del sitio
  e.preventDefault();

  const CATEGORIA = $("#nombre_categoria").val();

  //    if ($.trim(CATEGORIA) === '') {[...]}
  //     VALORES FALSY:
  //     - "false"
  //     - 0
  //     - ""
  //     - null
  //     - undefined
  //     - NaN

  // Detectar envío de Nombre VACÍO
  if (!$.trim(CATEGORIA)) {
    intentos_categorias += 1;
    alert(
      `Complete el campo "Nombre".\nIntentos fallidos: ${intentos_categorias}`
    );
    return false;
  }

  // Confirmar envío de formulario CORRECTO
  alert(`Formulario enviado.\nCategoría "${CATEGORIA}" creada exitosamente.`);
  this.reset();
  return true;
});

// HANDLER - PRODUCTOS
$("#form-carga-productos").submit(function (e) {
  // Anular recarga del sitio
  e.preventDefault();

  // Definir constantes por cada campo del form
  const NOMBRE = $.trim($("#nombre_producto").val());
  const DESCRIPCION = $.trim($("#descripcion_producto").val());
  const PRECIO = parseInt($.trim($("#precio_producto").val())); // Remueve letras si hay un número
  const CATEGORIA = parseInt($.trim($("#categoria_producto").val()));
  const IMAGEN = $.trim($("#imagen_producto").val());

  // Declarar Array (Arreglo) de Errores
  const ERRORES = [];
  // Detectar envío de Nombre VACÍO
  if (!NOMBRE) ERRORES.push(`"Nombre"`);
  // Detectar envío de Descripción VACÍO
  if (!DESCRIPCION) ERRORES.push(`"Descripción"`);
  // Detectar envío de Precio VACÍO
  if (!PRECIO) ERRORES.push(`"Precio"`);
  // Detectar envío de Categoría VACÍO
  if (!CATEGORIA) ERRORES.push(`"Categoría"`);
  // Detectar envío de Imagen VACÍO
  if (!IMAGEN) ERRORES.push(`"Imagen"`);

  // Enumerar errores existentes
  // if (ERRORES.length > 0)
  if (ERRORES.length) {
    intentos_productos += 1;
    alert(
      `Debe completar:${ERRORES.map(
        (e) => `\n- ${e}`
      )}\n\nIntentos fallidos: ${intentos_productos}`
    );
    return false;
  }

  // Confirmar envío de formulario CORRECTO
  alert(`Formulario enviado.\nProducto "${NOMBRE}" creado exitosamente.`);
  this.reset();
  return true;
});

// ------------------------------------------------
