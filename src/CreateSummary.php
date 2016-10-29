<?php

/**
 * Project: unittest-generator,
 * File created by: tom-sapletta-com, on 28.10.2016, 23:50
 */
class CreateSummary
{
    public $value;

    /**
     * info about all params
     *
     * @param FilesGenerator $files
     * @param $folder_test
     * @param $namespace_project
     * @param $project_author
     */
    public function __construct(FilesGenerator $files, $folder_test, $namespace_project, $project_author, UnittestGenerator $generator)
    {
        $value = 'folder_test: ' . $folder_test . "\n";
        $value .= 'namespace_project: ' . $namespace_project . "\n";
        $value .= 'project_author: ' . $project_author . "\n";

        $value .= 'FILE excluded:' . count($files->files_excluded) . "\n";
        foreach ($files->files_excluded as $filename) {
            $value .= '-' . $filename . "\n";
        }
        $value .= 'FILE scanned:' . $generator->scanned . "\n";
        $value .= 'FILE todo:' . count($files->list) . "\n";
        $value .= 'FILE existing (not created):' . $generator->existing . "\n";
        $value .= 'FILE TESTS created:' . count($generator->created) . "\n";
        $value .= "\n";
        foreach ($generator->created as $filename) {
            $value .= $filename . "\n";
        }
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->value;
    }

}