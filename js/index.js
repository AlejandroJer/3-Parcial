function showForm(e){
    const form = document.querySelector('.formulario')
    form.classList.toggle('hidden')
}

function getRandom(min, max){
    return Math.floor(Math.random() * (max - min)) + min
}

function colorear(e){
    lista = ['rojo', 'naranja', 'verde', 'azul', 'morado', 'rosa', 'gris']
    num = getRandom(0, lista.length)
    variante = getRandom(1, 2)

    e.style.backgroundColor = "var(--" + lista[num] + "-" + variante + ")"
}

// const form_product = `
//             <form id="productos-formulario" class="formulario">
//                 <label for="producto-id">ID de Producto:</label>
//                 <input type="number" id="producto-id" name="producto-id" required><br>

//                 <label for="nombre-producto">Nombre del Producto:</label>
//                 <input type="text" id="nombre-producto" name="nombre-producto" required><br>

//                 <label for="descripcion">Descripción:</label>
//                 <textarea id="descripcion" name="descripcion" rows="4" required></textarea><br>

//                 <label for="imagen">Imagen:</label>
//                 <input type="text" id="imagen" name="imagen" required><br>

//                 <label for="precio-venta">Precio de Venta:</label>
//                 <input type="number" id="precio-venta" name="precio-venta" step="0.01" required><br>

//                 <label for="precio-compra">Precio de Compra:</label>
//                 <input type="number" id="precio-compra" name="precio-compra" step="0.01" required><br>

//                 <label for="categoria">Categoría:</label>
//                 <input type="text" id="categoria" name="categoria" required><br>

//                 <label for="peso">Peso:</label>
//                 <input type="number" id="peso" name="peso" step="0.01" required><br>

//                 <label for="material">Tipo de Material:</label>
//                 <input type="text" id="material" name="material" required><br>

//                 <label for="proveedor-id">Proveedor ID:</label>
//                 <input type="number" id="proveedor-id" name="proveedor-id" required><br>

//                 <label for="cantidad-disponible">Cantidad Disponible:</label>
//                 <input type="number" id="cantidad-disponible" name="cantidad-disponible" required><br>

//                 <label for="ubicacion-almacen">Ubicación en el Almacén:</label>
//                 <input type="text" id="ubicacion-almacen" name="ubicacion-almacen" required><br>

//                 <button type="submit">Guardar</button>
//             </form>
// `
// const form_providers = `
//         <form id="proveedores-formulario" class="formulario">
//             <label for="proveedor-id">ID de Proveedor:</label>
//             <input type="number" id="proveedor-id" name="proveedor-id" required><br>

//             <label for="nombre-empresa">Nombre de la Empresa:</label>
//             <input type="text" id="nombre-empresa" name="nombre-empresa" required><br>

//             <label for="persona-contacto">Persona de Contacto:</label>
//             <input type="text" id="persona-contacto" name="persona-contacto" required><br>

//             <label for="direccion">Dirección:</label>
//             <input type="text" id="direccion" name="direccion" required><br>

//             <label for="telefono">Número de Teléfono:</label>
//             <input type="text" id="telefono" name="telefono" required><br>

//             <label for="correo">Correo Electrónico:</label>
//             <input type="email" id="correo" name="correo" required><br>

//             <button type="submit">Guardar</button>
//         </form>
// `
// const form_clients = `
//             <form id="usuarios-formulario" class="formulario">
//                 <label for="usuario-id">ID de Usuario:</label>
//                 <input type="number" id="usuario-id" name="usuario-id" required><br>

//                 <label for="nombre-usuario">Nombre de Usuario:</label>
//                 <input type="text" id="nombre-usuario" name="nombre-usuario" required><br>

//                 <label for="contrasena">Contraseña:</label>
//                 <input type="password" id="contrasena" name="contrasena" required><br>

//                 <label for="nombre-completo">Nombre Completo:</label>
//                 <input type="text" id="nombre-completo" name="nombre-completo" required><br>

//                 <label for="correo-usuario">Correo Electrónico:</label>
//                 <input type="email" id="correo-usuario" name="correo-usuario" required><br>

//                 <label for="perfil-id">Perfil:</label>
//                 <input type="number" id="perfil-id" name="perfil-id" required><br>

//                 <button type="submit">Guardar</button>
//             </form>
// `

// const listForms = [form_product, form_providers, form_clients, form_admin]

// selecciona el ul que tiene a la lista de elementos
// const index = document.querySelectorAll('.index_ul li')
const inCon = document.querySelector('.index_container')

// // recorre la lista de elementos y les agrega un evento click
// index.forEach(element => {
//     element.addEventListener('click', (e) => {
//         console.log(e.target)
//         let indexContainer = document.querySelector('.index_container')
//         let dataform = e.target.getAttribute('data-form')

//         for (let i = 0; i < index.length; i++) {
//             index[i].classList.remove('active')
//         }

//         e.target.classList.add('active')

//         indexContainer.innerHTML = listForms[dataform] // agrega el formulario correspondiente
//     })
// });

// for(let i=0; i < inCon.children.length; i++){
//     colorear(inCon.children[i])
// }