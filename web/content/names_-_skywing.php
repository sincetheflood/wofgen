<?php

/*------------------------------------*\
#VARIABLES
\*------------------------------------*/

/**
 * $Name
 * Read ./generators/name_gen/sky and randomize entries.
 */
$name_shared = read_arrayify('name_gen/sky');
$name_options = $name_shared;
// Randomize names
shuffle($name_options);




/*------------------------------------*\
#PRINT
\*------------------------------------*/

print "<p>$name_options[0]</p>";
print "<p>$name_options[1]</p>";
print "<p>$name_options[2]</p>";
print "<p>$name_options[3]</p>";
print "<p>$name_options[4]</p>";

reload_page();
