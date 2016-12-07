<?php

namespace Drupal\ev_client_endpoint\Controller;

use Drupal\Core\Access\AccessResultAllowed;
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\Core\Session\AccountInterface;

/**
 * An example controller.
 */
class EvEndpoint extends ControllerBase {

  /**
   * {@inheritdoc}
   */
  public function post(Request $request) {

    // This condition checks the `Content-type` and makes sure to
    // decode JSON string from the request body into array.
    if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
      $data = json_decode($request->getContent(), TRUE);
      $request->request->replace(is_array($data) ? $data : []);

      $response = new JsonResponse();
      $token = new EvToken($data['settings']['login_hash']);
      if ($token->Authenticate($_SERVER['SERVER_NAME'])) {

        if ($data['method'] == 'calendar') {
          $calendar = $token->GetCalendar();
          $data['data'] = 'Some test data to return';
          $data['calendar_day'] = $calendar;
        }
        if ($data['method'] == 'hour') {
          $scheduler = $token->GetDayScheduler($data['day']);
          $data['scheduler'] = $scheduler;
        }
        $data['method'] = 'POST';
        $response->setData($data);
      }
      else {
        $response->setStatusCode(403);
      }
      return $response;
    }
  }

  /**
   *
   */
  public function access(AccountInterface $account) {
    // Check permissions and combine that with any custom access checking needed. Pass forward
    // parameters from the route and/or request as needed.
    return AccessResultAllowed::allowed();
  }
}

