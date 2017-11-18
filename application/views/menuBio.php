
  <ul id="slide-out" class="side-nav fixed z-depth-2">
    <li class="center no-padding">
      <div class="blue-grey darken-4 white-text" style="height: 180px;">
        <div class="row">
          <img style="margin-top: 5%;" width="100" height="100" src="https://kbdownload1-a.akamaihd.net/tier0/images/article/concept_fzz_zvr_sn/_accounts-profile_all.svg" class="circle responsive-img" />

          <p style="margin-top: -13%;">
            USUARIO
          </p>
        </div>
      </div>
    </li>

    <li id="dash_products">
      <?= anchor_popup('Sistemactrl/nuevoBio', 'Nuevo Articulo', $atts) ?>
      <div id="dash_products_header" class="collapsible-header waves-effect"><b>-</b></div>
      <div id="dash_products_body" class="collapsible-body">
        <ul>
          <li id="products_product">
            <?= anchor_popup('Sistemactrl/nuevoDpto/1', 'nuevoDpto', $atts) ?>
            <a class="waves-effect" style="text-decoration: none;" href="<?=site_url('Sistemactrl/verDpto')?>">Ver lista de departamentos</a>
          </li>
        </ul>
      </div>
    </li>

    <li> <?= anchor_popup('Sistemactrl/nuevoBio', 'Nuevo Articulo', $atts) ?></li>

    <ul class="collapsible" data-collapsible="accordion">
      <li id="dash_users">
        <div id="dash_users_header" class="collapsible-header waves-effect"><b>Inventario</b></div>

        <div id="dash_users_body" class="collapsible-body">
          <ul>
            <li id="users_seller">
              <?= anchor_popup('Sistemactrl/nuevoBio', 'Nuevo Articulo', $atts) ?>
            </li>

            <li id="users_customer">
              <a class="waves-effect" style="text-decoration: none;" href="<?=site_url('Sistemactrl/SinFuncion')?>">Buscar articulo</a>
            </li>

            <li id="users_customer">
              <a class="waves-effect" style="text-decoration: none;" href="<?=site_url('Sistemactrl/verArticulos')?>">Ver articulos</a>
            </li>

            <li id="users_customer">
              <a class="waves-effect" style="text-decoration: none;" href="<?=site_url('Sistemactrl/verInentario')?>">Ver inventario</a>
            </li>

            <li class="divider"></li>

            <li id="users_customer">
              <a class="waves-effect" style="text-decoration: none;" href="<?=site_url('Sistemactrl/verPedidos')?>">Abrir lista de pedidos</a>
            </li>

            <li class="divider"></li>

            <li id="users_customer">
              <?= anchor_popup('Sistemactrl/venderStock', 'Vender stock', $atts) ?>
            </li>

            <li id="users_customer">
            <?= anchor_popup('Sistemactrl/nuevoBio', 'Recibir stock', $atts) ?>
            </li>

            <li id="users_customer">
            <?= anchor_popup('Sistemactrl/nuevoBio', 'Pedir stock', $atts) ?>
            </li>

            <li id="users_customer">
              <a class="waves-effect" style="text-decoration: none;" href="<?=site_url('Sistemactrl/transferirStock')?>">Transferir stock</a>
            </li>
          </ul>
        </div>
      </li>

      <li id="dash_products">
        <div id="dash_products_header" class="collapsible-header waves-effect"><b>Departamentos</b></div>
        <div id="dash_products_body" class="collapsible-body">
          <ul>
            <li id="products_product">
              <?= anchor_popup('Sistemactrl/nuevoDpto/1', 'nuevoDpto', $atts) ?>
              <a class="waves-effect" style="text-decoration: none;" href="<?=site_url('Sistemactrl/verDpto')?>">Ver lista de departamentos</a>
            </li>
          </ul>
        </div>
      </li>

      <li id="dash_products">
        <div id="dash_products_header" class="collapsible-header waves-effect"><b>Almacenes</b></div>
        <div id="dash_products_body" class="collapsible-body">
          <ul>
            <li id="products_product">
              <?= anchor_popup('Sistemactrl/nuevoAlm/1', 'Nuevo almacen', $atts) ?>
              <a class="waves-effect" style="text-decoration: none;" href="<?=site_url('Sistemactrl/verAlm')?>">Ver Almacenes</a>
            </li>
          </ul>
        </div>
      </li>

      <li id="dash_products">
        <div id="dash_products_header" class="collapsible-header waves-effect"><b>Proveedores</b></div>
        <div id="dash_products_body" class="collapsible-body">
          <ul>
            <li id="products_product">
              <?= anchor_popup('Sistemactrl/nuevoProv/1', 'Nuevo proveedor', $atts) ?>
              <a class="waves-effect" style="text-decoration: none;" href="<?=site_url('Sistemactrl/verProveedores')?>">Ver proveedor</a>
            </li>
          </ul>
        </div>
      </li>

      <li id="dash_products">
        <div id="dash_products_header" class="collapsible-header waves-effect"><b>Clientes</b></div>
        <div id="dash_products_body" class="collapsible-body">
          <ul>
            <li id="products_product">
              <?= anchor_popup('Sistemactrl/nuevoCliente/1', 'Nuevo cliente', $atts) ?>
              <a class="waves-effect" style="text-decoration: none;" href="<?=site_url('Sistemactrl/verClientes')?>">Ver clientes</a>
            </li>
          </ul>
        </div>
      </li>

      <li id="dash_products">
        <div id="dash_products_header" class="collapsible-header waves-effect"><b>Administrar Biomédicos</b></div>
        <div id="dash_products_body" class="collapsible-body">
          <ul>
            <li id="products_product">
              <?= anchor_popup('Sistemactrl/nuevoBio/1', 'Nuevo Biomedico', $atts) ?>
              <a class="waves-effect" style="text-decoration: none;" href="<?=site_url('Sistemactrl/verBio')?>">Ver Biomedicos</a>
            </li>
          </ul>
        </div>
      </li>

      <li id="dash_categories">
        <div id="dash_categories_header" class="collapsible-header waves-effect"><b>Informes</b></div>
        <div id="dash_categories_body" class="collapsible-body">
          <ul>
            <li id="categories_category">
              <a class="waves-effect" style="text-decoration: none;" href="#!">Category</a>
            </li>

            <li id="categories_sub_category">
              <a class="waves-effect" style="text-decoration: none;" href="#!">Sub Category</a>
            </li>
          </ul>
        </div>
      </li>
</ul>
</ul>

<header>
  <ul class="dropdown-content" id="user_dropdown">
    <li><a class="indigo-text" href="#!">Profile</a></li>
    <li><a class="indigo-text" href="#!">Logout</a></li>
  </ul>

  <nav class="blue-grey darken-4" role="navigation">
    <div class="nav-wrapper">
      <a data-activates="slide-out" class="button-collapse show-on-" href="#!"><img style="margin-top: 17px; margin-left: 5px;" src="https://res.cloudinary.com/dacg0wegv/image/upload/t_media_lib_thumb/v1463989873/smaller-main-logo_3_bm40iv.gif" /></a>

      <ul class="right hide-on-med-and-down">
        <li>
          <a class='right dropdown-button' href='' data-activates='user_dropdown'><i class=' material-icons'>account_circle</i></a>
        </li>
      </ul>

      <a href="#" data-activates="slide-out" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
    </div>
  </nav>

</header>
