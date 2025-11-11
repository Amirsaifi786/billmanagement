<?php

$oldname = 'jasmann.html';
$newname = 'pawankumar_panchal.html';

if (copy($oldname, $newname)) {
	$message = sprintf(
		'The file %s was copied to %s successfully!',
		$oldname,
		$newname
	);
} else {
	$message = sprintf(
		'There was an error renaming file %s',
		$oldname
	);
}

echo $message;

?>