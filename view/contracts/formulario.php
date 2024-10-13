<div class="form-group">
    <label for="cliente">Cliente</label>
    <input type="text" name="contrato[cliente]" class="form-control" id="cliente" placeholder="Nombre del cliente" value="<?php echo s($contrato->cliente) ?>">
</div>
<div class="form-group">
    <label for="dni">DNI</label>
    <input type="text" name="contrato[dni]" class="form-control" id="dni" placeholder="DNI del cliente" value="<?php echo s($contrato->dni) ?>">
</div>
<div class="form-group">
    <label for="fecha_inicio">Fecha de inicio</label>
    <input type="date" name="contrato[inicio]" class="form-control" id="fecha_inicio" value="<?php echo s($contrato->inicio) ?>">
</div>
<div class="form-group">
    <label for="servicios">Servicio</label>
    <select name="contrato[servicios_id]" id="servicios" class="form-control">
        <option value="">--Seleciona un servicio--</option>
        <?php foreach ($servicios as $servicio): ?>
            <option <?php echo $servicio->id === $contrato->servicios_id ? 'selected' : '' ?> value="<?php echo $servicio->id ?>"><?php echo $servicio->servicio ?></option>
        <?php endforeach ?>
    </select>
</div>
<div class="form-group">
    <label for="tiempo">Tiempo</label>
    <select name="contrato[tiempo]" id="tiempo" class="form-control">
        <option value="">--Seleciona un tiempo--</option>
        <option <?php echo $contrato->tiempo === '1' ? 'selected' : '' ?> value="1">Evento</option> <!--1 dia-->
        <option <?php echo $contrato->tiempo === '2' ? 'selected' : '' ?> value="2">Mensual</option> <!--30 dias-->
        <option <?php echo $contrato->tiempo === '3' ? 'selected' : '' ?> value="3">Trimestral</option> <!--90 dias-->
        <option <?php echo $contrato->tiempo === '4' ? 'selected' : '' ?> value="4">Semestral</option> <!--180 dias-->
        <option <?php echo $contrato->tiempo === '5' ? 'selected' : '' ?> value="5">Anual</option> <!--365 dias-->
    </select>
</div>