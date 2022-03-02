<h1 class="nombre-pagina">Recuperar password</h1>
<p class="descripcion-pagina">Coloca tu nuevo password a continuación</p>
<?php include_once __DIR__.'/../templates/alertas.php'; ?>

<?php if($error) return; ?>
<form method="POST" class="formulario">
  <div class="campo">
    <label for="password">Paasword</label>
    <input type="password" id="password" name="password" placeholder="Tu nuevo password" />
  </div>
  <input type="submit" value="Guardar nuevo password" class="boton" />
</form>

<div class="acciones">
  <a href="/">¿Ya tienes cuenta? Iniciar Sesión</a>
  <a href="/crear-cuenta">¿Aun no tienes cuenta? Crear una</a>
</div>