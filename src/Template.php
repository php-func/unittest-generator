<?php

/**
 * Project: unittest-generator,
 * File created by: tom-sapletta-com, on 28.10.2016, 23:52
 */

/**
 * Class Template
 */
class Template
{
    protected $content = '';

    /**
     * Template constructor.
     *
     * @param $namespace
     * @param $project_author
     * @param $date
     * @param $classname
     * @param $classname_test
     */
    public function __construct($namespace, $project_author, $date, $classname, $classname_test)
    {

        $this->content = '
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
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->content;
    }
}