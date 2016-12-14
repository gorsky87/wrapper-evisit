<?php

namespace Drupal\ev_client_endpoint\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * An example controller.
 */
class EvToken extends ControllerBase {


  public function __construct($request_token) {
    $this->real_token = $request_token;

    $id = \Drupal::entityQuery('ev_token')
      ->condition('field_ev_token', $request_token)
      ->range(0, 1)
      ->execute();
    $id = reset($id);
    if (isset($id)) {
      $this->token_id = $id;
      $token_entity = entity_load('ev_token', $id);
      $domain = $token_entity->get('field_domain')->value;
      $this->domain = $domain;
      $this->host = $this->getHost();
    }
  }

  /**
   * {@inheritdoc}
   */
  public function Authenticate($domain) {
    return TRUE;
    if ($domain == $this->domain) {
      return TRUE;
    }
  }

  public function getHost() {
    $id = \Drupal::entityQuery('ev_host')
      ->condition('field_ev_token', $this->token_id)
      ->range(0, 1)
      ->execute();
    $id = reset($id);
    if (isset($id)) {
      return $id;
    }
    else {
      return FALSE;
    }
  }

  public function GetDayScheduler($day) {
    $host = entity_load('ev_host', $this->getHost());
    $week_scheduler = new EvCalendar();
    $scheduler = $week_scheduler->getWeekScheduler($host);
    $time_visit = $host->get('field_visit_time')->get(0)->getValue()['value'];
    if ($scheduler[$day['weekday']]) {
      $open_times = $scheduler[$day['weekday']]->get('field_open_hour')
        ->getValue();
      foreach ($open_times as $open_time) {
        $a = explode('-', $open_time['value']);
        $start = $a[0];
        $end = $a[1];
        $start = strtotime($start);
        $end = strtotime($end);
        for ($start; $start < $end; $start += $time_visit * 60) {
          $scheduler_day[] = array(
            'begin' => date("H:i", $start),
            'end' => date("H:i", ($start + $time_visit * 60)),
            'status' => 'free',
          );
        }
      }
      return $scheduler_day;
    }
    return FALSE;
  }

  /**
   * {@inheritdoc}
   */
  public function GetCalendar() {

    $host = entity_load('ev_host', $this->host);
    $host_calendar = new EvCalendar();
    $week_scheduler = $host_calendar->getWeekScheduler($host);

    $calendar = array();
    $date = date('m/d/Y');

    // Set Calendar x  days.
    for ($x = 0; $x <= 90; $x++) {
      // Iteration every day.
      $next_day = date("m/d/Y", strtotime($date . "+ $x days"));
      $number_day = date("N", strtotime($next_day));
      $time_visit = $host->get('field_visit_time')->get(0)->getValue()['value'];
      $open_hours = $host_calendar->getOpenHour($week_scheduler, $number_day);
      if ($open_hours) {
        $free_visit = $host_calendar->getNumberFreeVisit($week_scheduler, $number_day, $time_visit);
        $calendar[str_replace('/', '-', $next_day)] = $open_hours . intval($free_visit) . ' Free Time';
      }
    }
    // Exclude day,
    $dates_to_exclude = $host->get('field_exclude_date')->getValue();
    foreach ($dates_to_exclude as $date_to_exclude) {
      $new_date = date("m-d-Y", strtotime($date_to_exclude['value']));
      unset($calendar[$new_date]);
    }
    return $calendar;
  }
}

