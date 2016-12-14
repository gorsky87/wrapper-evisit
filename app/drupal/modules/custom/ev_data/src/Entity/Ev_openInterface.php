<?php

namespace Drupal\ev_data\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Ev_open entities.
 *
 * @ingroup ev_data
 */
interface Ev_openInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Ev_open name.
   *
   * @return string
   *   Name of the Ev_open.
   */
  public function getName();

  /**
   * Sets the Ev_open name.
   *
   * @param string $name
   *   The Ev_open name.
   *
   * @return \Drupal\ev_data\Entity\Ev_openInterface
   *   The called Ev_open entity.
   */
  public function setName($name);

  /**
   * Gets the Ev_open creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Ev_open.
   */
  public function getCreatedTime();

  /**
   * Sets the Ev_open creation timestamp.
   *
   * @param int $timestamp
   *   The Ev_open creation timestamp.
   *
   * @return \Drupal\ev_data\Entity\Ev_openInterface
   *   The called Ev_open entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Ev_open published status indicator.
   *
   * Unpublished Ev_open are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Ev_open is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Ev_open.
   *
   * @param bool $published
   *   TRUE to set this Ev_open to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\ev_data\Entity\Ev_openInterface
   *   The called Ev_open entity.
   */
  public function setPublished($published);

}
