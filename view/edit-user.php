<div class="container" style="margin-top: 50px;">
    <div class="card">
        <div class="card-header" style="text-align:center;">
            Editar Usuario
            <?php
            if (isset($_GET["views"])) {
                $ruta = explode("/", $_GET["views"]);
                echo $ruta[1];
            }
            ?>
        </div>
        <form id="frm_edit_user" method="POST" action="">
            <input type="hidden" name="id_persona" id="id_persona" value="<?= $ruta[1]; ?>">
            <div class="card-body">
                <input type="hidden" name="id" value="">
                <div class="form-group">
                    <label for="nro_identidad">DNI</label>
                    <input type="number" class="form-control" id="nro_identidad" name="nro_identidad" value="" required>
                </div>
                <div class="form-group">
                    <label for="razon_social">Nombres y Apellidos</label>
                    <input type="text" class="form-control" id="razon_social" name="razon_social" value="" required>
                </div>
                <div class="form-group">
                    <label for="telefono">Telefono</label>
                    <input type="text" class="form-control" id="telefono" name="telefono" value="" required>
                </div>
                <div class="form-group">
                    <label for="correo">Correo</label>
                    <input type="email" class="form-control" id="correo" name="correo" value="" required>
                </div>
                <div class="form-group">
                    <label for="departamento">Departamento</label>
                    <input type="text" class="form-control" id="departamento" name="departamento" value="" required>
                </div>
                <div class="form-group">
                    <label for="provincia">Provincia</label>
                    <input type="text" class="form-control" id="provincia" name="provincia" value="" required>
                </div>
                <div class="form-group">
                    <label for="distrito">Distrito</label>
                    <input type="text" class="form-control" id="distrito" name="distrito" value="" required>
                </div>
                <div class="form-group">
                    <label for="cod_postal">Codigo Postal</label>
                    <input type="number" class="form-control" id="cod_postal" name="cod_postal" value="" required>
                </div>
                <div class="form-group">
                    <label for="direccion">Direccion</label>
                    <input type="text" class="form-control" id="direccion" name="direccion" value="" required>
                </div>
                <div class="form-group">
                    <label for="rol">Rol</label>
                    <select id="rol" name="rol" class="form-control" required>
                        <option value="">Seleccionar rol</option>
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                        <option value="invit">Invitado</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="estado">Estado</label>
                    <select id="estado" name="estado" class="form-control" required>
                        <option value="">Seleccionar estado</option>
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>
                </div>
                <div class="m-3" style="display: flex; justify-content:center; gap: 20px">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <a href="<?php echo BASE_URL; ?>users" class="btn btn-secondary">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="<?php echo BASE_URL; ?>view/function/users.js"></script>
<script>
    edit_user();
</script>