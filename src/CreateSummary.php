<?php

/**
 * Project: unittest-generator,
 * File created by: tom-sapletta-com, on 28.10.2016, 23:50
 */
class CreateSummary
{
    /**
     * info about all params
     *
     * @param FilesGenerator $files
     * @param $folder_test
     * @param $namespace_project
     * @param $project_author
     */
    public function __construct(FilesGenerator $files, $folder_test, $namespace_project, $project_author)
    {
        echo 'folder_test: ' . $folder_test . "\n";
        echo 'namespace_project: ' . $namespace_project . "\n";
        echo 'project_author: ' . $project_author . "\n";

        echo 'FILE excluded:' . count($files->files_excluded) . "\n";
        foreach ($files->files_excluded as $filename) {
            echo '-' . $filename . "\n";
        }
        echo 'FILE scanned:' . $this->scanned . "\n";
        echo 'FILE todo:' . count($files->list) . "\n";
        echo 'FILE existing (not created):' . $this->existing . "\n";
        echo 'FILE TESTS created:' . count($this->created) . "\n";
        foreach ($this->created as $filename) {
            echo $filename . "\n";
        }
    }

}