<?php

/**
 * @file
 * Contains ev_token.page.inc.
 *
 * Page callback for Ev_token entities.
 */

use Drupal\Core\Render\Element;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Prepares variables for Ev_token templates.
 *
 * Default template: ev_token.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_ev_token(array &$variables) {
  // Fetch ev_token Entity Object.
  $ev_token = $variables['elements']['#ev_token'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
