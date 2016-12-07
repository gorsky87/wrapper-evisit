<?php

/**
 * @file
 * Contains ev_host.page.inc.
 *
 * Page callback for Ev host entities.
 */

use Drupal\Core\Render\Element;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Prepares variables for Ev host templates.
 *
 * Default template: ev_host.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_ev_host(array &$variables) {
  // Fetch EvHost Entity Object.
  $ev_host = $variables['elements']['#ev_host'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
