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
 * Displays page title. It takes the data from
 * URL, it replaces the hyphens with spaces and
 * it capitalizes the words.
 */
function page_title()
{
  $page = isset($_GET['page']) ? htmlspecialchars($_GET['page']) : 'Home';

  echo ucwords(str_replace('_', ' ', $page));
}

/**
 * Displays page content. It takes the data from
 * the static pages inside the pages/ directory.
 * When not found, display the 404 error page.
 */
function page_content()
{
  $page = isset($_GET['page']) ? $_GET['page'] : 'home';
  $path = getcwd() . '/' . config('content_path') . '/' . $page . '.php';

  if (!file_exists($path)) {
    $path = getcwd() . '/' . config('content_path') . '/404.php';
  }

  require $path;
}

/**
 * Chooses a random number between 1 and X.
 */
function roll($sides)
{
  return mt_rand(1, $sides);
}

/**
 * Read a file and split each line into an array entry
 */
function read_arrayify($file)
{
  return explode("\n", file_get_contents('./generators/' . "$file"));
}

function reload_page() {
  print '<p class="reload"><a href="" onclick="window.location.reload(false);">Reload</a> the page to generate a new options.<noscript> (Enable Javascript to use the link)</noscript></p>';
}

/**
 * Starts everything and displays the template.
 */
function init()
{
  require config('template_path') . '/template.php';
}
