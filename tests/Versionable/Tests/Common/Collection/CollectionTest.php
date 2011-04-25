<?php
namespace Versionable\Tests\Common\Collection;

use Versionable\Common\Collection\Collection;

/**
 * Test class for Collection.
 * Generated by PHPUnit on 2011-01-10 at 13:18:20.
 */
class CollectionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Collection
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = $this->getMockForAbstractClass('\Versionable\Common\Collection\Collection');
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }
    
    public function testClear()
    {
      $this->object->add(100);
      
      $this->object->clear();
      
      $this->assertEmpty($this->readAttribute($this->object, 'elements'));
    }

    /**
     * @todo Implement testSize().
     */
    public function testSize()
    {
      $elements = $this->readAttribute($this->object, 'elements');
      $this->assertEquals(count($elements), $this->object->size());
    }

    /**
     * @todo Implement testIsEmpty().
     */
    public function testIsEmpty()
    {
      $elements = $this->readAttribute($this->object, 'elements');
      $this->assertEquals(empty($elements), $this->object->isEmpty());
      $this->object->add(1);
      $elements = $this->readAttribute($this->object, 'elements');
      $this->assertEquals(empty($elements), $this->object->isEmpty());
    }
    
    public function testHashCode()
    {
      $expected = sha1('Versionable\Common\Collection\Collection' . serialize($this->readAttribute($this->object, 'elements')));
      $this->assertEquals($expected, $this->object->hashCode());
    }

    /**
     * @todo Implement testContains().
     */
    public function testContains()
    {
      $elements = $this->readAttribute($this->object, 'elements');
      $element = 100;
      $this->assertEquals(array_search($element, $elements), $this->object->contains($element));

      $this->object->add($element);
      $elements = $this->readAttribute($this->object, 'elements');
      $this->assertEquals(in_array($element, $elements), $this->object->contains($element));
    }

    /**
     * @todo Implement testAdd().
     */
    public function testAdd()
    {
      $element = 100;
      $elements = $this->readAttribute($this->object, 'elements');
      $this->assertFalse(in_array($element, $elements));
      $this->object->add($element);
      $elements = $this->readAttribute($this->object, 'elements');
      $this->assertEquals(in_array($element, $elements), $this->object->contains($element));
    }

    public function testRemoveTrue()
    {
      $element = 100;
      $this->object->add($element);
      $this->assertTrue($this->object->remove(100));
      $elements = $this->readAttribute($this->object, 'elements');
      $this->assertFalse(in_array($element, $elements));
    }
    
    public function testRemoveFalse()
    {
      $element = 100;
      $this->assertFalse($this->object->remove(1000));
      $elements = $this->readAttribute($this->object, 'elements');
      $this->assertFalse(in_array($element, $elements));
    }

    /**
     * @todo Implement testContainsAll().
     */
    public function testContainsAll()
    {
      $this->object->add(100);
      $this->object->add(200);
      $this->object->add(300);
      $this->object->add(400);

      $contains = $this->getMockForAbstractClass('\\Versionable\\Common\\Collection\\Collection');
      $contains->add(200);
      $contains->add(400);

      $this->assertTrue($this->object->containsAll($contains));

      $contains = $this->getMockForAbstractClass('\\Versionable\\Common\\Collection\\Collection');
      $contains->add(500);
      $this->assertFalse($this->object->containsAll($contains));

    }

    /**
     * @todo Implement testAddAll().
     */
    public function testAddAll()
    {

      $this->object->add(200);
      $this->object->add(400);

      $add = $this->getMockForAbstractClass('\\Versionable\\Common\\Collection\\Collection');
      $add->add(100);
      $add->add(300);

      $this->assertTrue($this->object->addAll($add));
      $elements = $this->readAttribute($this->object, 'elements');
      $this->assertEquals($elements, array(200,400, 100, 300));
    }

    /**
     * @todo Implement testRemoveAll().
     */
    public function testRemoveAll()
    {
      $this->object->add(100);
      $this->object->add(200);
      $this->object->add(300);
      $this->object->add(400);

      $remove = $this->getMockForAbstractClass('\\Versionable\\Common\\Collection\\Collection');
      $remove->add(200);
      $remove->add(400);

      $this->assertTrue($this->object->removeAll($remove));

      $elements = $this->readAttribute($this->object, 'elements');
      $this->assertEquals($elements, array(100,300));

      $this->assertTrue($this->object->removeAll());

      $elements = $this->readAttribute($this->object, 'elements');
      $this->assertEquals($elements, array());
    }

    /**
     * @todo Implement testRetainAll().
     */
    public function testRetainAll()
    {
      $this->object->add(100);
      $this->object->add(200);
      $this->object->add(300);
      $this->object->add(400);

      $retain = $this->getMockForAbstractClass('\\Versionable\\Common\\Collection\\Collection');
      $retain->add(200);
      $retain->add(400);

      $this->assertTrue($this->object->retainAll($retain));

      $elements = $this->readAttribute($this->object, 'elements');
      $this->assertEquals($elements, array(200,400));

      $this->assertTrue($this->object->retainAll());

      $elements = $this->readAttribute($this->object, 'elements');
      $this->assertEquals($elements, array());
    }

    /**
     * @todo Implement testToArray().
     */
    public function testToArray()
    {
      $this->object->add(100);
      $this->object->add(200);
      $this->object->add(300);
      $this->object->add(400);

      $elements = $this->readAttribute($this->object, 'elements');
      $this->assertEquals($this->object->toArray(), $elements);
    }

    /**
     * @todo Implement testGetIterator().
     */
    public function testGetIterator()
    {
      $this->assertEquals(new \ArrayIterator, $this->object->getIterator());
    }

    /**
     * @todo Implement testIsValid().
     */
    public function testIsValid()
    {
      $this->assertTrue($this->object->isValid('anything'));
    }
}