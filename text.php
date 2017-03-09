<?php

use PhpOffice\PhpWord\PhpWord;

if(!defined('PHPWORD_BASE_PATH')) {
    define('PHPWORD_BASE_PATH', dirname(__FILE__) . '/');
    require PHPWORD_BASE_PATH . 'PHPOffice/PHPWord/Autoloader.php';
    PHPWord_Autoloader::Register();
}
if(!defined('ZEND_BASE_PATH')) {
    define('ZEND_BASE_PATH', dirname(__FILE__) . '/');
    require ZEND_BASE_PATH . 'Zend/Validator/Autoloader.php';
    Zend_Autoloader::Register();
}


$phpWord = new PhpWord();
$section = $phpWord->addSection();
//Absolute positioning
$text = str_repeat('Hello World! ', 15);
$wrappingStyles = array('inline', 'behind', 'infront', 'square', 'tight');
foreach ($wrappingStyles as $wrappingStyle) {
    $section->addTextBreak(5);
    $section->addText("Wrapping style {$wrappingStyle}");
    $section->addImage(
        '1.png',
        array(
            'positioning'   => 'relative',
            'marginTop'     => -1,
            'marginLeft'    => 100,
            'width'         => 80,
            'height'        => 80,
            'wrappingStyle' => $wrappingStyle,
        )
    );
    $section->addText($text);
}
//Absolute positioning
$section->addTextBreak(3);
$section->addText('Absolute positioning: see top right corner of page');
$section->addImage(
    '1.png',
    array(
        'width'            => \PhpOffice\PhpWord\Shared\Converter::cmToPixel(3),
        'height'           => \PhpOffice\PhpWord\Shared\Converter::cmToPixel(3),
        'positioning'      => \PhpOffice\PhpWord\Style\Image::POSITION_ABSOLUTE,
        'posHorizontal'    => \PhpOffice\PhpWord\Style\Image::POSITION_HORIZONTAL_RIGHT,
        'posHorizontalRel' => \PhpOffice\PhpWord\Style\Image::POSITION_RELATIVE_TO_PAGE,
        'posVerticalRel'   => \PhpOffice\PhpWord\Style\Image::POSITION_RELATIVE_TO_PAGE,
        'marginLeft'       => \PhpOffice\PhpWord\Shared\Converter::cmToPixel(15.5),
        'marginTop'        => \PhpOffice\PhpWord\Shared\Converter::cmToPixel(1.55),
    )
    );

//Relative positioning
$section->addTextBreak(3);
$section->addText('Relative positioning: Horizontal position center relative to column,');
$section->addText('Vertical position top relative to line');
$section->addImage(
    '1.png',
    array(
        'width'            => \PhpOffice\PhpWord\Shared\Converter::cmToPixel(3),
        'height'           => \PhpOffice\PhpWord\Shared\Converter::cmToPixel(3),
        'positioning'      => \PhpOffice\PhpWord\Style\Image::POSITION_RELATIVE,
        'posHorizontal'    => \PhpOffice\PhpWord\Style\Image::POSITION_HORIZONTAL_CENTER,
        'posHorizontalRel' => \PhpOffice\PhpWord\Style\Image::POSITION_RELATIVE_TO_COLUMN,
        'posVertical'      => \PhpOffice\PhpWord\Style\Image::POSITION_VERTICAL_TOP,
        'posVerticalRel'   => \PhpOffice\PhpWord\Style\Image::POSITION_RELATIVE_TO_LINE,
    )
    );
$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
$objWriter->save('helloWorld.docx');
