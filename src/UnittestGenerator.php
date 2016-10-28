<?php

/**
 * Project: unittest-generator,
 * File created by: tom-sapletta-com, on 22.10.2016, 08:46
 */


/**
 * Class UnittestGenerator
 *
 * From Source folder are reading and creating files in new destination as test files based on template
 */
class UnittestGenerator
{

    public $created = [];
    public $scanned = 0;
    public $existing = 0;

    /**
     * UnittestGenerator constructor.
     *
     * @param FilesGenerator $files
     * @param $folder_test
     * @param $namespace_project
     * @param $project_author
     */
    public function __construct(FilesGenerator $files, $folder_test, $namespace_project, $project_author)
    {
        $this->create_test_files($files, $folder_test, $namespace_project, $project_author);
        new CreateSummary($files, $folder_test, $namespace_project, $project_author);
    }


    /**
     * @param $namespace
     * @param $project_author
     * @param $date
     * @param $classname
     * @param $classname_test
     * @return string
     */
    public function template($namespace, $project_author, $date, $classname, $classname_test)
    {

        $content = '
<?php

/**
 * Project: ' . $namespace . ',
 * File created by: ' . $project_author . ', on ' . $date . '
 */

require_once __DIR__ . \'../vendor\' . \'/autoload.php\';
use PHPUnit\Framework\TestCase;
use ' . $namespace . ';

/**
 * Test Class ' . $classname_test . '
 * Base Class ' . $classname . '
 */
class ' . $classname_test . ' extends TestCase
{
    public function testTrueIsTrue()
    {
        $object = new ' . $classname . '($param);
        $foo = true;
        $this->assertTrue($foo);
    }
}
';
        return $content;
    }

    /**
     * create test files from list
     *
     * @param FilesGenerator $files
     * @param $folder_test
     * @param $namespace_project
     * @param $project_author
     */
    public function create_test_files(FilesGenerator $files, $folder_test, $namespace_project, $project_author)
    {
        # create Test file
        foreach ($files->list as $classname) {
            $namespace = '';
            if ($namespace_project) {
                $namespace = $namespace_project . "\\" . $classname;
            }
            $classname_test = $classname . 'Test';
            $filetest = $folder_test . DIRECTORY_SEPARATOR . $classname_test . '.php';

            // create $content from template
            $content = $this->template($namespace, $project_author, date("Y-m-d H:i:s"), $classname, $classname_test);

            # if not exist, create it
            if (!is_readable($filetest)) {
                file_put_contents($filetest, $content);
                $this->created[] = '+ ' . $filetest . "\n";
            } else {
                $this->existing++;
            }
        }
    }

}