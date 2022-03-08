<h1 class="nombre-pagina">Nuevo Servicio</h1>
<p class="descripcion-pagina">Llena todos los campos para crear un nuevo servicio</p>

<div class="acciones">
  <a href="/servicios" class="boton"><< Volver</a>
</div>

<?php include_once __DIR__."/../templates/alertas.php"; ?>


<form action="/servicios/crear" method="POST" class="formulario">
  <?php @include __DIR__."/formulario.php"; ?>
  <input type="submit" value="Guardar servicio" class="boton" />
</form>