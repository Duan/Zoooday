<?php
// $Id: name.admin.inc,v 1.1.2.5 2010/10/01 00:29:14 aland Exp $

/**
 * @file
 * General administration functions.
 */

/**
 * Form builder function for module settings.
 */
function name_admin_settings_form() {
  $form['name_settings'] = array('#tree' => TRUE);
  $settings = name_settings();

  $form['name_settings']['default_format'] = array(
    '#type' => 'textfield',
    '#title' => t('Default name format'),
    '#default_value' => $settings['default_format'],
    '#description' => t('See help on drupal.org for more info.'),
  );
  $form['name_settings']['sep1'] = array(
    '#type' => 'textfield',
    '#title' => t('Separator 1 replacement token'),
    '#default_value' => $settings['sep1'],
  );
  $form['name_settings']['sep2'] = array(
    '#type' => 'textfield',
    '#title' => t('Separator 2 replacement token'),
    '#default_value' => $settings['sep2'],
  );
  $form['name_settings']['sep3'] = array(
    '#type' => 'textfield',
    '#title' => t('Separator 3 replacement token'),
    '#default_value' => $settings['sep3'],
  );
  // As the fieldset does not have the #input flag, this is not saved.
  $form['name_format_help'] = _name_get_name_format_help_form();

  return system_settings_form($form);
}

/**
 * Lists the known custom formats.
 */
function name_list_custom_formats() {
  $header = array(t('Name'), t('System code'), t('Format'), t('Examples'), t('Actions'));
  $rows = array();

  $example_names = array(
    1 => array(
      'title' => 'Mr',
      'given' => 'Joe',
      'middle' => 'John Peter Mark',
      'family' => 'Doe',
      'generational' => 'Jnr.',
      'credentials' => 'B.Sc., Ph.D.',
    ),
    2 => array(
      'title' => '',
      'given' => 'JOAN',
      'middle' => 'SUE',
      'family' => 'DOE',
      'generational' => '',
      'credentials' => '',
    ),
    3 => array(
      'title' => '',
      'given' => 'Prince',
      'middle' => '',
      'family' => '',
      'generational' => '',
      'credentials' => '',
    ),

  );
  $default_format = array(
    'ncfid' => 0,
    'name' => t('Default'),
    'machine_name' => 'default',
    'format' => name_settings('default_format'),
  );
  $custom_formats = array('0' => $default_format) + name_get_custom_formats();

  foreach ($custom_formats as $ncfid => $tag) {
    $row = array();
    $row[] = l($tag['name'], 'admin/settings/name/' . ($ncfid ? $ncfid : 'settings'));
    $row[] = $tag['machine_name'];
    $row[] = check_plain($tag['format']);

    $examples = array();
    foreach ($example_names as $index => $example_name) {
      $formatted = check_plain(name_format($example_name, $tag['format']));
      if (empty($formatted)) {
        $formatted = '<em>&lt;&lt;empty&gt;&gt;</em>';
      }
      $examples[] = $formatted . " <sup>{$index}</sup>";
    }
    $row[] = implode('<br/>', $examples);

    if ($ncfid) {
      $links = array();
      $links[] = l(t('Edit'), 'admin/settings/name/' . $ncfid);
      $links[] = l(t('Delete'), 'admin/settings/name/' . $ncfid . '/delete');
      $row[] = implode('&nbsp;&nbsp;&nbsp;&nbsp;', $links);
    }
    else {
      $row[] = '';
    }
    $rows[] = $row;
  }

  $help = '<p><strong>' . t('The three examples are for the following users:') . '</strong><p>';
  $help_items = array();
  foreach ($example_names as $example_name) {
    $help_items[] = t('The example %user has the following components; title is "%title", given is "%given", middle is "%middle", family is "%family", generational is "%generational", credentials are "%credentials"',
    array(
      '%user' => name_format($example_name, 't+ g+ m+ f+ s+ c'),
      '%title' => $example_name['title'] ? $example_name['title'] : '<<empty>>',
      '%given' => $example_name['given'] ? $example_name['given'] : '<<empty>>',
      '%middle' => $example_name['middle'] ? $example_name['middle'] : '<<empty>>',
      '%family' => $example_name['family'] ? $example_name['family'] : '<<empty>>',
      '%generational' => $example_name['generational'] ? $example_name['generational'] : '<<empty>>',
      '%credentials' => $example_name['credentials'] ? $example_name['credentials'] : '<<empty>>',
    ));
  }

  $fieldset = _name_get_name_format_help_form();

  $output = theme('table', $header, $rows) . $help . theme('item_list', $help_items, NULL, 'ol') . drupal_render($fieldset);
  return $output;
}

