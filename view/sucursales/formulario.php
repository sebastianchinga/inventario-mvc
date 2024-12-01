<div class="form-group">
    <label for="provincia">Provincia</label>
    <input type="text" name="sucursal[provincia]" id="provincia" class="form-control" placeholder="Escribe una provincia" value="<?php echo $sucursal->provincia ?>">
</div>
<div class="form-group">
    <label for="direccion">Direccion</label>
    <input type="text" name="sucursal[direccion]" id="direccion" class="form-control" placeholder="Escribe una dirección" value="<?php echo $sucursal->direccion ?>">
</div>
<div class="form-group">
    <label for="marca">Empresa</label>
    <select name="sucursal[empresas_id]" id="" class="form-control">
        <option value="">--Elije una empresa--</option>
        <?php foreach($empresas as $empresa): ?>
            <option <?php echo $sucursal->empresas_id == $empresa->id ? 'selected' : '' ?> value="<?php echo $empresa->id ?>"><?php echo $empresa->empresa ?></option>
        <?php endforeach; ?>
    </select>
</div>