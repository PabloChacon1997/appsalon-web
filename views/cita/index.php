<h1 class="nombre-pagina">Crear Nueva Cita</h1>
<p class="descripcion-pagina">Elige tus servicios y coloca tus datos</p>

<div id="app">


  <nav class="tabs">
    <button class="actual" type="button" data-paso="1" >Servicios</button>
    <button type="button" data-paso="2" >Datos y cita</button>
    <button type="button" data-paso="3" >Resumen</button>
  </nav>

  <div id="paso-1" class="seccion">
    <h2>Servicios</h2>
    <p class="text-center">Elige tus servicios a continuación.</p>
    <div id="servicios" class="lista-servicios"></div>
  </div>
  <div id="paso-2" class="seccion">
    <h2>Tus datos y cita</h2>
    <p class="text-center">Coloca tus datos y fecha de cita.</p>
    <form class="formulario">
      <div class="campo">
        <label for="nombre">Nombre</label>
        <input type="text" disabled value="<?php echo $nombre; ?>" name="nombre" id="nombre" placeholder="Tu nombre" />
      </div>
      <div class="campo">
        <label for="fecha">Fecha</label>
        <input type="date" name="fecha" id="fecha" />
      </div>
      <div class="campo">
        <label for="hora">Hora</label>
        <input type="time" name="hora" id="hora" />
      </div>
    </form>
  </div>
  <div id="paso-3" class="seccion">
    <h2>Resumen</h2>
    <p class="text-center">Verifique la información.</p>
  </div>

  <div class="paginacion">
    <button id="anterior" class="boton">&laquo; Anterior</button>
    <button id="siguiente" class="boton">Siguiente &raquo;</button>
  </div>
</div>

<?php 

  $script = "<script src='build/js/app.js'></script>";

?>