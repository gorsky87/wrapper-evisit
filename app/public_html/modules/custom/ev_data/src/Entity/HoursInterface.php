<?php

namespace Drupal\ev_data\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Hours entities.
 *
 * @ingroup ev_data
 */
interface HoursInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Hours name.
   *
   * @return string
   *   Name of the Hours.
   */
  public function getName();

  /**
   * Sets the Hours name.
   *
   * @param string $name
   *   The Hours name.
   *
   * @return \Drupal\ev_data\Entity\HoursInterface
   *   The called Hours entity.
   */
  public function setName($name);

  /**
   * Gets the Hours creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Hours.
   */
  public function getCreatedTime();

  /**
   * Sets the Hours creation timestamp.
   *
   * @param int $timestamp
   *   The Hours creation timestamp.
   *
   * @return \Drupal\ev_data\Entity\HoursInterface
   *   The called Hours entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Hours published status indicator.
   *
   * Unpublished Hours are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Hours is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Hours.
   *
   * @param bool $published
   *   TRUE to set this Hours to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\ev_data\Entity\HoursInterface
   *   The called Hours entity.
   */
  public function setPublished($published);

}
