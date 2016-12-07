<?php

/**
 * @file
 * Contains hours.page.inc.
 *
 * Page callback for Hours entities.
 */

use Drupal\Core\Render\Element;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Prepares variables for Hours templates.
 *
 * Default template: hours.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_hours(array &$variables) {
  // Fetch Hours Entity Object.
  $hours = $variables['elements']['#hours'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
