<?php

namespace Drupal\ev_data\Entity;

use Drupal\views\EntityViewsData;
use Drupal\views\EntityViewsDataInterface;

/**
 * Provides Views data for Hours entities.
 */
class HoursViewsData extends EntityViewsData implements EntityViewsDataInterface {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    $data['hours']['table']['base'] = array(
      'field' => 'id',
      'title' => $this->t('Hours'),
      'help' => $this->t('The Hours ID.'),
    );

    return $data;
  }

}
