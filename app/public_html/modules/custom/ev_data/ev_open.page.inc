<?php

/**
 * @file
 * Contains ev_open.page.inc.
 *
 * Page callback for Ev_open entities.
 */

use Drupal\Core\Render\Element;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Prepares variables for Ev_open templates.
 *
 * Default template: ev_open.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_ev_open(array &$variables) {
  // Fetch Ev_open Entity Object.
  $ev_open = $variables['elements']['#ev_open'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
