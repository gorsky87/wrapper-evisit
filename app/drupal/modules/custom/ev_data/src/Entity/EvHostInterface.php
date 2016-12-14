<?php

namespace Drupal\ev_data\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Ev host entities.
 *
 * @ingroup ev_data
 */
interface EvHostInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Ev host name.
   *
   * @return string
   *   Name of the Ev host.
   */
  public function getName();

  /**
   * Sets the Ev host name.
   *
   * @param string $name
   *   The Ev host name.
   *
   * @return \Drupal\ev_data\Entity\EvHostInterface
   *   The called Ev host entity.
   */
  public function setName($name);

  /**
   * Gets the Ev host creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Ev host.
   */
  public function getCreatedTime();

  /**
   * Sets the Ev host creation timestamp.
   *
   * @param int $timestamp
   *   The Ev host creation timestamp.
   *
   * @return \Drupal\ev_data\Entity\EvHostInterface
   *   The called Ev host entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Ev host published status indicator.
   *
   * Unpublished Ev host are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Ev host is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Ev host.
   *
   * @param bool $published
   *   TRUE to set this Ev host to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\ev_data\Entity\EvHostInterface
   *   The called Ev host entity.
   */
  public function setPublished($published);

}
