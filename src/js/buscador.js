document.addEventListener("DOMContentLoaded", () => {
  iniciarApp();
});

function iniciarApp() {
  bucarPorFecha();
}

function bucarPorFecha() {
  const fechaInput = document.querySelector("#fecha");
  fechaInput.addEventListener("input", (e) => {
    const fechaSeleccionada = e.target.value;
    window.location = `?fecha=${fechaSeleccionada}`;
  });
}
