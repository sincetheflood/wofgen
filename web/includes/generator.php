<?php

/*------------------------------------*\
#VARIABLES
\*------------------------------------*/

/**
 * $Tribes
 * Read ./resources/tribe/*, ./resources/isHybrid and randomize entries.
 */
$tribePantala = explode("\n", file_get_contents('./resources/tribe/pantala'));
$tribePyrrhia = explode("\n", file_get_contents('./resources/tribe/pyrrhia'));
$isHybrid     = explode("\n", file_get_contents('./resources/isHybrid'));
$tribeOptions = array_merge($tribePantala, $tribePyrrhia);
shuffle($isHybrid);
shuffle($tribeOptions);



/**
 * $Body
 * Read ./resources/body/* and randomize entries.
 */

// Tribe specific body attributes
$bodyDescriptionSea = explode("\n", file_get_contents('./resources/body/descriptionSea'));
// Shared body attributes
$bodyAdjectiveShared = explode("\n", file_get_contents('./resources/body/adjectiveShared'));
$bodyScaleShared = explode("\n", file_get_contents('./resources/body/scaleShared'));
$bodyDescriptionShared = explode("\n", file_get_contents('./resources/body/descriptionShared'));
// Randomize body attributes
shuffle($bodyAdjectiveShared);
shuffle($bodyScaleShared);
shuffle($bodyDescriptionSea);
shuffle($bodyDescriptionShared);



/**
 * $Wings
 * Read ./resources/wing/* and randomize entries.
 */

// Tribe specific wing attributes
$wingSizeHybrid = explode("\n", file_get_contents('./resources/wing/sizeHybrid'));
// Shared wing attributes
$wingAppearanceShared = explode("\n", file_get_contents('./resources/wing/appearanceShared'));
$wingColorShared = explode("\n", file_get_contents('./resources/wing/colorShared'));
$wingSizeShared = explode("\n", file_get_contents('./resources/wing/sizeShared'));
// Randomize wing attributes
shuffle($wingSizeHybrid);
shuffle($wingAppearanceShared);
shuffle($wingColorShared);
shuffle($wingSizeShared);



/**
 * $Horns
 * Read ./resources/horn/* and randomize entries.
 */

// Tribe specific horn attributes
// $hornSea = explode("\n", file_get_contents('./resources/horn/sea'));
$hornSea;
// Shared horn attributes
$hornAppearanceShared = explode("\n", file_get_contents('./resources/horn/appearanceShared'));
$hornSizeShared = explode("\n", file_get_contents('./resources/horn/sizeShared'));
// Randomize horn attributes
// shuffle($hornSea);
shuffle($hornAppearanceShared);
shuffle($hornSizeShared);



/**
 * $Locations
 * Read ./resources/location/* and randomize the entries.
 */

// Tribe specific locations
$locationHiveSilk = explode("\n", file_get_contents('./resources/location/hiveSilk'));
$locationIce = explode("\n", file_get_contents('./resources/location/ice'));
$locationLeaf = explode("\n", file_get_contents('./resources/location/leaf'));
// Shared locations
$locationPantalaShared = explode("\n", file_get_contents('./resources/location/pantalaShared'));
$locationPyrrhiaShared = explode("\n", file_get_contents('./resources/location/pyrrhiaShared'));
// Randomize tribe locations
shuffle($locationHiveSilk);
shuffle($locationIce);
shuffle($locationLeaf);
shuffle($locationPantalaShared);
shuffle($locationPyrrhiaShared);



/**
 * $Jobs
 * Read ./resources/job/* and randomize entries.
 */

// Shared jobs
$jobShared = explode("\n", file_get_contents('./resources/job/shared'));
// Randomize jobs
shuffle($jobShared);



/**
 * $Hobby
 * Read ./resources/hobby/* and randomize entries.
 */

// Shared hobbies
$hobbyShared = explode("\n", file_get_contents('./resources/hobby/shared'));
// Randomize hobbies
shuffle($hobbyShared);



/**
 * $Status
 * Read ./resources/status/* and randomize entries.
 */

// Shared hobbies
$statusShared = explode("\n", file_get_contents('./resources/status/shared'));
// Randomize hobbies
shuffle($statusShared);





/*------------------------------------*\
#COMPUTATIONS
\*------------------------------------*/

// Determine the dragon's tribe
if ($isHybrid[0] === "true") {
  $tribe = "$tribeOptions[0] and $tribeOptions[1] hybrid";
} else {
  $tribe = "$tribeOptions[0]";
}


// Determine the dragon's markings based on their tribe.
if ($tribe === "SeaWing") {
  global $bodyDescriptionOptions;
  $bodyDescriptionOptions = array_merge($bodyDescriptionShared, $bodyDescriptionSea);
  shuffle($bodyDescriptionOptions);
} else {
  global $bodyDescriptionOptions;
  $bodyDescriptionOptions = $bodyDescriptionShared;
}


// Determine the dragon's wing size
if ($isHybrid[0] === "true") {
  global $wingSizeOptions;
  $wingSizeOptions = array_merge($wingSizeHybrid, $wingSizeShared);
  shuffle($wingSizeOptions);
} else {
  global $wingSizeOptions;
  $wingSizeOptions = $wingSizeShared;
}


// Determine the dragon's horn appearance
$hornOptions = $hornAppearanceShared;


// Determine the dragon's job
$jobOptions = $jobShared;


// Determine the dragon's location based on their tribe.
if ($tribe === "IceWing") {
  global $locationOptions;
  $locationOptions = array_merge($locationPyrrhiaShared, $locationIce);
  shuffle($locationOptions);
} else if ($tribe === "HiveWing" || $tribe === "SilkWing") {
  global $locationOptions;
  $locationOptions = array_merge($locationPantalaShared, $locationHiveSilk);
  shuffle($locationOptions);
} else if ($tribe === "LeafWing") {
  global $locationOptions;
  $locationOptions = array_merge($locationPantalaShared, $locationLeaf);
  shuffle($locationOptions);
} else {
  global $locationOptions;
  $locationOptions = $locationPyrrhiaShared;
}





/*------------------------------------*\
#PRINT
\*------------------------------------*/

echo "<p>This dragon is $bodyAdjectiveShared[0] $tribe with $bodyScaleShared[0] scales. Their wings are $wingSizeOptions[0] and $wingAppearanceShared[0], $wingColorShared[0]. They have $bodyDescriptionOptions[0] and $hornSizeShared[0] $hornOptions[0].</p>";

echo "<p>They are a $jobOptions[0] and live $locationOptions[0]. They $hobbyShared[0] and $statusShared[0].</p>";