/**
 * A helper function to generate the format string parameter help fieldset.
 */
function _name_get_name_format_help_form() {
  $form = array(
    '#type' => 'fieldset',
    '#title' => t('Format string help'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
    '#parents' => array(),
    'format_parameters' => array(
      '#value' => theme('name_format_parameter_help'),
    ),
  );
  return $form;
}

/**
 * Form callback to edit or add a new custom name format.
 */
function name_custom_formats_form($form_state, $edit = array()) {
  $edit += array(
    'ncfid' => NULL,
    'name' => '',
    'machine_name' => '',
    'format' => '',
  );

  $form = array();
  $form['ncfid'] = array(
    '#type' => 'value',
    '#value' => $edit['ncfid'],
  );
  $form['name'] = array(
    '#type' => 'textfield',
    '#title' => t('Name'),
    '#default_value' => $edit['name'],
    '#maxlength' => 255,
    '#required' => TRUE,
  );
  $form['machine_name'] = array(
    '#title' => t('Machine readable name'),
    '#description' => t('The unique machine readable name for this format. This can only contain lowercase letters, numbers and underscores. The keyword %default is reserved for internal usage.', array('%default' => 'default' /* do not translate */)),
    '#type' => 'textfield',
    '#required' => TRUE,
    '#default_value' => $edit['machine_name'],
  );
  $form['format'] = array(
    '#type' => 'textfield',
    '#title' => t('Format'),
    '#default_value' => $edit['format'],
    '#maxlength' => 255,
    '#required' => TRUE,
  );

  $form['name_format_help'] = _name_get_name_format_help_form();

  $form['submit'] = array(
    '#type' => 'submit',
    '#value' => t('Save'),
  );
  if (!empty($edit['ncfid'])) {
    $form['delete'] = array(
      '#type' => 'submit',
      '#value' => t('Delete'),
    );
  }
  return $form;
}


/**
 * Custom validation for name_custom_formats_form().
 */
function name_custom_formats_form_validate($form, &$form_state) {
  $values = $form_state['values'];
  // Ensure that the name is unique
  if (empty($values['ncfid'])) {
    $count = db_result(db_query("SELECT count(*) FROM {name_custom_format} WHERE name = '%s'", $values['name']));
    $mcount = db_result(db_query("SELECT count(*) FROM {name_custom_format} WHERE machine_name = '%s'", $values['machine_name']));
  }
  else {
    $count = db_result(db_query("SELECT count(*) FROM {name_custom_format} WHERE name = '%s' AND ncfid <> %d", $values['name'], $values['ncfid']));
    $mcount = db_result(db_query("SELECT count(*) FROM {name_custom_format} WHERE machine_name = '%s' AND ncfid <> %d", $values['machine_name'], $values['ncfid']));
  }
  if ($count) {
    form_set_error('name', t('The name you have chosen is already in use.'));
  }
  if ($mcount) {
    form_set_error('machine_name', t('The machine readable name you have chosen is already in use.'));
  }
  elseif ($values['machine_name'] == 'default') {
    form_set_error('machine_name', t('The machine readable name you have chosen is reserved.'));
  }

  // Parse the string for un-matched backets.
  // TODO
//  if ($format = $values['format']) {
//    $format = _name_custom_formats_form_validate_format(str_replace('\\\\', "\t", $format));
//    $format = str_replace(array('\\(', '\\)'), array('', ''), $format);
//    if (strpos($format, '(') !== FALSE || strpos($format, ')')) {
//      // Just a warning.
//      drupal_set_message(t('There was one or more un-matched and un-escaped brackets in the format string %format.', array('%format' => $values['format'])), 'warning');
//    }
//  }
}

/**
 * Submit handler for name_custom_formats_form().
 */
function name_custom_formats_form_submit($form, &$form_state) {
  $values = $form_state['values'];
  if (empty($values['ncfid'])) {
    drupal_write_record('name_custom_format', $values);
    $message = 'Custom format %name has been created.';
  }
  else {
    drupal_write_record('name_custom_format', $values, 'ncfid');
    $message = 'Custom format %name has been updated.';
  }
  drupal_set_message(t($message, array('%name' => $values['name'])));

  $form_state['redirect'] = 'admin/settings/name';
}

/**
 * Page to edit a custom format.
 */
function name_custom_format_edit($ncfid) {
  if ((isset($_POST['op']) && $_POST['op'] == t('Delete')) || isset($_POST['confirm'])) {
    return drupal_get_form('name_custom_format_delete_form', $ncfid);
  }

  if ($name = db_fetch_array(db_query("SELECT * FROM {name_custom_format} WHERE ncfid = %d", $ncfid))) {
    return drupal_get_form('name_custom_formats_form', $name);
  }
  drupal_not_found();
}

/**
 * Custom name format deletion form.
 */
function name_custom_format_delete_form($form_state, $ncfid) {
  $name = db_fetch_array(db_query("SELECT * FROM {name_custom_format} WHERE ncfid = %d", $ncfid));

  if (!$name) {
    drupal_set_message(t('The custom format could not be found.'), 'error');
    drupal_goto('admin/settings/name');
  }
  $form = array();
  $form['ncfid'] = array(
    '#type' => 'value',
    '#value' => $name['ncfid'],
  );
  $form['#name'] = $name;
  return confirm_form(
    $form,
    t('Are you sure you want to delete the custom format %name ("%format")?',
      array('%name' => $name['name'], '%format' => $name['format'])
    ),
    'admin/settings/name',
    t('This action cannot be undone.'),
    t('Delete'),  t('Cancel')
  );
}

/**
 * Submit handler for name_custom_format_delete_form().
 */
function name_custom_format_delete_form_submit($form, &$form_state) {
  db_query("DELETE FROM {name_custom_format} WHERE ncfid = %d", $form_state['values']['ncfid']);
  drupal_set_message(t('The custom name format %name was deleted.',
      array('%name' => $form['#name']['name'])));
  $form_state['redirect'] = 'admin/settings/name';
}

/**
 * Themes the instance settings of the name component into a nice table, rather
 * than a long list of individual elements.
 */
function _name_field_instance_settings_pre_render($form) {

  $form['instance_properties'] = array(
    '#prefix' => '<table>',
    '#suffix' => '</table>',
    '#weight' => 1,
    'thead' => array(
      '#prefix' => '<thead><tr><th>' . t('Field') . '</th>',
      '#suffix' => '</tr></thead>',
      '#weight' => 0,
    ),
    'tbody' => array(
      '#prefix' => '<tbody>',
      '#suffix' => '</tbody>',
      '#weight' => 1,
      'title_display' => array(
        '#prefix' => '<tr><td><strong>' . t('Title display') . ' <sup>1</sup></strong></td>',
        '#suffix' => '</tr>',
        '#weight' => 1,
      ),
      'size' => array(
        '#prefix' => '<tr><td><strong>' . t('HTML size') . ' <sup>2</sup></strong></td>',
        '#suffix' => '</tr>',
        '#weight' => 2,
      ),
      'inline_css_enabled' => array(
        '#prefix' => '<tr><td><strong>' . t('Inline style') . ' <sup>3</sup></strong></td>',
        '#suffix' => '</tr>',
        '#weight' => 3,
      ),
    ),
    'tfoot' => array(
      '#value' => '<tfoot><tr><td colspan="6"><ol>'
        . '<li>'.  t('The title display controls how the label of the name component is displayed in the form. "%above" is the standard title; "%below" is the standard description; "%hidden" removes the label.',
                      array('%above' => t('above'), '%below' => t('below'), '%hidden' => t('hidden'))) . '</li>'
        . '<li>'.  t('The HTML size property tells the browser what the width of the field should be when it is rendered. This gets overriden by the themes CSS properties. This must be between 1 and 255.') . '</li>'
        . '<li>'.  t('The inline style property tells the browser what the width of the field <strong>really</strong> should be when it is rendered. This is dynamically calculated from the HTML size property.') . '</li>'
        . '</ol></td></tr></tfoot>' ,
      '#weight' => 2,
    ),
    'extra_fields' => array(
      '#weight' => 3,
    ),
  );

  $i = 0;
  foreach (_name_translations() as $key => $title) {
    // Adds the table header for the particullar field.
    $form['instance_properties']['thead'][$key]['#value'] = '<th>' . $title . '</th>';
    $form['instance_properties']['thead'][$key]['#weight'] = ++$i;

    // Strip the title & description.
    unset($form['size'][$key]['#description']);
    unset($form['size'][$key]['#title']);
    $form['size'][$key]['#size'] = 5;

    unset($form['title_display'][$key]['#description']);
    unset($form['title_display'][$key]['#title']);

    unset($form['inline_css_enabled'][$key]['#description']);
    unset($form['inline_css_enabled'][$key]['#title']);

    // Moves the size element into the table.
    $form['instance_properties']['tbody']['size'][$key] = $form['size'][$key];
    $form['instance_properties']['tbody']['size'][$key]['#prefix'] = '<td>';
    $form['instance_properties']['tbody']['size'][$key]['#suffix'] = '</td>';
    $form['instance_properties']['tbody']['size'][$key]['#weight'] = $i;

    $form['instance_properties']['tbody']['title_display'][$key] = $form['title_display'][$key];
    $form['instance_properties']['tbody']['title_display'][$key]['#prefix'] = '<td>';
    $form['instance_properties']['tbody']['title_display'][$key]['#suffix'] = '</td>';
    $form['instance_properties']['tbody']['title_display'][$key]['#weight'] = $i;

    $form['instance_properties']['tbody']['inline_css_enabled'][$key] = $form['inline_css_enabled'][$key];
    $form['instance_properties']['tbody']['inline_css_enabled'][$key]['#prefix'] = '<td>';
    $form['instance_properties']['tbody']['inline_css_enabled'][$key]['#suffix'] = '</td>';
    $form['instance_properties']['tbody']['inline_css_enabled'][$key]['#weight'] = $i;

    // Clean up the leftovers.
    unset($form['size'][$key]);
    $form['size']['#access'] = FALSE;

    unset($form['title_display'][$key]);
    $form['title_display']['#access'] = FALSE;

    unset($form['inline_css_enabled'][$key]);
    $form['inline_css_enabled']['#access'] = FALSE;

  }

  // Move the additional options under the table.
  $form['extra_fields'] = array(
    '#weight' => 2,
  );
  $form['inline_css']['#weight'] = 0;
  $form['title_field']['#weight'] = 1;
  $form['generational_field']['#weight'] = 2;
  $form['extra_fields']['inline_css'] = $form['inline_css'];
  $form['extra_fields']['title_field'] = $form['title_field'];
  $form['extra_fields']['generational_field'] = $form['generational_field'];
  unset($form['title_field']);
  unset($form['inline_css']);
  unset($form['generational_field']);

  return $form;
}

/**
 * Themes the global field settings of the name component into a nice table,
 * rather than a long list of individual elements.
 */
function _name_field_settings_pre_render($form) {

  $warning = t('<strong>Warning! Changing this setting after data has been created could result in the loss of data!</strong>');

  $form['field_properties'] = array(
    '#prefix' => '<table>',
    '#suffix' => '</table>',
    '#weight' => 1,
    'thead' => array(
      '#prefix' => '<thead><tr><th>' . t('Field') . '</th>',
      '#suffix' => '</tr></thead>',
      '#weight' => 0,
    ),
    'tbody' => array(
      '#prefix' => '<tbody>',
      '#suffix' => '</tbody>',
      '#weight' => 1,
      'components' => array(
        '#prefix' => '<tr><td><strong>' . t('Components') . ' <sup>1</sup></strong></td>',
        '#suffix' => '</tr>',
        '#weight' => 1,
      ),
      'minimum_components' => array(
        '#prefix' => '<tr><td><strong>' . t('Minimum components') . ' <sup>2</sup></strong></td>',
        '#suffix' => '</tr>',
        '#weight' => 2,
      ),
      'max_length' => array(
        '#prefix' => '<tr><td><strong>' . t('Maximum length') . ' <sup>3</sup></strong></td>',
        '#suffix' => '</tr>',
        '#weight' => 3,
      ),
      'labels' => array(
        '#prefix' => '<tr><td><strong>' . t('Labels') . ' <sup>4</sup></strong></td>',
        '#suffix' => '</tr>',
        '#weight' => 4,
      ),
      'sort_options' => array(
        '#prefix' => '<tr><td><strong>' . t('Sort options') . ' <sup>5</sup></strong></td>',
        '#suffix' => '</tr>',
        '#weight' => 5,
      ),

    ),
    'tfoot' => array(
      '#value' => '<tfoot><tr><td colspan="6"><ol>'
        . '<li>'. t('Only selected components will be activated on this field. All non-selected components / component settings will be ignored.')
        . '<br/>'. $warning .'</li>'
        . '<li>'. t('The minimal set of components required before considered the name field to be incomplete.') . '</li>'
        . '<li>'. t('The maximum length of the field in characters. This must be between 1 and 255.')
        . '<br/>'. $warning .'</li>'
        . '<li>'. t('The labels are used to distinguish the fields. You can use the special label "!tag" to hide this.', array('!tag' => '<none>')) . '</li>'
        . '<li>'. t('This enables sorting on the options after the vocabulary terms are added and duplicate values are removed.') . '</li>'
        . '</ol></td></tr></tfoot>',
      '#weight' => 2,
    ),
  );

  $i = 0;
  foreach (_name_translations() as $key => $title) {
    // Adds the table header for the particullar field.
    $form['field_properties']['thead'][$key]['#value'] = '<th>' . $title . '</th>';
    $form['field_properties']['thead'][$key]['#weight'] = ++$i;

    // Strip the title & description.
    unset($form['components'][$key]['#description']);
    unset($form['components'][$key]['#title']);

    unset($form['minimum_components'][$key]['#description']);
    unset($form['minimum_components'][$key]['#title']);

    unset($form['max_length'][$key]['#description']);
    unset($form['max_length'][$key]['#title']);
    $form['max_length'][$key]['#size'] = 10;

    unset($form['labels'][$key]['#description']);
    unset($form['labels'][$key]['#title']);
    $form['labels'][$key]['#size'] = 10;

    if (isset($form['sort_options'][$key])) {
      unset($form['sort_options'][$key]['#description']);
      unset($form['sort_options'][$key]['#title']);
    }

    // Moves the elements into the table.
    $form['field_properties']['tbody']['components'][$key] = $form['components'][$key];
    $form['field_properties']['tbody']['components'][$key]['#prefix'] = '<td>';
    $form['field_properties']['tbody']['components'][$key]['#suffix'] = '</td>';
    $form['field_properties']['tbody']['components'][$key]['#weight'] = $i;

    $form['field_properties']['tbody']['minimum_components'][$key] = $form['minimum_components'][$key];
    $form['field_properties']['tbody']['minimum_components'][$key]['#prefix'] = '<td>';
    $form['field_properties']['tbody']['minimum_components'][$key]['#suffix'] = '</td>';
    $form['field_properties']['tbody']['minimum_components'][$key]['#weight'] = $i;

    $form['field_properties']['tbody']['max_length'][$key] = $form['max_length'][$key];
    $form['field_properties']['tbody']['max_length'][$key]['#prefix'] = '<td>';
    $form['field_properties']['tbody']['max_length'][$key]['#suffix'] = '</td>';
    $form['field_properties']['tbody']['max_length'][$key]['#weight'] = $i;

    $form['field_properties']['tbody']['labels'][$key] = $form['labels'][$key];
    $form['field_properties']['tbody']['labels'][$key]['#prefix'] = '<td>';
    $form['field_properties']['tbody']['labels'][$key]['#suffix'] = '</td>';
    $form['field_properties']['tbody']['labels'][$key]['#weight'] = $i;

    if (isset($form['sort_options'][$key])) {
    $form['field_properties']['tbody']['sort_options'][$key] = $form['sort_options'][$key];
    }
    else {
      $form['field_properties']['tbody']['sort_options'][$key] = array('#value' => '&nbsp;');
    }
    $form['field_properties']['tbody']['sort_options'][$key]['#prefix'] = '<td>';
    $form['field_properties']['tbody']['sort_options'][$key]['#suffix'] = '</td>';
    $form['field_properties']['tbody']['sort_options'][$key]['#weight'] = $i;

    // Clean up the leftovers.
    unset($form['components'][$key]);
    $form['components']['#access'] = FALSE;

    unset($form['minimum_components'][$key]);
    $form['minimum_components']['#access'] = FALSE;

    unset($form['max_length'][$key]);
    $form['max_length']['#access'] = FALSE;

    unset($form['labels'][$key]);
    $form['labels']['#access'] = FALSE;

    if (isset($form['sort_options'][$key])) {
      unset($form['sort_options'][$key]);
      $form['sort_options']['#access'] = FALSE;
    }
  }

  // Move the additional options under the table.
  $form['extra_fields'] = array(
    '#weight' => 2,
  );
  $form['title_options']['#weight'] = 0;
  $form['generational_options']['#weight'] = 1;
  $form['extra_fields']['title_options'] = $form['title_options'];
  $form['extra_fields']['generational_options'] = $form['generational_options'];
  unset($form['title_options']);
  unset($form['generational_options']);

  return $form;
}
