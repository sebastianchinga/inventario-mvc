<div class="form-group">
    <label for="producto">Producto</label>
    <input type="text" name="producto[producto]" class="form-control" id="producto" placeholder="Nombre del producto" value="<?php echo s($producto->producto) ?>">
</div>
<div class="form-group">
    <label for="modelo">Modelo</label>
    <input type="text" name="producto[modelo]" class="form-control" id="modelo" placeholder="Modelo del producto" value="<?php echo s($producto->modelo) ?>">
</div>
<div class="form-group">
    <label for="serie">Serie</label>
    <input type="text" name="producto[serie]" class="form-control" id="serie" placeholder="Serie del producto" value="<?php echo s($producto->serie) ?>">
</div>
<div class="form-group">
    <label for="inputGroupFile01">Imágen</label>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
        </div>
        <div class="custom-file">
            <input accept="image/jpeg, image/png" type="file" name="producto[imagen]" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
            <label class="custom-file-label" for="inputGroupFile01">Elegir imágen</label>
        </div>
    </div>
</div>
<?php if($producto->imagen): ?>
    <img src="/productosImagenes/<?php echo $producto->imagen ?>" alt="Imágenes de productos" width="200px">
<?php endif; ?>
<div class="form-group">
    <label for="precio">Precio</label>
    <input type="number" name="producto[precio]" class="form-control" id="precio" placeholder="Pecio del producto" value="<?php echo $producto->precio ?>">
</div>
<div class="form-group">
    <label for="comprador">Comprador</label>
    <input type="text" name="producto[comprador]" class="form-control" id="comprador" placeholder="Comprador" value="<?php echo s($producto->comprador) ?>">
</div>
<div class="form-group">
    <label>Fecha</label>

    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
        </div>
        <input type="date" class="form-control" name="producto[fecha]" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask value="<?php echo $producto->fecha ?>">
    </div>
    <!-- /.input group -->
</div>
<div class="form-group">
    <label for="categorias_id">Categorías</label>
    <select class="form-control select2" style="width: 100%;" name="producto[categorias_id]" id="categorias_id">
        <option value="">--Seleecione una categoría--</option>
        <?php foreach($categorias as $categoria): ?>
            <option <?php echo $producto->categorias_id === $categoria->id ? 'selected' : '' ?> value="<?php echo $categoria->id  ?>"><?php echo $categoria->categoria ?></option>
        <?php endforeach; ?>
    </select>
</div>
<div class="form-group">
    <label for="empresas_id">Empresas</label>
    <select class="form-control select2" style="width: 100%;" name="producto[empresas_id]" id="empresas_id">
        <option value="">--Seleecione una empresa--</option>
        <?php foreach($empresas as $empresa): ?>
            <option <?php echo $producto->empresas_id === $empresa->id ? 'selected' : '' ?> value="<?php echo $empresa->id ?>"><?php echo $empresa->empresa ?></option>
        <?php endforeach; ?>
    </select>
</div>
<div class="form-group">
    <label for="marcas_id">Marcas</label>
    <select class="form-control select2" style="width: 100%;" name="producto[marcas_id]" id="marcas_id">
        <option value="">--Seleecione una marca--</option>
        <?php foreach($marcas as $marca): ?>
            <option <?php echo $producto->marcas_id === $marca->id ? 'selected' : '' ?> value="<?php echo $marca->id ?>"><?php echo $marca->marca ?></option>
        <?php endforeach; ?>
    </select>
</div>