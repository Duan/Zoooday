<?php
// $Id: admin_dashboard.theme.inc,v 1.2 2010/05/13 14:05:59 skilip Exp $

/**
 * Theme function for the dashboard
 */
function theme_admin_dashboard($menu) {
  // Menu items
  $output[] = '
  <div id="temp_admin_dashboard_menu">';
  $output[] = '<div id="admin_dashboard_menuitems">';
  // Render every menu item
  foreach($menu as $value) {
    // Skip hidden menu items.
    if ($value['link']['hidden']) {
      continue;
    }

    $i++;  
    $title = $value['link']['options']['attributes']['title'];
    $icon = $value['link']['options']['menu_icon']['path'];
    $img = ($icon) ? theme('image', $icon, $title, $title, array(), FALSE) : '';

    $output[] = '  <div class="admin_dashboard_menuitem" id="admin_dashboard_menuitem_'.$i.'">';

    // Position 50% 
    $output[] = '    <div class="admin_dashboard_menuitem_text_position">';

    // Icon tekst
    $output[] = '      <div class="admin_dashboard_menuitem_icontekst"><span>'.$value['link']['title'].'</span></div>';
    $output[] = '    </div>';

    // Icon
    $output[] = '    '. l($img, $value['link']['href'], array('attributes' => array('class' => 'admin_dashboard_menuitem_icon', 'title' => $title), 'html' => TRUE));
    if (!empty($value['below'])) {
      $output[] = theme('admin_dashboard_submenu', $value['below']);
    }
    $output[] = '  </div>';
  }
  $output[] = '</div>';
  $output[] = '</div>';
  return join("\n", $output);
}

/**
 * Theme an ul sub-menu 
 */
function theme_admin_dashboard_submenu($items) {
  $output[] = '<ul>';
  foreach($items as $item) {
    $output[] = '  <li>';
    $output[] = '    <div class="sub-menu-wrapper">';
    $output[] = '      <div class="sub-menu-mid">';
    $output[] = '        '. l($item['link']['title'], $item['link']['href'], array('attributes' => array('title' => $item['link']['options']['attributes']['title'])));
    $output[] = '      <div class="sub-menu-right"></div></div>';
    $output[] = '    </div>';
    if ($item['below']) $output[] = theme('admin_dashboard_submenu', $item['below']);
    $output[] = '  </li>';
  }
  $output[] = '</ul>';
  return join("\n", $output);
}
