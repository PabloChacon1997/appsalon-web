let paso = 1;
const pasoInicial = 1;
const pasoFinal = 3;

document.addEventListener("DOMContentLoaded", function () {
  iniciarApp();
});

function iniciarApp() {
  mostrarSeccion(); //Muestra y oculta las secciones
  tabs(); // Cambia la seccion cuando presione eltab
  botonesPaginador(); // Agrega o quita los botones del paginado
  paginaSiguiente();
  paginaAnterior();
}

function mostrarSeccion() {
  // Ocultar la seccion que tenga la clase de mostrar
  const seccionAnterior = document.querySelector(".mostrar");

  if (seccionAnterior) {
    seccionAnterior.classList.remove("mostrar");
  }

  // Seleccionar la seccion con el paso
  const pasoSeleccionado = `#paso-${paso}`;
  const seccion = document.querySelector(pasoSeleccionado);
  seccion.classList.add("mostrar");

  // Quita la clase de actual al tab anterior
  const tabAnterior = document.querySelector(".actual");
  if (tabAnterior) {
    tabAnterior.classList.remove("actual");
  }
  // Resalta el tab actual
  const tab = document.querySelector(`[data-paso="${paso}"]`);
  tab.classList.add("actual");
}

function tabs() {
  const botones = document.querySelectorAll(".tabs button");
  botones.forEach((boton) => {
    boton.addEventListener("click", (e) => {
      paso = parseInt(e.target.dataset.paso);
      mostrarSeccion();
      botonesPaginador();
    });
  });
}

function botonesPaginador() {
  const pagAnt = document.querySelector("#anterior");
  const pagSig = document.querySelector("#siguiente");

  if (paso === 1) {
    pagAnt.classList.add("ocultar");
    pagSig.classList.remove("ocultar");
  } else if (paso === 3) {
    pagAnt.classList.remove("ocultar");
    pagSig.classList.add("ocultar");
  } else {
    pagAnt.classList.remove("ocultar");
    pagSig.classList.remove("ocultar");
  }

  mostrarSeccion();
}

function paginaAnterior() {
  const paginaAnterior = document.querySelector("#anterior");
  paginaAnterior.addEventListener("click", () => {
    if (paso <= pasoInicial) return;
    paso--;
    botonesPaginador();
  });
}
function paginaSiguiente() {
  const paginaSiguiente = document.querySelector("#siguiente");
  paginaSiguiente.addEventListener("click", () => {
    if (paso >= pasoFinal) return;
    paso++;
    botonesPaginador();
  });
}
