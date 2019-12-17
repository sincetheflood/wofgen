<?php

/**
 * Used to store website configuration information.
 *
 * @var string or null
 */
function config($key = '')
{
  $config = [
    'name' => 'Wings of Fire Character Generator',
    'template_path' => 'template',
    'content_path' => 'content',
    'version' => 'v2019.12.17',
  ];
  return isset($config[$key]) ? $config[$key] : null;
}