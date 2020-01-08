<?php

/*------------------------------------*\
#VARIABLES
\*------------------------------------*/

/**
 * $Name
 * Read ./generators/name_gen/night and randomize entries.
 */
$name_shared = read_arrayify('name_gen/night');
$name_prefix = read_arrayify('name_gen/prefix_night');
$name_suffix = read_arrayify('name_gen/suffix_night');
shuffle($name_shared);
shuffle($name_prefix);
shuffle($name_suffix);
// Create custom NightWing names from the prefix and suffix arrays
$name_merged = array_map('implode', array_map(null, $name_prefix, $name_suffix));
// Randomize the custom names
shuffle($name_merged);
// Merge pregenerated names and custom names into the same array
$name_options = array_merge($name_shared, $name_merged);
// Randomize names
shuffle($name_options);




/*------------------------------------*\
#PRINT
\*------------------------------------*/

reload_page();

print "<p>$name_options[0]</p>";
print "<p>$name_options[1]</p>";
print "<p>$name_options[2]</p>";
print "<p>$name_options[3]</p>";
print "<p>$name_options[4]</p>";
