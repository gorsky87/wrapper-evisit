<?php

namespace Drupal\ev_data\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Ev visit entities.
 *
 * @ingroup ev_data
 */
interface EvVisitInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Ev visit name.
   *
   * @return string
   *   Name of the Ev visit.
   */
  public function getName();

  /**
   * Sets the Ev visit name.
   *
   * @param string $name
   *   The Ev visit name.
   *
   * @return \Drupal\ev_data\Entity\EvVisitInterface
   *   The called Ev visit entity.
   */
  public function setName($name);

  /**
   * Gets the Ev visit creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Ev visit.
   */
  public function getCreatedTime();

  /**
   * Sets the Ev visit creation timestamp.
   *
   * @param int $timestamp
   *   The Ev visit creation timestamp.
   *
   * @return \Drupal\ev_data\Entity\EvVisitInterface
   *   The called Ev visit entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Ev visit published status indicator.
   *
   * Unpublished Ev visit are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Ev visit is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Ev visit.
   *
   * @param bool $published
   *   TRUE to set this Ev visit to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\ev_data\Entity\EvVisitInterface
   *   The called Ev visit entity.
   */
  public function setPublished($published);

}
