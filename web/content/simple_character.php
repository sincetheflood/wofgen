<?php

/*------------------------------------*\
#VARIABLES
\*------------------------------------*/

/**
 * $Random Numbers
 * Choose two random numbers between 1 and 100 for determinig if the dragon is
 * a hybrid and/or nobility
 */
$criminal_chance = roll(100);
$hybrid_chance   = roll(100);
$nobility_chance = roll(100);



/**
 * $Tribes
 * Read ./generators/simple_character/tribe/*, ./generators/simple_character/is_hybrid and randomize entries.
 */
$tribe_pantala = read_arrayify('simple_character/tribe/pantala');
$tribe_pyrrhia = read_arrayify('simple_character/tribe/pyrrhia');
$tribe_options = array_merge($tribe_pantala, $tribe_pyrrhia);
shuffle($tribe_options);



/**
 * $Body
 * Read ./generators/simple_character/body/* and randomize entries.
 */

// Rank specific horn attributes
$body_description_nobility = read_arrayify('simple_character/body/description_nobility');
// Tribe specific body attributes
$body_description_sea = read_arrayify('simple_character/body/description_sea');
// Shared body attributes
$body_adjective_shared   = read_arrayify('simple_character/body/adjective_shared');
$body_scale_shared       = read_arrayify('simple_character/body/scale_shared');
$body_description_shared = read_arrayify('simple_character/body/description_shared');
// Randomize body attributes
shuffle($body_adjective_shared);
shuffle($body_description_sea);
shuffle($body_description_shared);
shuffle($body_description_nobility);
shuffle($body_scale_shared);



/**
 * $Wings
 * Read ./generators/simple_character/wing/* and randomize entries.
 */

// Tribe specific wing attributes
$wing_size_hybrid = read_arrayify('simple_character/wing/size_hybrid');
// Shared wing attributes
$wing_appearance_shared = read_arrayify('simple_character/wing/appearance_shared');
$wing_color_shared      = read_arrayify('simple_character/wing/color_shared');
$wing_size_shared       = read_arrayify('simple_character/wing/size_shared');
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
$horn_appearance_nobility = read_arrayify('simple_character/horn/appearance_nobility');
$horn_size_nobility       = read_arrayify('simple_character/horn/size_nobility');
// Shared horn attributes
$horn_appearance_shared = read_arrayify('simple_character/horn/appearance_shared');
$horn_size_shared       = read_arrayify('simple_character/horn/size_shared');
// Randomize horn attributes
shuffle($horn_appearance_shared);
shuffle($horn_size_shared);



/**
 * $Locations
 * Read ./generators/simple_character/location/* and randomize the entries.
 */

// Tribe specific locations
$location_hive_silk = read_arrayify('simple_character/location/hive_silk');
$location_ice       = read_arrayify('simple_character/location/ice');
$location_leaf      = read_arrayify('simple_character/location/leaf');
// Shared locations
$location_pantala_shared = read_arrayify('simple_character/location/pantala_shared');
$location_pyrrhia_shared = read_arrayify('simple_character/location/pyrrhia_shared');
$location_shared         = read_arrayify('simple_character/location/shared');
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

// Criminal incompatable jobs
$job_remove_criminal = read_arrayify('simple_character/job/remove_criminal');
// LeafWing incompatable jobs
$job_remove_leaf = read_arrayify('simple_character/job/remove_leaf');
// Location incompatable jobs
$job_remove_island = read_arrayify('simple_character/job/remove_island');
// Shared jobs
$job_shared = read_arrayify('simple_character/job/shared');
// Randomize jobs
shuffle($job_shared);


/**
 * $Hobby
 * Read ./generators/simple_character/hobby/* and randomize entries.
 */

// Shared hobbies
$hobby_shared = read_arrayify('simple_character/hobby/shared');
// Randomize hobbies
shuffle($hobby_shared);



/**
 * $Status
 * Read ./generators/simple_character/status/* and randomize entries.
 */

// Shared statuses
$status_criminal         = read_arrayify('simple_character/status/criminal_shared');
$status_criminal_pantala = read_arrayify('simple_character/status/criminal_pantala');
$status_criminal_pyrrhia = read_arrayify('simple_character/status/criminal_pyrrhia');
$status_shared           = read_arrayify('simple_character/status/shared');
$status_pyrrhia          = read_arrayify('simple_character/status/pyrrhia');
// Randomize statuses
shuffle($status_shared);
shuffle($status_pyrrhia);





