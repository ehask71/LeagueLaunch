<?php

/**
 * CakePHP Schedule
 * @author Eric
 */
App::uses('AppModel', 'Model');

class Schedule extends AppModel {

    var $useTable = false;

    public function getDates($start = '', $end = '', $days = array()) {
        $start = ($start == '') ? date('Y-m-d') : $start;
        $end = ($end == '') ? date('Y-m-d', strtotime(date('Y-m-d') . " + 30 days")) : $end;
        $days = (count($days) == 0) ? array(3) : $days;

        define('INTERNAL_FORMAT', 'Y-m-d');
        define('DISPLAY_MONTH_FORMAT', 'M Y');
        define('DISPLAY_DAY_FORMAT', 'D d M Y');
        // format excluded dates as YYYY-MM-DD, date('Y-m-d'):
        $excluded_dates = array(
        );

        $startd = (int) date('z', strtotime($start));
        $endd = (int) date('z', strtotime($end));
        $end = $endd - $startd;

        $start_day = date(INTERNAL_FORMAT, strtotime($start));
        $months_and_dates = array();

        foreach (range(0, $end) as $day) {
            $internal_date = date(INTERNAL_FORMAT, strtotime("{$start_day} + {$day} days"));
            $this_day = date(DISPLAY_DAY_FORMAT, strtotime($internal_date));
            $this_month = date(DISPLAY_MONTH_FORMAT, strtotime($internal_date));
            foreach ($days AS $d) {
                if (date('w',strtotime($internal_date)) === $d) {
                    $months_and_dates[$this_month][] = $this_day;
                }
            }
        }
        
        return $months_and_dates;
    }

}

