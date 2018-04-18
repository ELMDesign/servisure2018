<?php

/**
 * Implements hook_form_FORM_ID_alter().
 *
 * @param $form
 *   The form.
 * @param $form_state
 *   The form state.
 */
function servisure_theme_form_system_theme_settings_alter(&$form, &$form_state) {

  $form[$key]['preview']['#access'] = FALSE;



}

/**
 * Implements template_preprocess_form().
 */
/**
 * Implements hook_preprocess_webform_actions().
 */
function CUSTOM_MODULE_preprocess_webform_actions(&$variables) {
  $variables['element']['reset'] = [
    '#type' => 'link',
    '#title' => t('Reset'),
    '#url' => Url::fromRoute('<current>'),
    '#attributes' => ['class' => ['button']],
  ];
}

/**
 * Implements hook_form_alter().
 */
function servisure_theme_form_system_theme_settings_alter(&$form, $form_state, $form_id) {

  // Look for any form provided by the contact module.
  // If you want to target a specific form you'll use the whole form ID
  // (e.g. Website feedback = 'contact_message_feedback_form').
  if (strpos($form_id, 'contact_message_') !== FALSE) {
    $form['actions']['preview']['#access'] = FALSE;
  }
}