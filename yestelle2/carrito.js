let carrito = JSON.parse(localStorage.getItem("carrito")) || [];

function agregarAlCarrito(producto) {
  carrito.push(producto);
  localStorage.setItem("carrito", JSON.stringify(carrito));
  alert(`${producto.nombre} añadido al carrito.`);
}

function eliminarDelCarrito(index) {
  carrito.splice(index, 1);
  localStorage.setItem("carrito", JSON.stringify(carrito));
  mostrarCarrito();
}

function mostrarCarrito() {
  const carritoDiv = document.getElementById("carrito");
  carritoDiv.innerHTML = "";

  if (carrito.length === 0) {
    carritoDiv.innerHTML = "<p>Tu carrito está vacío.</p>";
    return;
  }

  carrito.forEach((producto, index) => {
    const item = document.createElement("div");
    item.className = "producto-carrito";
    item.innerHTML = `
      <h3>${producto.nombre}</h3>
      <p>Precio: €${producto.precio}</p>
      <button onclick="eliminarDelCarrito(${index})" class="btn btn-danger btn-sm">Eliminar</button>
    `;
    carritoDiv.appendChild(item);
  });
}

function realizarCompra() {
  if (carrito.length === 0) {
    alert("Tu carrito está vacío.");
    return;
  }

  alert("Compra realizada con éxito. Gracias.");
  carrito = [];
  localStorage.removeItem("carrito");
  mostrarCarrito();
}
