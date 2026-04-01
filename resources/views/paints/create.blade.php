<form method="POST" action="/paints">
    @csrf

    <input name="name" placeholder="Nombre">
    <input name="brand" placeholder="Marca">
    <input name="color_type" placeholder="Tipo">

    <input name="stock" type="number" placeholder="Stock">
    <input name="price" type="number" step="0.01" placeholder="Precio">

    <button type="submit">Guardar</button>
</form>