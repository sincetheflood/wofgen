<?php

/*------------------------------------*\
#VARIABLES
\*------------------------------------*/

/**
 * $Random Numbers
 * Choose two random numbers between 1 and 100 for determinig if the dragon is
 * a hybrid and/or nobility
 */
$nobility_chance = roll(100);
$hybrid_chance = roll(100);



/**
 * $Tribes
 * Read ./resources/tribe/*, ./resources/is_hybrid and randomize entries.
 */
$tribe_pantala = explode("\n", file_get_contents('./resources/tribe/pantala'));
$tribe_pyrrhia = explode("\n", file_get_contents('./resources/tribe/pyrrhia'));
$tribe_options = array_merge($tribe_pantala, $tribe_pyrrhia);
shuffle($tribe_options);



/**
 * $Body
 * Read ./resources/body/* and randomize entries.
 */

// Rank specific horn attributes
$body_description_nobility = explode("\n", file_get_contents('./resources/body/description_nobility'));
// Tribe specific body attributes
$body_description_sea = explode("\n", file_get_contents('./resources/body/description_sea'));
// Shared body attributes
$body_adjective_shared   = explode("\n", file_get_contents('./resources/body/adjective_shared'));
$body_scale_shared       = explode("\n", file_get_contents('./resources/body/scale_shared'));
$body_description_shared = explode("\n", file_get_contents('./resources/body/description_shared'));
// Randomize body attributes
shuffle($body_adjective_shared);
shuffle($body_scale_shared);
shuffle($body_description_sea);
shuffle($body_description_shared);



/**
 * $Wings
 * Read ./resources/wing/* and randomize entries.
 */

// Tribe specific wing attributes
$wing_size_hybrid = explode("\n", file_get_contents('./resources/wing/size_hybrid'));
// Shared wing attributes
$wing_appearance_shared = explode("\n", file_get_contents('./resources/wing/appearance_shared'));
$wing_color_shared      = explode("\n", file_get_contents('./resources/wing/color_shared'));
$wing_size_shared       = explode("\n", file_get_contents('./resources/wing/size_shared'));
// Randomize wing attributes
shuffle($wing_size_hybrid);
shuffle($wing_appearance_shared);
shuffle($wing_color_shared);
shuffle($wing_size_shared);



/**
 * $_horns
 * Read ./resources/horn/* and randomize entries.
 */

// Rank specific horn attributes
$horn_appearance_nobility = explode("\n", file_get_contents('./resources/horn/appearance_nobility'));
$horn_size_nobility       = explode("\n", file_get_contents('./resources/horn/size_nobility'));
// Shared horn attributes
$horn_appearance_shared = explode("\n", file_get_contents('./resources/horn/appearance_shared'));
$horn_size_shared       = explode("\n", file_get_contents('./resources/horn/size_shared'));
// Randomize horn attributes
shuffle($horn_appearance_shared);
shuffle($horn_size_shared);



/**
 * $_locations
 * Read ./resources/location/* and randomize the entries.
 */

// Tribe specific locations
$location_hive_silk = explode("\n", file_get_contents('./resources/location/hive_silk'));
$location_ice      = explode("\n", file_get_contents('./resources/location/ice'));
$location_leaf     = explode("\n", file_get_contents('./resources/location/leaf'));
// Shared locations
$location_pantala_shared = explode("\n", file_get_contents('./resources/location/pantala_shared'));
$location_pyrrhia_shared = explode("\n", file_get_contents('./resources/location/pyrrhia_shared'));
// Randomize tribe locations
shuffle($location_hive_silk);
shuffle($location_ice);
shuffle($location_leaf);
shuffle($location_pantala_shared);
shuffle($location_pyrrhia_shared);



/**
 * $Jobs
 * Read ./resources/job/* and randomize entries.
 */

// Tribe specific jobs
// _leafWing incompatable jobs
$job_remove_leaf = explode("\n", file_get_contents('./resources/job/remove_leaf'));
// Shared jobs
$job_shared = explode("\n", file_get_contents('./resources/job/shared'));
// Randomize jobs
shuffle($job_shared);



/**
 * $Hobby
 * Read ./resources/hobby/* and randomize entries.
 */

// Shared hobbies
$hobby_shared = explode("\n", file_get_contents('./resources/hobby/shared'));
// Randomize hobbies
shuffle($hobby_shared);



