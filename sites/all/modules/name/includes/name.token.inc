<?php
// $Id: name.token.inc,v 1.1.2.2 2010/10/02 21:56:23 aland Exp $

/**
 * @file
 * Provides the hooks required for Token module integration.
 */

/**
 * Implementation of hook_token_list().
 */
function _name_token_list($type = 'all') {
  $tokens = array();
  $tokens['name']['formatted'] = t('default - depreciated');
  $tokens['name']['default'] = t('default');
  $tokens['name']['raw'] = t('default - raw');
  $tokens['name']['plain'] = t('default - plain');
  foreach (name_get_custom_format_options() as $machine_name => $name_title) {
    $tokens['name']['formatted-' . $machine_name] = t('%title', array('%title' => $name_title));
    $tokens['name']['formatted-' . $machine_name . '-raw'] = t('%title - raw', array('%title' => $name_title));
    $tokens['name']['formatted-' . $machine_name . '-plain'] = t('%title - plain', array('%title' => $name_title));
  }

  foreach (_name_translations() as $key => $title) {
    $tokens['name'][$key . '-formatted'] = t('%part - depreciated', array('%part' => $title));
    $tokens['name'][$key] = t('%part', array('%part' => $title));
    $tokens['name'][$key . '-raw'] = t('%part - raw', array('%part' => $title));
    $tokens['name'][$key . '-plain'] = t('%part - plain', array('%part' => $title));
  }

  return $tokens;
}

/**
 * Implementation of hook_token_values().
 */
function _name_token_values($type, $object = NULL) {
  $item = $object[0];

  $name_components = array();
  foreach (_name_translations() as $key => $title) {
    if (!empty($item[$key])) {
      $name_components[$key] = $item[$key];
    }
    else {
      $name_components[$key] = '';
    }
  }
  $default = name_format($name_components, name_settings('default_format'), array('object' => $object, 'type' => 'node'));
  $tokens['raw'] = $default;
  $tokens['plain'] = strip_tags($default);
  $tokens['formatted'] = $tokens['default'] = check_plain($default);

  foreach (name_get_custom_format_options() as $machine_name => $name_title) {
    $format = name_get_format_by_machine_name($machine_name);
    $formated_name = name_format($name_components, $format, array('object' => $object, 'type' => 'node'));
    $tokens['formatted-' . $machine_name] = check_plain($formated_name);
    $tokens['formatted-' . $machine_name . '-plain'] = strip_tags($formated_name);
    $tokens['formatted-' . $machine_name . '-raw'] = $formated_name;
  }
  foreach (_name_translations() as $key => $title) {
    $tokens[$key . '-raw']       = $name_components[$key];
    $tokens[$key] = $tokens[$key . '-formatted'] = check_plain($name_components[$key]);
    $tokens[$key . '-plain']     =  strip_tags($name_components[$key]);
  }

  return $tokens;
}
