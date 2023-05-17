<?php
$date_string = $tweet['date'];
$timestamp = strtotime($date_string);
$time_diff = time() - $timestamp;
$time = "";
switch (true) {
    case ($time_diff < 10):
        $time = "now";
        break;
    case ($time_diff < 60):
        $seconds = $time_diff;
        $time = "$seconds seconds ago";
        break;
    case ($time_diff < 3600):
        $minutes = floor($time_diff / 60);
        $time = "$minutes minutes ago";
        break;
    case ($time_diff < 86400):
        $hours = floor($time_diff / 3600);
        $minutes = floor(($time_diff % 3600) / 60);
        $seconds = $time_diff % 60;
        $time = "$hours hours ago";
        break;
    case ($time_diff < 2592000):
        $days = floor($time_diff / 86400);
        $time = "$days days ago";
        break;
    default:
        $months = floor($time_diff / 2592000);
        $time = "$months months ago";
        break;
}
