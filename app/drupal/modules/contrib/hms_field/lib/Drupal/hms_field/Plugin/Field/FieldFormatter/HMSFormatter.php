<?php

/**
 * @file
 * Contains \Drupal\hms_field\Plugin\field\formatter\HMSFormatter.
 */

namespace Drupal\hms_field\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;

/**
 * Plugin implementation of the 'hms_default_formatter' formatter.
 *
 * @FieldFormatter(
 *   id = "hms_default_formatter",
 *   label = @Translation("HMS"),
 *   field_types = {
 *     "hms"
 *   },
 *   settings = {
 *     "format" = "h:mm",
 *     "leading_zero" = TRUE
 *   }
 * )
 */
class HMSFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, array &$form_state) {
    $elements = array();

    $elements['format'] = array(
      '#type' => 'select',
      '#title' => t('Display format'),
      '#options' => _hms_format_options(),
      '#description' => t('The display format used for this field'),
      '#default_value' => $this->getSetting('format'),
      '#required' => TRUE,
    );
    $elements['leading_zero'] = array(
      '#type' => 'checkbox',
      '#title' => t('Leading zero'),
      '#description' => t('Leading zero values will be displayed when this option is checked'),
      '#default_value' => $this->getSetting('leading_zero'),
    );

    return $elements;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = array();

    $summary[] = t('Format: @format', array('@format' => $this->getSetting('format')));
    $summary[] = t('Leading zero: @zero', array('@zero' => ($this->getSetting('leading_zero')?t('On'):t('Off'))));

    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items) {
    $element = array();

    foreach ($items as $delta => $item) {
      $element[$delta] = array(
        '#theme' => 'hms',
        '#value' => $item->value,
        '#format' => $this->getSetting('format'),
        '#leading_zero' => $this->getSetting('leading_zero'),
      );
    }

    return $element;
  }



}

