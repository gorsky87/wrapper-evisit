<?php

namespace Drupal\ev_data;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Hours entity.
 *
 * @see \Drupal\ev_data\Entity\Hours.
 */
class HoursAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\ev_data\Entity\HoursInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished hours entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published hours entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit hours entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete hours entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add hours entities');
  }

}
