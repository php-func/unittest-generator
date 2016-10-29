<?php

/**
 * Project: unittest-generator,
 * File created by: tom-sapletta-com, on 29.10.2016, 09:44
 */

/**
 * find text in content file
 *
 * Class FindInContentFile
 */
class FindInContentFile
{
    protected $value;

    /**
     * FindInContentFile constructor.
     *
     * @param $needle
     * @param $filepath
     */
    public function __construct($needle, $filepath)
    {
        $this->value = $this->find($needle, $filepath);
    }

    /**
     * @param $needle
     * @param $filepath
     * @return bool
     */
    protected function find($needle, $filepath)
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

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->value;
    }
}