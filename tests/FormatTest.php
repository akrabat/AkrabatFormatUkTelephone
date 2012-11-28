<?php

if (!class_exists('\Zend\View\Helper\AbstractHelper')) {
    require_once __DIR__ . '/_AbstractHelperStub.php';
}

require_once __DIR__ . '/../Module.php';

class FormatTest extends PHPUnit_Framework_TestCase
{
    public function number()
    {
        return array(
          // Two special cases
          array('08001111', '0800 1111'),
          array('08454647', '0845 4647'),

          // 01
          array('01905123456', '01905 123456'),
          array('01946712345', '019467 12345'),
          array('01697712345', '016977 12345'),
          array('016977123456', '016977 123456'),

          // 02
          array('02081234567', '020 8123 4567'),

          // International format 02
          array('+44 208 123 4567', '020 8123 4567'),
        );
    }

    /**
     * @dataProvider number
     */
    public function testNumber($number, $expected)
    {
        $formatter = new \AkrabatFormatUkTelephone\Module();

        $formatted = $formatter->format($number);

        $this->assertEquals($expected, $formatted);
    }

}
