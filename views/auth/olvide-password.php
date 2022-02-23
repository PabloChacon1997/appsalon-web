<h1 class="nombre-pagina">Olvide Password</h1>
<p class="descripcion-pagina">Restablece tu password escriebiendo tu email acontinuación</p>

<form action="/olvide" method="POST" class="formulario" >
  <div class="campo">
    <label for="email">Email</label>
    <input type="email" name="email" id="email" placeholder="Tu email" />
  </div>
  <input type="submit" value="Enviar instrucciones" class="boton" />
</form>

<div class="acciones">
  <a href="/">¿Ya tienes cuenta? Inicia sesion</a>
  <a href="/crear-cuenta">¿Aún no tienes una cuenta? Crear una</a>
</div>