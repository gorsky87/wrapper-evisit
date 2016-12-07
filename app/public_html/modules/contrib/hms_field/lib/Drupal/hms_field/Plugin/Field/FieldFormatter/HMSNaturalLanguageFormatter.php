<?php

/**
 * @file
 * Contains \Drupal\hms_field\Plugin\field\formatter\HMSNaturalLanguageFormatter.
 */

namespace Drupal\hms_field\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;

/**
 * Plugin implementation of the 'hms_natural_language_formatter' formatter.
 *
 * @FieldFormatter(
 *   id = "hms_natural_language_formatter",
 *   label = @Translation("HMS Natural language"),
 *   field_types = {
 *     "hms"
 *   },
 *   settings = {
 *     "display_formats" = {
 *       "w",
 *       "d",
 *       "h",
 *       "m",
 *       "s"
 *     },
 *     "separator" = ", ",
 *     "last_separator" = " and "
 *   }
 * )
 */
class HMSNaturalLanguageFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, array &$form_state) {
    $elements = array();

    $options = array();
    $factors = _hms_factor_map(TRUE);
    $order = _hms_factor_map();
    arsort($order, SORT_NUMERIC);
    foreach ($order as $factor => $info) {
      $options[$factor] = t($factors[$factor]['label multiple']);
    }
    $elements['display_formats'] = array(
      '#type' => 'checkboxes',
      '#title' => t('Display fragments'),
      '#options' => $options,
      '#description' => t('Formats that are displayed in this field'),
      '#default_value' => $this->getSetting('display_formats'),
      '#required' => TRUE,
    );
    $elements['separator'] = array(
      '#type' => 'textfield',
      '#title' => t('Separator'),
      '#description' => t('Separator used between fragments'),
      '#default_value' => $this->getSetting('separator'),
      '#required' => TRUE,
    );
    $elements['last_separator'] = array(
      '#type' => 'textfield',
      '#title' => t('Last separator'),
      '#description' => t('Separator used between the last 2 fragments'),
      '#default_value' => $this->getSetting('last_separator'),
      '#required' => FALSE,
    );
    return $elements;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = array();

    $factors = _hms_factor_map(TRUE);
    $fragments = $this->getSetting('display_formats');
    $fragment_list = array();
    foreach ($fragments as $fragment) {
      if ($fragment) {
        $fragment_list[] = t($factors[$fragment]['label multiple']);
      }
    }
    $summary[] = t('Displays: @display', array('@display' => implode(', ', $fragment_list)));
    $summary[] = t('Separator: \'@separator\'', array('@separator' => $this->getSetting('separator')));
    if (strlen($this->getSetting('last_separator'))) {
      $summary[] = t('Last Separator: \'@last_separator\'', array('@last_separator' => $this->getSetting('last_separator')));
    }

    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items) {
    $element = array();

    foreach ($items as $delta => $item) {
      $element[$delta]['#theme'] = 'hms_natural_language';
      $element[$delta]['#value'] = $item->value;
      $element[$delta]['#format'] = '';
      foreach ($this->getSetting('display_formats') as $fragment) {
        if ($fragment) {
          $element[$delta]['#format'] .= ':' . $fragment;
        }
      }
      if (!strlen($element[$delta]['#format'])) {
        $element[$delta]['#format'] = implode(':', array_keys(_hms_factor_map(TRUE)));
      }
      else {
        $element[$delta]['#format'] = substr($element[$delta]['#format'], 1);
      }
      $element[$delta]['#separator'] = $this->getSetting('separator');
      $element[$delta]['#last_separator'] = $this->getSetting('last_separator');
    }

    return $element;
  }
}

