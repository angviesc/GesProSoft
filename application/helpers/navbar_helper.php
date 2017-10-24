<?php

function Crear_menu($arr_menu){
  $atts = array( 'width' => 800, 'height' => 700,
                 'scrollbars' => 'yes', 'status' => 'yes',
                 'resizable' => 'yes', 'screenx' => 100,
                 'screeny' => 100, 'window_name' => '_blank');


  $idrop = 1;
  $drop = false;
  $menu = '<ul>';
  while ($item = current($arr_menu)) {
    if (is_array($item)){
      $menu .= '<li><a href="#">'.key($arr_menu).'</a></li>';
      while ($subitem = current($item)){
        if ($drop == false){
          $menu .= '<ul>';
          $drop = true;
        }
        if (is_array($subitem)){
          $menu .= '<li>'.anchor_popup($subitem['popUp'], key($item), $atts).'</li>';
        }else{
          $menu .= '<li><a href="'.$subitem.'">-'.key($item).'</a></li>';
        }
        next($item);
      }
      $menu .= '</ul>';
      $idrop++;
    }else{
      $menu .= '<li><a href="'.$item.'">'.key($arr_menu).'</a></li>';
    }
    $drop = false;
    next($arr_menu);
  }
  $menu .= '</ul>';

  return $menu;
}

function Crear_menuMaterial($usuario, $arr_menu){
  $atts = array( 'width' => 800, 'height' => 700,
                 'scrollbars' => 'yes', 'status' => 'yes',
                 'resizable' => 'yes', 'screenx' => 100,
                 'screeny' => 100, 'window_name' => '_blank');

  $idrop = 1;
  $drop = false;
  $menu = '<header>';
  #Armamos el drop para escritorio
  while ($item = current($arr_menu)) {
    if (is_array($item)){
      if (key($item) != 'popUp'){
        while ($subitem = current($item)){
          if ($drop == false){
            $menu .= '<ul id="dropdown'.$idrop.'" class="dropdown-content">';
            $drop = true;
          }
          if (is_array($subitem)){
            $menu .= '<li>'.anchor_popup($subitem['popUp'], key($item), $atts).'</li>';
          }else{
            $menu .= '<li><a href="'.$subitem.'">'.key($item).'</a></li>';
          }
          next($item);
        }
        $menu .= '</ul>';
        $idrop++;
      }
    }
    $drop = false;
    next($arr_menu);
  }
  $idrop = 1;
  reset($arr_menu);
#Armamos el drop para Movil
  while ($item = current($arr_menu)) {
    if (is_array($item)){
      if (key($item) != 'popUp'){
        while ($subitem = current($item)) {
          if ($drop == false){
            $menu .= '<ul id="drop_movil'.$idrop.'" class="dropdown-content">';
            $drop = true;
          }
          if (is_array($subitem)){
            $menu .= '<li>'.anchor_popup($subitem['popUp'], key($item), $atts).'</li>';
          }else{

            $menu .= '<li><a href="'.$subitem.'">'.key($item).'</a></li>';
          }
          next($item);
        }
        $idrop++;
        $menu .= '</ul>';        
      }
    }
    $drop = false;
    next($arr_menu);
  }
  $idrop = 1;
  reset($arr_menu);
  //echo $menu;  exit;
  $menu .= '<nav>
    <div class="nav-wrapper blue darken-4">
    <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
    <ul class="right hide-on-med-and-down">';
    //<a href="#!" class="brand-logo"><img class="responsive-img" style="width: 150px; padding-top: 3px; padding-left: 2px;" src="'.base_url('assets/img/UNAM_ENES_blanco.png').'" alt=""></a>

//<div class="marco"><a href="#" class="brand-logo center hide-on-med-and-down">'.$usuario.'</a></div>
//<div class="brand-logo center hide-on-med-and-down marco">'.$usuario.'</div>

    while ($item = current($arr_menu)) {

      if (is_array($item)){
        if (key($item) == 'popUp'){
          $menu .= '<li>'.anchor_popup($item['popUp'], key($arr_menu), $atts).'</li>';
        }else{
          $menu .= '<li><a class="dropdown-button" href="#!" data-activates="dropdown'.$idrop.'">'.key($arr_menu).'<i class="material-icons right">arrow_drop_down</i></a></li>';
          $idrop++;
        }
      }else
          $menu .= '<li><a href="'.$item.'">'.key($arr_menu).'</a></li>';
      next($arr_menu);
      }
    $idrop = 1;
    reset($arr_menu);
    $menu .= '</ul><ul class="side-nav" id="mobile-demo"><li><span class="black-text" style="padding-left: 20px;">'.$usuario.'</span></li><li><div class="divider"></div></li>';
    while ($item = current($arr_menu)) {
      if (is_array($item)){
        if (key($item) == 'popUp'){
          $menu .= '<li>'.anchor_popup($item['popUp'], key($arr_menu), $atts).'</li>';
        }else{
          $menu .= '<li><a class="dropdown-button" href="#!" data-activates="drop_movil'.$idrop.'">'.key($arr_menu).'<i class="material-icons right">arrow_drop_down</i></a></li>';
          $idrop++;
        }
      }else
          $menu .= '<li><a href="'.$item.'">'.key($arr_menu).'</a></li>';
      next($arr_menu);
      }
    $menu .= '</ul>
            </div>
          </nav>
        </header>';

  return $menu;
}
