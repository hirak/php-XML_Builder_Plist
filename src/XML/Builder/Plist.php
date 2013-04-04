<?php
/**
 * XML_Builder_Plist
 *
 * Property List
 *
 * @author    Hiraku NAKANO <hiraku@tojiru.net>
 * @license   https://github.com/hirak/php-XML_Builder/blob/master/LICENSE MIT License
 * @link      https://packagist.org/packages/hiraku/xml_builder
 */
use CFPropertyList as plist;

class XML_Builder_Plist extends XML_Builder_Array
{
    function xmlRender()
    {
        $plist = new plist\CFPropertyList;
        $detect = new plist\CFTypeDetector;

        $struct = $detect->toCFType(current($this->xmlArray));
        $plist->add($struct);

        return $plist->toBinary();
    }

    function xmlElem($name, $class=__CLASS__)
    {
        return parent::xmlElem($name, $class);
    }
}
