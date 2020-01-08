<?php

/*------------------------------------*\
#VARIABLES
\*------------------------------------*/

/**
 * $Name
 * Read ./generators/name_gen/rain and randomize entries.
 */
$name_shared = read_arrayify('name_gen/rain');
$name_options = $name_shared;
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
