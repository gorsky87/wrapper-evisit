<?php

namespace Drupal\ev_client_endpoint\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Ev_token entities.
 *
 * @ingroup ev_client_endpoint
 */
interface ev_tokenInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Ev_token name.
   *
   * @return string
   *   Name of the Ev_token.
   */
  public function getName();

  /**
   * Sets the Ev_token name.
   *
   * @param string $name
   *   The Ev_token name.
   *
   * @return \Drupal\ev_client_endpoint\Entity\ev_tokenInterface
   *   The called Ev_token entity.
   */
  public function setName($name);

  /**
   * Gets the Ev_token creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Ev_token.
   */
  public function getCreatedTime();

  /**
   * Sets the Ev_token creation timestamp.
   *
   * @param int $timestamp
   *   The Ev_token creation timestamp.
   *
   * @return \Drupal\ev_client_endpoint\Entity\ev_tokenInterface
   *   The called Ev_token entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Ev_token published status indicator.
   *
   * Unpublished Ev_token are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Ev_token is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Ev_token.
   *
   * @param bool $published
   *   TRUE to set this Ev_token to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\ev_client_endpoint\Entity\ev_tokenInterface
   *   The called Ev_token entity.
   */
  public function setPublished($published);

}
