<?php

namespace Drupal\ev_client_endpoint;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Routing\LinkGeneratorTrait;
use Drupal\Core\Url;

/**
 * Defines a class to build a listing of Ev_token entities.
 *
 * @ingroup ev_client_endpoint
 */
class ev_tokenListBuilder extends EntityListBuilder {

  use LinkGeneratorTrait;

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Ev_token ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\ev_client_endpoint\Entity\ev_token */
    $row['id'] = $entity->id();
    $row['name'] = $this->l(
      $entity->label(),
      new Url(
        'entity.ev_token.edit_form', array(
          'ev_token' => $entity->id(),
        )
      )
    );
    return $row + parent::buildRow($entity);
  }

}
