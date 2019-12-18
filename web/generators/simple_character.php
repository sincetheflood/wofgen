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
 * Read ./generators/simple_character/tribe/*, ./generators/simple_character/is_hybrid and randomize entries.
 */
$tribe_pantala = explode("\n", file_get_contents('./generators/simple_character/tribe/pantala'));
$tribe_pyrrhia = explode("\n", file_get_contents('./generators/simple_character/tribe/pyrrhia'));
$tribe_options = array_merge($tribe_pantala, $tribe_pyrrhia);
shuffle($tribe_options);



/**
 * $Body
 * Read ./generators/simple_character/body/* and randomize entries.
 */

// Rank specific horn attributes
$body_description_nobility = explode("\n", file_get_contents('./generators/simple_character/body/description_nobility'));
// Tribe specific body attributes
$body_description_sea = explode("\n", file_get_contents('./generators/simple_character/body/description_sea'));
// Shared body attributes
$body_adjective_shared   = explode("\n", file_get_contents('./generators/simple_character/body/adjective_shared'));
$body_scale_shared       = explode("\n", file_get_contents('./generators/simple_character/body/scale_shared'));
$body_description_shared = explode("\n", file_get_contents('./generators/simple_character/body/description_shared'));
// Randomize body attributes
shuffle($body_adjective_shared);
shuffle($body_scale_shared);
shuffle($body_description_sea);
shuffle($body_description_shared);



/**
 * $Wings
 * Read ./generators/simple_character/wing/* and randomize entries.
 */

// Tribe specific wing attributes
$wing_size_hybrid = explode("\n", file_get_contents('./generators/simple_character/wing/size_hybrid'));
// Shared wing attributes
$wing_appearance_shared = explode("\n", file_get_contents('./generators/simple_character/wing/appearance_shared'));
$wing_color_shared      = explode("\n", file_get_contents('./generators/simple_character/wing/color_shared'));
$wing_size_shared       = explode("\n", file_get_contents('./generators/simple_character/wing/size_shared'));
// Randomize wing attributes
shuffle($wing_size_hybrid);
shuffle($wing_appearance_shared);
shuffle($wing_color_shared);
shuffle($wing_size_shared);



/**
 * $Horns
 * Read ./generators/simple_character/horn/* and randomize entries.
 */

// Rank specific horn attributes
$horn_appearance_nobility = explode("\n", file_get_contents('./generators/simple_character/horn/appearance_nobility'));
$horn_size_nobility       = explode("\n", file_get_contents('./generators/simple_character/horn/size_nobility'));
// Shared horn attributes
$horn_appearance_shared = explode("\n", file_get_contents('./generators/simple_character/horn/appearance_shared'));
$horn_size_shared       = explode("\n", file_get_contents('./generators/simple_character/horn/size_shared'));
// Randomize horn attributes
shuffle($horn_appearance_shared);
shuffle($horn_size_shared);



/**
 * $Locations
 * Read ./generators/simple_character/location/* and randomize the entries.
 */

// Tribe specific locations
$location_hive_silk = explode("\n", file_get_contents('./generators/simple_character/location/hive_silk'));
$location_ice       = explode("\n", file_get_contents('./generators/simple_character/location/ice'));
$location_leaf      = explode("\n", file_get_contents('./generators/simple_character/location/leaf'));
// Shared locations
$location_pantala_shared = explode("\n", file_get_contents('./generators/simple_character/location/pantala_shared'));
$location_pyrrhia_shared = explode("\n", file_get_contents('./generators/simple_character/location/pyrrhia_shared'));
$location_shared         = explode("\n", file_get_contents('./generators/simple_character/location/shared'));
// Randomize tribe locations
shuffle($location_hive_silk);
shuffle($location_ice);
shuffle($location_leaf);
shuffle($location_pantala_shared);
shuffle($location_pyrrhia_shared);
shuffle($location_shared);



/**
 * $Jobs
 * Read ./generators/simple_character/job/* and randomize entries.
 */

// LeafWing incompatable jobs
$job_remove_leaf = explode("\n", file_get_contents('./generators/simple_character/job/remove_leaf'));
// Location incompatable jobs
$job_remove_island = explode("\n", file_get_contents('./generators/simple_character/job/remove_island'));
// Shared jobs
$job_shared = explode("\n", file_get_contents('./generators/simple_character/job/shared'));
// Randomize jobs
shuffle($job_shared);



/**
 * $Hobby
 * Read ./generators/simple_character/hobby/* and randomize entries.
 */

// Shared hobbies
$hobby_shared = explode("\n", file_get_contents('./generators/simple_character/hobby/shared'));
// Randomize hobbies
shuffle($hobby_shared);



/**
 * $Status
 * Read ./generators/simple_character/status/* and randomize entries.
 */

// Shared statuses
$status_shared  = explode("\n", file_get_contents('./generators/simple_character/status/shared'));
$status_pyrrhia = explode("\n", file_get_contents('./generators/simple_character/status/pyrrhia'));
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


// Determine the dragon's location based on their tribe.
if ($tribe === "IceWing") {
  global $location_options;
  $location_options = array_merge($location_shared, $location_pyrrhia_shared, $location_ice);
  shuffle($location_options);
} else if ($tribe === "HiveWing" || $tribe === "SilkWing") {
  global $location_options;
  $location_options = array_merge($location_shared, $location_pantala_shared, $location_hive_silk);
  shuffle($location_options);
} else if ($tribe === "LeafWing") {
  global $location_options;
  $location_options = array_merge($location_shared, $location_pantala_shared, $location_leaf);
  shuffle($location_options);
} else {
  global $location_options;
  $location_options = $location_pyrrhia_shared;
}


// Determine the dragon's job

// Remove options if the dragon lives on an island
if ($location_options[0] === "on an island between Pyrrhia and Pantala") {
  global $job_options;
  $job_options = \array_diff($job_shared, $job_remove_island);
  shuffle($job_options);
}

if ($tribe === "LeafWing") {
  global $job_options;
  $job_options = \array_diff($job_shared, $job_remove_leaf);
  shuffle($job_options);
} else {
  global $job_options;
  $job_options = $job_shared;
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

echo "<p>They are $job_options[0] and live $location_options[0]. They $hobby_options[0] and $status_options[0].</p>";