/*------------------------------------*\
#COMPUTATIONS
\*------------------------------------*/

// Determine if the dragon is a criminal
if ($criminal_chance >= 75) {
  $is_criminal = true;
} else {
  $is_criminal = false;
}


// Determine the dragon's tribe
if ($hybrid_chance >= 80) {
  $is_hybrid = true;
  $tribe = "$tribe_options[0] and $tribe_options[1] hybrid";
} else {
  $is_hybrid = false;
  $tribe = "$tribe_options[0]";
}


// Determine the dragon's rank
if ($nobility_chance >= 85) {
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
  $is_nobility = false;

  // Body
  $body_description_options = $body_description_shared;

  // Horns
  $horn_size_options       = $horn_size_shared;
  $horn_appearance_options = $horn_appearance_shared;
}


// Determine the dragon's markings based on their tribe.
if ($tribe === "SeaWing") {
  $body_description_options = array_merge($body_description_shared, $body_description_sea);
  shuffle($body_description_options);
} else {
  $body_description_options = $body_description_shared;
}


// Determine the dragon's wing size
if ($is_hybrid === true) {
  $wing_size_options = array_merge($wing_size_hybrid, $wing_size_shared);
  shuffle($wing_size_options);
} else {
  $wing_size_options = $wing_size_shared;
}


// Determine the dragon's horn appearance
$horn_size_options       = $horn_size_shared;
$horn_appearance_options = $horn_appearance_shared;


// Determine the dragon's location based on their tribe.
if ($tribe === "IceWing") {
  $location_options = array_merge($location_shared, $location_pyrrhia_shared, $location_ice);
  shuffle($location_options);
} else if ($tribe === "HiveWing" || $tribe === "SilkWing") {
  $location_options = array_merge($location_shared, $location_pantala_shared, $location_hive_silk);
  shuffle($location_options);
} else if ($tribe === "LeafWing") {
  $location_options = array_merge($location_shared, $location_pantala_shared, $location_leaf);
  shuffle($location_options);
} else {
  $location_options = $location_pyrrhia_shared;
}


// Determine the dragon's job
$job_options = $job_shared;

// Remove entries if the dragon is a criminal
if ($is_criminal === true) {
  $job_options_adjusted = array_merge(array_diff($job_options, $job_remove_criminal), array_diff($job_remove_criminal, $job_options));
}

// Remove entries if the dragon is a LeafWing
if ($tribe === "LeafWing" && isset($job_options_adjusted)) {
  $job_options_adjusted = array_merge(array_diff($job_options_adjusted, $job_remove_leaf), array_diff($job_remove_leaf, $job_options_adjusted));
} else if ($tribe === "LeafWing") {
  $job_options_adjusted = array_merge(array_diff($job_options, $job_remove_leaf), array_diff($job_remove_leaf, $job_options));
}

// Remove entries if the dragon lives in a remote location
if ($location_options[0] === "on an island between Pyrrhia and Pantala" && isset($job_options_adjusted)) {
  $job_options_adjusted = array_merge(array_diff($job_options_adjusted, $job_remove_island), array_diff($job_remove_island, $job_options_adjusted));
} else if ($location_options[0] === "on an island between Pyrrhia and Pantala") {
  $job_options_adjusted = array_merge(array_diff($job_options, $job_remove_island), array_diff($job_remove_island, $job_options));
}

// If none of the above if statements occured, set $job_options_adjusted to equal $job_options
if (!isset($job_options_adjusted)) {
  $job_options_adjusted = $job_options;
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

reload_page();

print "<p>This dragon is $body_adjective_shared[0] $tribe with $body_scale_shared[0] scales. Their wings are $wing_size_options[0] and $wing_appearance_shared[0], $wing_color_shared[0]. They have $body_description_options[0] and $horn_size_options[0] $horn_appearance_options[0].</p>";
print "<p>They are $job_options_adjusted[0] and live $location_options[0]. They $hobby_options[0] and $status_options[0].</p>";
