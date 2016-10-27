<?php

/**
 * Project: unittest-generator,
 * File created by: tom-sapletta-com, on 26.10.2016, 20:53
 */
class FilesGenerator
{
    public $folder_project;

    public $files_excluded = [];
    public $folders = [];
    public $list = [];


    /**
     * FilesGenerator constructor.
     *
     * @param $folder_project
     */
    public function __construct($folder_project, $needle = [])
    {
        $this->folder_project = $folder_project;
        // find all files
        $file_list = $this->getFiles($folder_project . DIRECTORY_SEPARATOR, '.php', $needle);
        foreach ($this->getFolders($folder_project) as $subfolder) {
            $files_prefix = $subfolder;
            array_push($file_list, $this->getFiles($folder_project . DIRECTORY_SEPARATOR . $subfolder, '.php', $files_prefix));
        }
        $this->list = $file_list;
    }

    /**
     * scan folder and put all files to array as result
     *
     * @param $folder
     * @return array
     */
    public function getFolders($folder)
    {
        $folders = [];
        if ($handle = opendir($folder)) {
            while (false !== ($entry = readdir($handle))) {
                $filepath = $folder . DIRECTORY_SEPARATOR . $entry;
                if ($entry != "." && $entry != "..") {
                    if (!is_file($filepath)) {
                        $folders[] = $entry;
                    }
                }
            }
            closedir($handle);
        }

        return $folders;
    }

    /**
     * scan folder and put all files to array as result
     *
     * @param $folder
     * @param string $extension
     * @param array $needle
     * @return array
     */
    public function getFiles($folder, $extension = '.php', $needle = [])
    {
        $files = [];
        if ($handle = opendir($folder)) {
            while (false !== ($entry = readdir($handle))) {
                $filepath = $folder . DIRECTORY_SEPARATOR . $entry;
                if ($entry != "." && $entry != "..") {
                    if (is_file($filepath)) {
                        $entry = str_replace($extension, '', $entry);
                        $is_find = $this->find_in_file($needle, $filepath);
                        if ($is_find) {
                            $this->files_excluded[] = $entry;
                        } else {
                            $files[] = $entry;
                        }
                    }
                }
            }
            closedir($handle);
        }

        return $files;
    }

    /**
     * @param $needle
     * @param $filepath
     * @return mixed
     */
    public function find_in_file($needle, $filepath)
    {
        if (empty($needle)) {
            return false;
        }
        if (!is_array($needle)) {
            $needle = [$needle];
        }
        foreach ($needle as $val) {
            $result = (strpos(file_get_contents($filepath), $val) !== false);

            if ($result) {
                return true;
            }
        }
        return false;
    }
}