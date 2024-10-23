<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Categoría</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($categorias as $categoria): ?>
            <tr>
                <th scope="row"><?php echo $categoria->id ?></th>
                <td><?php echo $categoria->categoria ?></td>
                <td>
                    <a href="/categorias/actualizar?id=<?php echo $categoria->id ?>" class="btn btn-warning btn-block">Editar</a>
                    <form action="/categorias/eliminar" method="post">
                        <input type="hidden" name="id" value="<?php echo $categoria->id ?>">
                        <input type="submit" value="Eliminar" class="btn btn-danger btn-block mt-2">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>