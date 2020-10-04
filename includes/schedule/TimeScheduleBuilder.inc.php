<?php

/**
 * The Builder interface specifies methods for creating the different parts of
 * the Timetable objects.
 */
interface TimeScheduleBuilder
{
    public function produceTimeSchdule($departureStation, $endStation, $departureTime, $endTime): schedule\TimeSchedule;
}
?>
