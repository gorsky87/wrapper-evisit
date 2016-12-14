<?php

/**
 * @file
 * Contains \Drupal\hms_field\Plugin\Field\FieldType\HMSFieldItem.
 */

namespace Drupal\hms_field\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Plugin implementation of the 'hms' field type.
 *
 * @FieldType(
 *   id = "hms",
 *   label = @Translation("HMS"),
 *   description = @Translation("Store Hours, Minutes or Seconds as an integer."),
 *   default_widget = "hms_default",
 *   default_formatter = "hms_default_formatter"
 * )
 */
class HMSFieldItem extends FieldItemBase {

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldDefinitionInterface $field_definition) {

    $properties['value'] = DataDefinition::create('integer')
      ->setLabel(t('HMS integer value'));

    return $properties;
  }

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldDefinitionInterface $field_definition) {

    return array(
      'columns' => array(
        'value' => array(
          'type' => 'int',
          'unsigned' => FALSE,
          'not null' => TRUE,
          'default' => 0,
        ),
      ),
    );
  }
}
