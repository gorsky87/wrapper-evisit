<?php

/**
 * @file
 * Contains \Drupal\hms_field\Plugin\Field\FieldWidget\HMSFieldWidget.
 */

namespace Drupal\hms_field\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;

/**
 * Plugin implementation of the 'hms_default' widget.
 *
 * @FieldWidget(
 *   id = "hms_default",
 *   label = @Translation("Hour Minutes and Seconds"),
 *   field_types = {
 *     "hms"
 *   },
 *   settings = {
 *     "format" = "h:mm",
 *     "default_placeholder" = 1,
 *     "placeholder" = ""
 *   }
 * )
 */
class HMSFieldWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, array &$form_state) {
    $element = array();
    $element['format'] = array(
      '#type' => 'select',
      '#title' => t('Input format'),
      '#default_value' => $this->getSetting('format'),
      '#options' => _hms_format_options(),
      '#description' => t('The input format used for this field.'),
    );
    $element['default_placeholder'] = array(
      '#type' => 'checkbox',
      '#title' => t('Default placeholder'),
      '#default_value' => $this->getSetting('default_placeholder'),
      '#description' => t('Provide a default placeholder with the format.'),
    );
    $element['placeholder'] = array(
      '#type' => 'textfield',
      '#title' => t('Placeholder'),
      '#default_value' => $this->getSetting('placeholder'),
      '#description' => t('Text that will be shown inside the field until a value is entered. This hint is usually a sample value or a brief description of the expected format.'),
      '#states' => array(
        'invisible' => array(
          ':input[name*="default_placeholder"]' => array('checked' => TRUE),
        ),
      ),
    );
    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = array();

    $summary[] = t('Format: @format', array('@format' => $this->getSetting('format')));
    $summary[] = t('Placeholder: @value', array('@value' => ($this->getSetting('default_placeholder')?$this->getSetting('format'):$this->getSetting('placeholder'))));

    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, array &$form_state) {

    $element['value'] = $element + array(
      '#type' => 'hms',
      '#default_value' => isset($items[$delta]->value) ? $items[$delta]->value : NULL,
      '#format' => $this->getSetting('format'),
      '#placeholder' => $this->getSetting('default_placeholder')?$this->getSetting('format'):$this->getSetting('placeholder'),
      '#attributes' => array('class' => array('hms-field')),
    );

    return $element;
  }
}