/**
 * $Status
 * Read ./resources/status/* and randomize entries.
 */

// Shared statuses
$status_shared  = explode("\n", file_get_contents('./resources/status/shared'));
$status_pyrrhia = explode("\n", file_get_contents('./resources/status/pyrrhia'));
// Randomize statuses
shuffle($status_shared);
shuffle($status_pyrrhia);





/*------------------------------------*\
#COMPUTATIONS
\*------------------------------------*/

// Determine the dragon's rank
if ($nobility_chance >= 80) {
  global $is_nobility, $body_description_options, $horn_size_options, $horn_appearance_options;
  $is_nobility = true;

  // Body
  $body_description_options = array_merge($body_description_shared, $body_description_nobility);
  shuffle($body_description_options);

  // Horns
  $horn_size_options       = array_merge($horn_size_nobility, $horn_size_shared);
  $horn_appearance_options = array_merge($horn_appearance_nobility, $horn_appearance_shared);
  shuffle($horn_size_options);
  shuffle($horn_appearance_options);
} else {
  global $is_nobility, $body_description_options, $horn_size_options, $horn_appearance_options;
  $is_nobility = false;

  // Body
  $body_description_options = $body_description_shared;

  // Horns
  $horn_size_options       = $horn_size_shared;
  $horn_appearance_options = $horn_appearance_shared;
}



// Determine the dragon's tribe
if ($hybrid_chance >= 80) {
  global $is_hybrid, $tribe;
  $is_hybrid = true;

  $tribe = "$tribe_options[0] and $tribe_options[1] hybrid";
} else {
  global $is_hybrid, $tribe;
  $is_hybrid = false;
  $tribe = "$tribe_options[0]";
}




// Determine the dragon's markings based on their tribe.
if ($tribe === "_seaWing") {
  global $body_description_options;
  $body_description_options = array_merge($body_description_shared, $body_description_sea);
  shuffle($body_description_options);
} else {
  global $body_description_options;
  $body_description_options = $body_description_shared;
}


// Determine the dragon's wing size
if ($is_hybrid === true) {
  global $wing_size_options;
  $wing_size_options = array_merge($wing_size_hybrid, $wing_size_shared);
  shuffle($wing_size_options);
} else {
  global $wing_size_options;
  $wing_size_options = $wing_size_shared;
}


// Determine the dragon's horn appearance
$horn_size_options       = $horn_size_shared;
$horn_appearance_options = $horn_appearance_shared;


// Determine the dragon's job
if ($tribe === "LeafWing") {
  global $job_options;
  $job_options = \array_diff($job_shared, $job_remove_leaf);
  shuffle($job_options);
} else {
  global $job_options;
  $job_options = $job_shared;
}


// Determine the dragon's location based on their tribe.
if ($tribe === "_iceWing") {
  global $location_options;
  $location_options = array_merge($location_pyrrhia_shared, $location_ice);
  shuffle($location_options);
} else if ($tribe === "_hiveWing" || $tribe === "_silkWing") {
  global $location_options;
  $location_options = array_merge($location_pantala_shared, $location_hive_silk);
  shuffle($location_options);
} else if ($tribe === "_leafWing") {
  global $location_options;
  $location_options = array_merge($location_pantala_shared, $location_leaf);
  shuffle($location_options);
} else {
  global $location_options;
  $location_options = $location_pyrrhia_shared;
}

// Determine the dragon's hobby
$hobby_options = $hobby_shared;


// Determine the dragon's status
if (array_search("$tribe", $tribe_pyrrhia) || $is_hybrid === true) {
  $status_options = array_merge($status_shared, $status_pyrrhia);
  shuffle($status_options);
} else {
  $status_options = $status_shared;
}





/*------------------------------------*\
#PRINT
\*------------------------------------*/

echo "<p>This dragon is $body_adjective_shared[0] $tribe with $body_scale_shared[0] scales. Their wings are $wing_size_options[0] and $wing_appearance_shared[0], $wing_color_shared[0]. They have $body_description_options[0] and $horn_size_options[0] $horn_appearance_options[0].</p>";

echo "<p>They are a $job_options[0] and live $location_options[0]. They $hobby_options[0] and $status_options[0].</p>";
