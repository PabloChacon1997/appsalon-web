<h1 class="nombre-pagina">Login</h1>

<p class="descripcion-pagina">Inicia sesion con tus datos</p>

<form method="POST" action="/" class="formulario">
  <div class="campo">
    
    <label for="email">Email</label>
    <input type="email" name="email" id="email" placeholder="Tu email"/>
  </div>

  <div class="campo">
  <label for="password">Password</label>
    <input type="password" name="password" id="password" placeholder="Tu password"/>

  </div>
  <input type="submit" value="Iniciar sesion" class="boton" />
</form>

<div class="acciones">
  <a href="/crear-cuenta">¿Aún no tienes una cuenta? Crear una</a>
  <a href="/olvide">¿Olvidates tu password?</a>
</div>