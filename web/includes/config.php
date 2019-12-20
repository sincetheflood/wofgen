<?php

/**
 * Used to store website configuration information.
 *
 * @var string or null
 */
function config($key = '')
{
    $config = [
        'name' => 'Wings of Fire Generators',
        'site_url' => 'https://wofgen.herokuapp.com',
        'template_path' => 'template',
        'content_path' => 'content',
        'version' => 'v2019.12.20',
    ];

    return isset($config[$key]) ? $config[$key] : null;
}
