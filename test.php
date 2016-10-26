<?php
/**
 * Project: unittest-generator,
 * File created by: tom-sapletta-com, on 22.10.2016, 08:47
 */

require __DIR__ . '/vendor/autoload.php';

$folder_project = 'src';
$folder_test = 'tests';
$namespace_project = 'Phunc';
$project_author = 'tom-sapletta-com';

//$scaninfo = new UnittestGenerator($folder_project, $folder_test, $namespace_project, $project_author);
$needle = ['interface', 'abstract'];
$files = new FilesGenerator($folder_project, $needle);
$scaninfo = new UnittestGenerator($files, $folder_test, $namespace_project, $project_author);
