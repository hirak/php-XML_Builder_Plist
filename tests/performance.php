<?php
class PerformanceTest extends PHPUnit_Framework_TestCase
{
    function testTimePlist() {
        $b = xml_builder(array('class'=>'XML_Builder_Plist'));

        $start = microtime(true);

        $b->root
            ->_do(function($b){
                for ($i=0; $i<1000; $i++) {
                    $b->xmlElem('hoge')->xmlText($i)->xmlEnd();
                }
            })
        ->_;

        $arr = $b->_render();
        file_put_contents('foo.plist', $arr);


        echo 'plist: ', microtime(true) - $start, PHP_EOL;
    }

    function testTimeXMLWriter() {
        $b = xml_builder(array('class'=>'xmlwriter', 'writeto'=>'foo.xml', 'formatOutput'=>false));

        $start = microtime(true);

        $b->root
            ->_do(function($b){
                for ($i=0; $i<1000; $i++) {
                    $b->xmlElem('hoge')->xmlText($i)->xmlEnd();
                }
            })
        ->_;

        $arr = $b->_render();
        //file_put_contents('foo.plist', $arr);


        echo 'xmlwriter: ', microtime(true) - $start, PHP_EOL;
    }
}
