<?php

namespace Drupal\ev_data\Entity;

use Drupal\views\EntityViewsData;
use Drupal\views\EntityViewsDataInterface;

/**
 * Provides Views data for Ev_open entities.
 */
class Ev_openViewsData extends EntityViewsData implements EntityViewsDataInterface {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    $data['ev_open']['table']['base'] = array(
      'field' => 'id',
      'title' => $this->t('Ev_open'),
      'help' => $this->t('The Ev_open ID.'),
    );

    return $data;
  }

}
