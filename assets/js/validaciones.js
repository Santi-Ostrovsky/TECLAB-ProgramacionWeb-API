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

  const CATEGORIA = $("#nombre-categoria").val();

  /* if ($.trim(CATEGORIA) === '') {[...]}
    VALORES FALSY:
    - "false"
    - 0
    - ""
    - null
    - undefined
    - NaN                               */

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

// EXPLICAR IF(...) SIN "ELSE"

// HANDLER - PRODUCTOS
$("#form-carga-productos").submit(function (e) {
  // Anular recarga del sitio
  e.preventDefault();

  // Definir constantes por cada campo del form
  const NOMBRE = $("#nombre-producto").val();
  const DESCRIPCION = $("#descripcion-producto").val();
  const PRECIO = $("#precio-producto").val();
  const CATEGORIA = $("#categoria-producto").val();
  const IMAGEN = $("#imagen-producto").val();

  // Definir Array (Arreglo) de Errores
  const ERRORES = [];

  // Detectar envío de Nombre VACÍO
  if (!$.trim(NOMBRE)) ERRORES.push(`"Nombre"`);

  // Detectar envío de Descripción VACÍO
  if (!$.trim(DESCRIPCION)) ERRORES.push(`"Descripción"`);

  // Detectar envío de Precio VACÍO
  if (!$.trim(PRECIO)) ERRORES.push(`"Precio"`);

  // Detectar envío de Categoría VACÍO
  if (!$.trim(CATEGORIA)) ERRORES.push(`"Categoría"`);

  // Detectar envío de Imagen VACÍO
  if (!$.trim(IMAGEN)) ERRORES.push(`"Imagen"`);

  // Enumerar errores existentes
  // if (ERRORES.length > 0)
  if (ERRORES.length) {
    intentos_productos += 1;
    alert(
      `Debe completar ${ERRORES.map(
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
