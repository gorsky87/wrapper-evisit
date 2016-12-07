<?php

namespace Drupal\ev_client_endpoint;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Ev_token entity.
 *
 * @see \Drupal\ev_client_endpoint\Entity\ev_token.
 */
class ev_tokenAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\ev_client_endpoint\Entity\ev_tokenInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished ev_token entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published ev_token entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit ev_token entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete ev_token entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add ev_token entities');
  }

}
