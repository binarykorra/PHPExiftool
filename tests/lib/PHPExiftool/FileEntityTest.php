<?php

namespace PHPExiftool;

class FileEntityTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var FileEntity
     */
    protected $object;

    /**
     * @covers PHPExiftool\FileEntity::__construct
     */
    protected function setUp()
    {
        $dom = new \DOMDocument();
        $dom->loadXML(file_get_contents(__DIR__ . '/../../files/ExifTool.xml'));

        $this->object = new FileEntity(new \SplFileInfo('testFile'), $dom, new \PHPExiftool\RDFParser());
    }

    /**
     * @covers PHPExiftool\FileEntity::getIterator
     */
    public function testGetIterator()
    {
        $this->assertInstanceOf('\\Iterator', $this->object->getIterator());
    }

    /**
     * @covers PHPExiftool\FileEntity::getFile
     */
    public function testGetFile()
    {
        $this->assertInstanceOf('\\SplFileInfo', $this->object->getFile());
    }

    /**
     * @covers PHPExiftool\FileEntity::getMetadatas
     */
    public function testGetMetadatas()
    {
        $this->assertInstanceOf('\\PHPExiftool\Driver\Metadata\MetadataBag', $this->object->getMetadatas());
        $this->assertEquals(348, count($this->object->getMetadatas()));
    }

    /**
     * @covers PHPExiftool\FileEntity::executeQuery
     */
    public function testExecuteQuery()
    {
        $this->assertInstanceOf('\\PHPExiftool\\Driver\\Value\\Mono', $this->object->executeQuery('IFD0:Copyright'));
        $this->assertEquals('Copyright 2004 Phil Harvey', $this->object->executeQuery('IFD0:Copyright')->asString());

        $this->assertInstanceOf('\\PHPExiftool\\Driver\\Value\\Binary', $this->object->executeQuery('CIFF:FreeBytes'));

        $this->assertInstanceOf('\\PHPExiftool\\Driver\\Value\\Multi', $this->object->executeQuery('XMP-dc:Subject'));
        $this->assertEquals(array('ExifTool', 'Test', 'XMP'), $this->object->executeQuery('XMP-dc:Subject')->asArray());
    }

}
