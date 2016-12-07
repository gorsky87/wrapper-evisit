<?php

namespace Drupal\ev_data;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Ev visit entity.
 *
 * @see \Drupal\ev_data\Entity\EvVisit.
 */
class EvVisitAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\ev_data\Entity\EvVisitInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished ev visit entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published ev visit entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit ev visit entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete ev visit entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add ev visit entities');
  }

}
