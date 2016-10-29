# PHP Unit Test Generator
## About
With UnittestGenerator is possible create some part of file, but not all, beacue it is what must by defined by user, but i will try find some easy solution in the future, which can help with testing datatype and many methods.
+ files
+ class name
+ one method

## Article
https://tom.sapletta.com/project/a-tool-to-automatically-generate-phpunit-tests/

## Example

### Configuration (in test.php)
```
$folder_project = 'src';
$folder_test = 'tests';
$namespace_project = 'Phunc';
$project_author = 'tom-sapletta-com';

$needle = ['interface', 'abstract'];
$files = new FilesGenerator($folder_project, $needle);
```

### Usage 
```
$result = new UnittestGenerator($files, $folder_test, $namespace_project, $project_author);
```

### Start in Console
```
php test.php
```

### Result in console, Summary
```
folder_test: tests
namespace_project: Phunc
project_author: tom-sapletta-com
FILE excluded:0
FILE scanned:0
FILE todo:4
FILE existing (not created):0
FILE TESTS created:4

+ tests\CreateSummaryTest.php

+ tests\FilesGeneratorTest.php

+ tests\TemplateTest.php

+ tests\UnittestGeneratorTest.php

```

### Result Tests Files
```
CreateSummaryTest.php
FilesGeneratorTest.php
TemplateTest.php
UnittestGeneratorTest.php
```

### Result in console, Summary when test file existing
```
folder_test: tests
namespace_project: Phunc
project_author: tom-sapletta-com
FILE excluded:0
FILE scanned:0
FILE todo:5
FILE existing (not created):5
FILE TESTS created:0
```

#How it works

configuration data
 + set path_source for searching php classes
 + set path_test folder for tests
 + template for unit test

find in path_source php files and get just classes:
 + no interface
 + no abstract
 + no functions

generate files for test content in path_test folder
show summary