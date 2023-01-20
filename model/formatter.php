<?php

function formatTime(int $time)
{
    // Get current timestamp and format
    $fmt = datefmt_create(
        'en_US',
        IntlDateFormatter::SHORT,
        IntlDateFormatter::MEDIUM,
        'America/Los_Angeles',
        IntlDateFormatter::GREGORIAN
    );
    return datefmt_format($fmt, $time);
}