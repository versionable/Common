<?php
namespace Versionable\Tests\Common\Collection;


use \Versionable\Common\Collection\MockComparableItem;

class MockComparableItemTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Collection
     */
    protected $object;
    
    protected $elements = array();

    protected function setUp()
    {
        $this->object = new MockComparableItem('mock');
    }

    protected function tearDown()
    {
    } 
    
    public function testConstruct()
    {
      $name = 'mymockname';
      $this->object = new MockComparableItem($name);
      
      $this->assertEquals($name, $this->readAttribute($this->object, 'name'));
    }
    
    public function testCompareToLess()
    {
      $less = new MockComparableItem('thisisgreater');
      
      $this->assertEquals(-1, $this->object->compareTo($less));
    }
    
    public function testCompareToMore()
    {
      $less = new MockComparableItem('less');
      
      $this->assertEquals(1, $this->object->compareTo($less));
    }
    
    public function testCompareToEqual()
    {
      $less = new MockComparableItem('mock');
      
      $this->assertEquals(0, $this->object->compareTo($less));
    }
    
}
