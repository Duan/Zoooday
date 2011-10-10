<?php
// $Id: admin_dashboard.admin.inc,v 1.2 2010/09/09 07:53:03 skilip Exp $

/**
 * @file
 *
 * Include file for all administrative tasks.
 */

/**
 * AJAX callback for menu item admin_dashboard_ajax_save.
 * When a user toggles the 'auto hide' button, this function will store the user's desired setting.
 */
function admin_dashboard_ajax_save() {
  global $user;
  $p = (object) $_POST;

  variable_set("admin_dashboard_user_settings_$user->uid", array(
    'hide_on_init' => ($p->hide_on_init == 'true'),
    'at_start' => ($p->at_start == 'true'),
    'top' => $p->top,
    'position' => $p->position,
  ));
}

/**
 * Form defenition for the Admin Dashboard Settings form.
 */
function admin_dashboard_settings_form() {
  global $user;
  $settings = variable_get('admin_dashboard_user_settings_'.$user->uid, admin_dashboard_default_settings());
  $menus =  menu_get_menus();
  $current_menu = variable_get('admin_dashboard_menu', 'admin-dashboard');

  $form['menu'] = array(
    '#type' => 'select',
    '#title' => t('Menu to load into the dashboard'),
    '#default_value' => $current_menu,
    '#options' => $menus,
    '#description' => t('Here you can change the menu which you want to use for the Dashboard. You could also use the default Dashboard Menu and change it\'s items '.l(t('here'), 'admin/build/menu-customize/admin-dashboard').''),
  );  
  $form['position'] = array(
    '#type' => 'select',
    '#title' => t('Position of your dashboard'),
    '#default_value' => $settings['position'],
    '#options' => array('left' => t('Left'), 'right' => t('Right')),
    '#description' => t('The position of the dashboard, this is a user-level setting'),
  );
  $form['submit'] = array('#type' => 'submit', '#value' => t('Save'));
  $form['#submit'][] = 'admin_dashboard_settings_form_submit';
  return $form;
}

/**
 * Submit callback for the Admin Dashboard Settings form.
 */
function admin_dashboard_settings_form_submit($form, &$form_state) {
  // save menu loaded in dashboard
  variable_set('admin_dashboard_menu', $form_state['values']['menu']);

  // Position
  global $user;
  $settings = variable_get('admin_dashboard_user_settings_'.$user->uid, admin_dashboard_default_settings());
  $settings['position'] = $form_state['values']['position'];
  variable_set('admin_dashboard_user_settings_'.$user->uid, $settings);
}

/**
 * Rebuilds the Admin Dashboard menu on either installation or menu_rebuild_cache.
 */
function admin_dashboard_menu_rebuild(&$items = NULL) {
  $module_path = drupal_get_path('module', 'admin_dashboard');
  $menu_name = variable_get('admin_dashboard_menu', 'admin-dashboard');

  // If the $items variable is empty, the function is called from admin_dashboard.init
  if (!$items) {
    // Create a Dashboard menu
    $menu = array(
      'menu_name' => $menu_name,
      'title' => 'Dashboard menu',
      'description' => 'A dummy menu used by the Administration dashboard module.',
    );
    $sql = "INSERT INTO {menu_custom} (menu_name, title, description) values ('%s', '%s', '%s' )";
    db_query($sql, $menu_name, ($menu['title']), $menu['description']);

    // Crate the menu item which behaves as parent for each following menu items.
    $item = array(
      'link_path' => "admin/build/menu-customize/$menu_name",
      'router_path' => 'admin/build/menu-customize/%',
      'plid' => db_result(db_query("SELECT mlid FROM {menu_links} WHERE link_path = '%s' AND module = '%s'", 'admin/build/menu', 'system')),
      'link_title' => $menu['title'],
    );
    menu_link_save($item);

    // Define our default menu items.
    $links['admin/build/block'] = 'Blocks';
    $links['admin/build/menu'] = 'Menus';
    $links['admin/build/modules'] = 'Modules';
    $links['admin/build/themes'] = 'Themes';
    $links['node/add'] = 'Create content';
    $links['admin/content'] = 'Content management';
    $links['admin/settings'] = 'Site configuration';
    $links['admin/build'] = 'Site building';
    $links['admin/user'] = 'User management';
    $links['admin/reports'] = 'Reports';
    $links['user'] = 'My Account';
    $links['logout'] = 'Logout';

    $weight = 0;

    foreach ($links as $path => $title) {
      // Prepare a menu item and fill it with default values.
      $args = array(
        'menu_name' => $menu_name,
        'link_path' => $path,
        'link_title' => $title,
        'weight' => $weight,
        'options' => array(
          'menu_icon' => array('enable' => TRUE, 'path' => $module_path .'/images/menu_icons/'. drupal_strtolower(str_replace(' ', '-', $title)) .'.png'),
          'attributes' => array('title' => $title),
        ),
      );
      menu_link_save($args);
      $weight++;
    }
  }
  else { // The $items array is filled. This function is called from hook_menu_alter.
    // Get all top level admin menu items (e.g.: admin/content, admin/build, etc.).
    // Each found top level item is used to get all child items which are appended to the top level items in the dashboard menu.
    foreach (menu_tree_all_data($menu_name) as $dashboard_item) {
      if (preg_match("/^admin\/(\w+.)$/", $dashboard_item['link']['router_path'], $matches)) {
  
        foreach ($items as $path => $item) {
          // If the menu item hasn't been added before and is a child of the current menu item,
          // Create a new item for the dashboard menu by saving the item into the database.
          if (!db_result(db_query("SELECT mlid FROM {menu_links} WHERE menu_name = '%s' AND link_path = '%s'", $menu_name, $path)) && preg_match("/^admin\/". $matches[1] ."\/(\w+.)$/", $path)) {
            $link = array(
              'menu_name' => $menu_name,
              'link_path' => $path,
              'link_title' => $item['title'],
              'weight' => ($item['weight'] ? $item['weight'] : 0),
              'options' => array(
                'menu_icon' => array('enable' => TRUE, 'path' => $module_path .'/images/menu_icons/'. drupal_strtolower(str_replace(' ', '-', $title)) .'.png'),
                'attributes' => array('title' => $title),
              ),
            );
            menu_link_save($link);
          }
        }
      }
    }

    // Both during installation and menu_rebuild_cache,
    // we want to add all node types to our node/add menu item.
    // After installation is completed the menu is rebuild anyway, so we can place our code here.
  
    // Before adding the items, we'll delete old entries to avoid heving menu items
    // for content types which do not exist anymore.
    db_query("DELETE FROM {menu_links} WHERE menu_name = '%s' AND link_path LIKE '%s%'", $menu_name, 'node/add/');
  
    // Get the menu id of the parent menu item ('node/add').
    $plid = db_result(db_query("SELECT mlid FROM {menu_links} WHERE menu_name = '%s' AND link_path = '%s'", $menu_name, 'node/add'));
  
    foreach (node_get_types() as $key => $type) {
      // Prepare a menu item and fill it with default values.
      $item = array(
        'menu_name' => $menu_name,
        'plid' => $plid,
        'link_path' => 'node/add/'. str_replace('_', '-', $key),
        'link_title' => $type->name,
        'options' => array(
          'attributes' => array('title' => $type->description),
        ),
      );
      menu_link_save($item);
    }
  }
}
