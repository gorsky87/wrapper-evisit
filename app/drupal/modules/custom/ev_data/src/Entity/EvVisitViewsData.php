<?php

namespace Drupal\ev_data\Entity;

use Drupal\views\EntityViewsData;
use Drupal\views\EntityViewsDataInterface;

/**
 * Provides Views data for Ev visit entities.
 */
class EvVisitViewsData extends EntityViewsData implements EntityViewsDataInterface {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    $data['ev_visit']['table']['base'] = array(
      'field' => 'id',
      'title' => $this->t('Ev visit'),
      'help' => $this->t('The Ev visit ID.'),
    );

    return $data;
  }

}
