<?php

Schedule::command('notify:airac')
    ->dailyAt('09:00')
    ->timezone(DateTimeZone::UTC);
