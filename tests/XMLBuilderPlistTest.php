<?php
class XMLBuilderPlistTest extends PHPUnit_Framework_TestCase
{
    function testFoo() {
        $b = xml_builder(array('class' => 'XML_Builder_Plist'));

        $b->entry(array('xmlns'=>XML_Builder::NS_ATOM))
            ->id_('tag:example.com,2005:1')
            ->title_('hoge')
            ->author->name_('foo')->_
            ->updated_(new DateTime)
            ->content_(123)
        ->_;

        $binary = $b->_render();

        $plist = new CFPropertyList\CFPropertyList;
        $plist->parse($binary);
        $array = $plist->toArray();

        self::assertArrayHasKey('@xmlns', $array);
        self::assertArrayHasKey('id', $array);
        self::assertArrayHasKey('title', $array);
        self::assertArrayHasKey('author', $array);
        self::assertArrayHasKey('updated', $array);
        self::assertArrayHasKey('content', $array);
    }
}
