<?php

/**
 * @file
 * Contains ev_visit.page.inc.
 *
 * Page callback for Ev visit entities.
 */

use Drupal\Core\Render\Element;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Prepares variables for Ev visit templates.
 *
 * Default template: ev_visit.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_ev_visit(array &$variables) {
  // Fetch EvVisit Entity Object.
  $ev_visit = $variables['elements']['#ev_visit'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
