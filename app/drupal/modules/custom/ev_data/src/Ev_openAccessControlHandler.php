<?php

namespace Drupal\ev_data;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Ev_open entity.
 *
 * @see \Drupal\ev_data\Entity\Ev_open.
 */
class Ev_openAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\ev_data\Entity\Ev_openInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished ev_open entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published ev_open entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit ev_open entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete ev_open entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add ev_open entities');
  }

}
