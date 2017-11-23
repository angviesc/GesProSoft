<?php

$atts = array( 'width' => 800, 'height' => 700,
             'scrollbars' => 'yes', 'status' => 'yes',
             'resizable' => 'yes', 'screenx' => 100,
             'screeny' => 100, 'window_name' => '_blank',
              'id' => 'jump');

 ?>

<ul id="slide-out" class="side-nav fixed">
  <li>
    <div class="user-view">
      <div class="background">
        <img src="http://sbigto.com/es/images/Logo550.jpg">
      </div>
      <a href="#!user"><img class="circle" src="https://cdn.pixabay.com/photo/2012/04/26/19/43/profile-42914_960_720.png"></a>
      <a href="#!name"><span class="black-text name"><?=$nombre ?></span></a>
      <a href="#!email"><span class="black-text email"><?=$usuario ?></span></a>
    </div>
  </li>

  <li> <?= anchor_popup('Sistemactrl/nuevoArticulo/1', 'Nuevo Articulo', $atts) ?></li>
  <li><a class="waves-effect" style="text-decoration: none;" href="<?=site_url('Sistemactrl/verBitacora')?>">Ver bitacora</a></li>
  <li><a class="waves-effect" style="text-decoration: none;" href="<?=site_url('Sistemactrl/Mantenimientos')?>">Mantenimientos</a></li>
  <li><div class="divider"></div></li>

  <li class="no-padding">
    <ul class="collapsible collapsible-accordion">
      <li>
        <a class="collapsible-header">Inventario<i class="material-icons">content_paste</i></a>
        <div class="collapsible-body">
          <ul>
            <li><?= anchor_popup('Sistemactrl/nuevoArticulo/1', 'Nuevo Articulo', $atts) ?></li>
            <li><a class="waves-effect" style="text-decoration: none;" href="<?=site_url('Sistemactrl/verArticulos')?>">Ver articulos</a></li>
            <li><a class="waves-effect" style="text-decoration: none;" href="<?=site_url('Sistemactrl/verInentario')?>">Ver inventario</a></li>
            <li class="divider"></li>
            <li><a class="waves-effect" style="text-decoration: none;" href="<?=site_url('Sistemactrl/verPedidos')?>">Abrir lista de pedidos</a></li>
            <li class="divider"></li>
            <li><?= anchor_popup('Sistemactrl/venderStock/1', 'Vender stock', $atts) ?></li>
            <li><?= anchor_popup('Sistemactrl/nuevoPedido/1', 'Pedir stock', $atts) ?></li>
            <li><?= anchor_popup('Sistemactrl/devolverStock/1', 'Devolver stock', $atts) ?></li>
            <li><?= anchor_popup('Sistemactrl/recibirStock/1', 'Recibir stock', $atts) ?></li>
            <li><a class="waves-effect" style="text-decoration: none;" href="<?=site_url('Sistemactrl/transferirStock')?>">Transferir stock</a></li>
          </ul>
        </div>
      </li>
    </ul>
  </li>

  <li class="no-padding">
    <ul class="collapsible collapsible-accordion">
      <li>
        <a class="collapsible-header">Departamentos<i class="material-icons">folder_shared</i></a>
        <div class="collapsible-body">
          <ul>
            <li><?= anchor_popup('Sistemactrl/nuevoDpto/1', 'Nuevo Departamento', $atts) ?></li>
            <li><a class="waves-effect" style="text-decoration: none;" href="<?=site_url('Sistemactrl/verDpto')?>">Ver lista de departamentos</a></li>
          </ul>
        </div>
      </li>
    </ul>
  </li>

  <li class="no-padding">
    <ul class="collapsible collapsible-accordion">
      <li>
        <a class="collapsible-header">Almacenes<i class="material-icons">archive</i></a>
        <div class="collapsible-body">
          <ul>
            <li id="products_product">
              <?= anchor_popup('Sistemactrl/nuevoAlm/1', 'Nuevo almacen', $atts) ?>
              <a class="waves-effect" style="text-decoration: none;" href="<?=site_url('Sistemactrl/verAlm')?>">Ver Almacenes</a>
            </li>
          </ul>
        </div>
      </li>
    </ul>
  </li>

  <li class="no-padding">
    <ul class="collapsible collapsible-accordion">
      <li>
        <a class="collapsible-header">Proveedores<i class="material-icons">supervisor_account</i></a>
        <div class="collapsible-body">
          <ul>
            <li><?= anchor_popup('Sistemactrl/nuevoProv/1', 'Nuevo proveedor', $atts) ?></li>
            <li><a class="waves-effect" style="text-decoration: none;" href="<?=site_url('Sistemactrl/verProveedores')?>">Ver proveedor</a></li>
          </ul>
        </div>
      </li>
    </ul>
  </li>

  <li class="no-padding">
    <ul class="collapsible collapsible-accordion">
      <li>
        <a class="collapsible-header">clientes<i class="material-icons">assignment_ind</i></a>
        <div class="collapsible-body">
          <ul>
            <li><?= anchor_popup('Sistemactrl/nuevoCliente/1', 'Nuevo cliente', $atts) ?></li>
            <li><a class="waves-effect" style="text-decoration: none;" href="<?=site_url('Sistemactrl/verClientes')?>">Ver clientes</a> </li>
          </ul>
        </div>
      </li>
    </ul>
  </li>

  <li class="no-padding">
    <ul class="collapsible collapsible-accordion">
      <li>
        <a class="collapsible-header">Informes<i class="material-icons">assessment</i></a>
        <div class="collapsible-body">
          <ul>
            <li><a class="waves-effect" style="text-decoration: none;" href="<?=site_url('Sistemactrl/excelInventario')?>">Inventario<i class="material-icons">file_download</i></a></li>
            <li><a class="waves-effect" style="text-decoration: none;" href="<?=site_url('Sistemactrl/informeAlmDpto')?>">Informe por almacen/departamento</a> </li>
            <li><a class="waves-effect" style="text-decoration: none;" href="<?=site_url('Sistemactrl/sinFuncion')?>">Inventario por proveedor</a> </li>
            <li><?= anchor_popup('Sistemactrl/verPedidosP', 'Informe pedidos pendientes', $atts) ?></li>
            <li><a class="waves-effect" style="text-decoration: none;" href="<?=site_url('Sistemactrl/informeAlmDpto')?>">Informe de ventas</a> </li>
          </ul>
        </div>
      </li>
    </ul>
  </li>

  <li class="no-padding">
    <ul class="collapsible collapsible-accordion">
      <li>
        <a class="collapsible-header">Sistema<i class="material-icons">settings</i></a>
        <div class="collapsible-body">
          <ul>
            <li><a class="waves-effect" style="text-decoration: none;" href="<?=site_url('Sistemactrl/cerrarSesion')?>">Cerrar Sesion</a></li>
          </ul>
        </div>
      </li>
    </ul>
  </li>

</ul>

<nav class="nav-wrapper blue-grey darken-4">
  <div class="nav-wrapper">
    <a href="#" class="brand-logo">Logo</a>
    <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
  </div>
</nav>
