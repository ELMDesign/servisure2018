<?php

/**
 * Implements hook_form_alter().
 * @param $form
 * @param $form_state
 * @param $form_id
 */
function servisure_theme_form_alter(&$form, &$form_state, $form_id) {
  // Sexy submit buttons
  if (!empty($form['actions']) && !empty($form['actions']['submit'])) {
    $form['actions']['submit']['#attributes']['class'][] = 'success';
    $form['actions']['submit']['#attributes']['class'][] = 'button';
    $form['actions']['submit']['#attributes']['class'][] = 'radius';
  }

  if (strpos($form_id, 'contact_message_') !== FALSE) {
    $form['actions']['preview']['#access'] = FALSE;
  }
}

 /** Implements template_preprocess_form().
 */
function input__submit_preprocess_form(&$variables) {
  $variables['form']['actions']['reset'] = [
    '#type' => 'html_tag',
    '#tag' => 'input',
    '#attributes' => [
      'class' => 'button',
      'type' => 'reset',
      'value' => 'Reset',
    ],
  ];
}
