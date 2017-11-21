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
      <a href="#!user"><img class="circle" src="https://res.cloudinary.com/dacg0wegv/image/upload/t_media_lib_thumb/v1463990208/photo_dkkrxc.png"></a>
      <a href="#!name"><span class="white-text name">John Doe</span></a>
      <a href="#!email"><span class="white-text email">jdandturk@gmail.com</span></a>
    </div>
  </li>

  <li> <?= anchor_popup('Sistemactrl/nuevoArticulo/1', 'Nuevo Articulo', $atts) ?></li>
  <li><div class="divider"></div></li>

  <li class="no-padding">
    <ul class="collapsible collapsible-accordion">
      <li>
        <a class="collapsible-header">Inventario<i class="material-icons">arrow_drop_down</i></a>
        <div class="collapsible-body">
          <ul>
            <li><?= anchor_popup('Sistemactrl/nuevoArticulo/1', 'Nuevo Articulo', $atts) ?></li>
            <li><a class="waves-effect" style="text-decoration: none;" href="<?=site_url('Sistemactrl/SinFuncion')?>">Buscar articulo</a></li>
            <li><a class="waves-effect" style="text-decoration: none;" href="<?=site_url('Sistemactrl/verArticulos')?>">Ver articulos</a></li>
            <li><a class="waves-effect" style="text-decoration: none;" href="<?=site_url('Sistemactrl/verInentario')?>">Ver inventario</a></li>
            <li class="divider"></li>
            <li><a class="waves-effect" style="text-decoration: none;" href="<?=site_url('Sistemactrl/verPedidos')?>">Abrir lista de pedidos</a></li>
            <li class="divider"></li>
            <li><?= anchor_popup('Sistemactrl/venderStock', 'Vender stock', $atts) ?></li>
            <li><?= anchor_popup('Sistemactrl/nuevoBio', 'Recibir stock', $atts) ?></li>
            <li><?= anchor_popup('Sistemactrl/nuevoBio', 'Pedir stock', $atts) ?></li>
            <li><a class="waves-effect" style="text-decoration: none;" href="<?=site_url('Sistemactrl/transferirStock')?>">Transferir stock</a></li>
          </ul>
        </div>
      </li>
    </ul>
  </li>

  <li class="no-padding">
    <ul class="collapsible collapsible-accordion">
      <li>
        <a class="collapsible-header">Departamentos<i class="material-icons">arrow_drop_down</i></a>
        <div class="collapsible-body">
          <ul>
            <li><?= anchor_popup('Sistemactrl/nuevoDpto/1', 'nuevoDpto', $atts) ?></li>
            <li><a class="waves-effect" style="text-decoration: none;" href="<?=site_url('Sistemactrl/verDpto')?>">Ver lista de departamentos</a></li>
          </ul>
        </div>
      </li>
    </ul>
  </li>

  <li class="no-padding">
    <ul class="collapsible collapsible-accordion">
      <li>
        <a class="collapsible-header">Almacenes<i class="material-icons">arrow_drop_down</i></a>
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
        <a class="collapsible-header">Proveedores<i class="material-icons">arrow_drop_down</i></a>
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
        <a class="collapsible-header">clientes<i class="material-icons">arrow_drop_down</i></a>
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
        <a class="collapsible-header">Administrar biomédicos<i class="material-icons">arrow_drop_down</i></a>
        <div class="collapsible-body">
          <ul>
            <li><?= anchor_popup('Sistemactrl/nuevoBio/1', 'Nuevo Biomedico', $atts) ?></li>
            <li><a class="waves-effect" style="text-decoration: none;" href="<?=site_url('Sistemactrl/verBio')?>">Ver Biomedicos</a> </li>
          </ul>
        </div>
      </li>
    </ul>
  </li>

  <li class="no-padding">
    <ul class="collapsible collapsible-accordion">
      <li>
        <a class="collapsible-header">Informes<i class="material-icons">arrow_drop_down</i></a>
        <div class="collapsible-body">
          <ul>
            <li><a href="#!">First</a></li>
            <li><a href="#!">Second</a></li>
            <li><a href="#!">Third</a></li>
            <li><a href="#!">Fourth</a></li>
          </ul>
        </div>
      </li>
    </ul>
  </li>

  <li class="no-padding">
    <ul class="collapsible collapsible-accordion">
      <li>
        <a class="collapsible-header">Sistema<i class="material-icons">arrow_drop_down</i></a>
        <div class="collapsible-body">
          <ul>
            <li><a class="waves-effect" style="text-decoration: none;" href="<?=site_url('Sistemactrl/cerrarSesion')?>">Cerrar Sesion</a></li>
          </ul>
        </div>
      </li>
    </ul>
  </li>

</ul>

<nav>
  <div class="nav-wrapper">
    <a href="#" class="brand-logo">Logo</a>
    <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
  </div>
</nav>
