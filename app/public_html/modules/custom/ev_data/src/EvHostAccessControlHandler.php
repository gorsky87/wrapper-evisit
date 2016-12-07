<?php

namespace Drupal\ev_data;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Ev host entity.
 *
 * @see \Drupal\ev_data\Entity\EvHost.
 */
class EvHostAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\ev_data\Entity\EvHostInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished ev host entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published ev host entities');

      case 'update':

        if ($account->id() == $entity->getOwnerId()) {
          return AccessResult::allowedIfHasPermission($account, 'edit own ev host entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'edit ev host entities');

      case 'delete':
        if ($account->id() == $entity->getOwnerId()) {
          return AccessResult::allowedIfHasPermission($account, 'delete own ev host entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'delete ev host entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add ev host entities');
  }

}
