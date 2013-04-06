<?php
require dirname(__FILE__) . '/../vendor/autoload.php';

$builders = array(
    'plist' => xml_builder(array('class'=>'plist')),
    'xmlwriter' => xml_builder(array(
        'class'=>'xmlwriter',
        'formatOutput'=>false,
    )),
    'dom' => xml_builder(array(
        'class' => 'dom',
        'formatOutput' => false,
    )),
    'json' => xml_builder(array('class' => 'json')),
    'serialize' => xml_builder(array('class' => 'serialize')),
);

foreach ($builders as $name => $b) {
    $start = microtime(true);

    $b->root
        ->_do(function($b){
            for ($i=0; $i<1000; $i++) {
                $b->xmlElem('hoge')->xmlText($i)->xmlEnd();
            }
        })
    ->_;

    $arr = $b->_render();
    echo "$name: ", microtime(true) - $start, PHP_EOL;
}
