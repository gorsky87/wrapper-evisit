<?php

namespace Drupal\ev_data\Entity;

use Drupal\views\EntityViewsData;
use Drupal\views\EntityViewsDataInterface;

/**
 * Provides Views data for Ev host entities.
 */
class EvHostViewsData extends EntityViewsData implements EntityViewsDataInterface {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    $data['ev_host']['table']['base'] = array(
      'field' => 'id',
      'title' => $this->t('Ev host'),
      'help' => $this->t('The Ev host ID.'),
    );

    return $data;
  }

}
