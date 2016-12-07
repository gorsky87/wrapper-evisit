<?php

namespace Drupal\ev_client_endpoint\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * An example controller.
 */
class EvCalendar extends ControllerBase {

  public function getWeekScheduler($host) {
    $open_days = $host->get('field_ev_open_hour')->getValue();
    foreach ($open_days as $open_day) {
      $open_hour = entity_load('hours', $open_day['target_id']);
      $day[$open_hour->get('field_days')
        ->get(0)
        ->getValue()['value']] = $open_hour;
    }
    return $day;
  }

  public function getNumberFreeVisit($week_scheduler, $number_day, $time_visit) {
    if ($week_scheduler[$number_day]) {
      $open_times = $week_scheduler[$number_day]->get('field_open_hour')
        ->getValue();
      $sum_min = '';
      foreach ($open_times as $open_time) {
        $a = explode('-', $open_time['value']);
        $start = str_replace(':', '', $a[0]);
        $end = str_replace(':', '', $a[1]);

        $time_dif = ($end - $start);
        if (strlen($time_dif) == 3) {
          $time_dif = '0' . $time_dif;
        }
        $sub_min = substr($time_dif, -2);
        $sub_hour = substr($time_dif, 0, 2);
        if ($sub_min >= 60) {
          $sub_min -= 60;
          $sub_hour++;
        }
        // TODO MAKE CLEARLY
        $sum_min += ($sub_hour * 60) + $sub_min;
      }
      $fee_visits = $sum_min / $time_visit;
      return intval($fee_visits);
    }
  }

  public function getOpenHour($week_scheduler, $number_day) {
    if ($week_scheduler[$number_day]) {
      $open_times = $week_scheduler[$number_day]->get('field_open_hour')
        ->getValue();
      $open_scheduler = NULL;
      foreach ($open_times as $open_time) {
        $open_scheduler .= '<p>'.$open_time['value'].'<p>';
      }
      return $open_scheduler;
    }
  }
}
