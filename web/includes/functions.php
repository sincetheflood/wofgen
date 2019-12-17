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
 * Starts everything and displays the template.
 */
function init()
{
  require config('template_path') . '/template.php';
}