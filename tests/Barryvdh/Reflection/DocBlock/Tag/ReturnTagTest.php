<?php
/**
 * phpDocumentor Return tag test.
 *
 * PHP version 5.3
 *
 * @author    Mike van Riel <mike.vanriel@naenius.com>
 * @copyright 2010-2011 Mike van Riel / Naenius. (http://www.naenius.com)
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      http://phpdoc.org
 */

namespace Barryvdh\Reflection\DocBlock\Tag;

use PHPUnit\Framework\TestCase;

/**
 * Test class for \Barryvdh\Reflection\DocBlock\ReturnTag
 *
 * @author    Mike van Riel <mike.vanriel@naenius.com>
 * @copyright 2010-2011 Mike van Riel / Naenius. (http://www.naenius.com)
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      http://phpdoc.org
 */
class ReturnTagTest extends TestCase
{
    /**
     * Test that the \Barryvdh\Reflection\DocBlock\Tag\ReturnTag can
     * understand the @return DocBlock.
     *
     * @param string $type
     * @param string $content
     * @param string $extractedType
     * @param string $extractedTypes
     * @param string $extractedDescription
     *
     * @covers \Barryvdh\Reflection\DocBlock\Tag\ReturnTag
     * @dataProvider provideDataForConstructor
     *
     * @return void
     */
    public function testConstructorParsesInputsIntoCorrectFields(
        $type,
        $content,
        $extractedType,
        $extractedTypes,
        $extractedDescription
    ) {
        $tag = new ReturnTag($type, $content);

        $this->assertEquals($type, $tag->getName());
        $this->assertEquals($extractedType, $tag->getType());
        $this->assertEquals($extractedTypes, $tag->getTypes());
        $this->assertEquals($extractedDescription, $tag->getDescription());
    }

    /**
     * Data provider for testConstructorParsesInputsIntoCorrectFields()
     *
     * @return array
     */
    public function provideDataForConstructor()
    {
        return array(
            array('return', '', '', array(), ''),
            array('return', 'int', 'int', array('int'), ''),
            array(
                'return',
                'int Number of Bobs',
                'int',
                array('int'),
                'Number of Bobs'
            ),
            array(
                'return',
                'int|double Number of Bobs',
                'int|double',
                array('int', 'double'),
                'Number of Bobs'
            ),
            array(
                'return',
                "int Number of \n Bobs",
                'int',
                array('int'),
                "Number of \n Bobs"
            ),
            array(
                'return',
                " int Number of Bobs",
                'int',
                array('int'),
                "Number of Bobs"
            ),
            array(
                'return',
                "int\nNumber of Bobs",
                'int',
                array('int'),
                "Number of Bobs"
            ),
            array(
                'return',
                'array<int, string> Types of Bobs',
                'array<int, string>',
                array('array<int, string>'),
                'Types of Bobs'
            ),
            array(
                'return',
                'array<int, string>|string Types of Bobs',
                'array<int, string>|string',
                array('array<int, string>', 'string'),
                'Types of Bobs'
            ),
            array(
                'return',
                'array<int, string|bool>|string Types of Bobs',
                'array<int, string|bool>|string',
                array('array<int, string|bool>', 'string'),
                'Types of Bobs'
            ),
            array(
                'return',
                'MyArray[\'key\'] Type of Bobs',
                'MyArray[\'key\']',
                array('MyArray[\'key\']'),
                'Type of Bobs'
            )
        );
    }
}
