<fieldset>
      <legend>Informacion General</legend>

      <label for="nombre">Nombre:</label>
      <input type="text" id="nombre" name="vendedor[nombre]" placeholder="Nombre Vendedor" value="<?php echo s($vendedor->nombre); ?>">

      <label for="apellido">Apellido:</label>
      <input type="text" id="apellido" name="vendedor[apellido]" placeholder="Apellido Vendedor" value="<?php echo s($vendedor->apellido); ?>">

</fieldset>

<fieldset>
  <legend>Informacion Extra</legend>

      <label for="telefono">Telefono:</label>
      <input type="text" id="telefono" name="vendedor[telefono]" placeholder="Telefono Vendedor" value="<?php echo s($vendedor->telefono); ?>">

      <label for="email">Email:</label>
      <input type="text" id="email" name="vendedor[email]" placeholder="Email Vendedor" value="<?php echo s($vendedor->email); ?>">
</fieldset>