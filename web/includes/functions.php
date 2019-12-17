<?php

/**
 * Displays site name.
 */
function site_name()
{
  echo config('name');
}

/**
 * Displays site version.
 */
function site_version()
{
  echo config('version');
}

/**
 * Chooses a random number between 1 and X.
 */
function roll ($sides) {
  return mt_rand(1,$sides);
}

/**
 * Starts everything and displays the template.
 */
function init()
{
  require config('template_path') . '/template.php';
}