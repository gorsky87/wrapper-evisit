<?php

namespace Drupal\ev_client_endpoint\Entity;

use Drupal\views\EntityViewsData;
use Drupal\views\EntityViewsDataInterface;

/**
 * Provides Views data for Ev_token entities.
 */
class ev_tokenViewsData extends EntityViewsData implements EntityViewsDataInterface {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    $data['ev_token']['table']['base'] = array(
      'field' => 'id',
      'title' => $this->t('Ev_token'),
      'help' => $this->t('The Ev_token ID.'),
    );

    return $data;
  }

}
