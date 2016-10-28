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
        new CreateSummary($files, $folder_test, $namespace_project, $project_author, $this);
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
            $content = (string) new Template($namespace, $project_author, date("Y-m-d H:i:s"), $classname, $classname_test);

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