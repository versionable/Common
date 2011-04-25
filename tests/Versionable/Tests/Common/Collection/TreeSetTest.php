<?php
namespace Versionable\Tests\Common\Collection;

use Versionable\Common\Collection\TreeSet;
use Versionable\Common\Collection\MockComparableItem;
use Versionable\Common\Order\Comparator;

/**
 * Test class for Set.
 * Generated by PHPUnit on 2011-01-10 at 13:18:12.
 */
class TreeSetTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Set
     */
    protected $object;
    
    protected $items = array();

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new TreeSet;
        
        $this->items['alpha'] = new MockComparableItem('alpha');
        $this->items['bravo'] = new MockComparableItem('bravo');
        $this->items['charlie'] = new MockComparableItem('charlie');
        $this->items['delta'] = new MockComparableItem('delta');
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }
    
    public function testAdd()
    {
      $this->items['alpha'] = new MockComparableItem('alpha');
      $this->items['bravo'] = new MockComparableItem('bravo');
      $this->items['charlie'] = new MockComparableItem('charlie');
      
      $this->object->add($this->items['charlie']);
      $this->object->add($this->items['alpha']);
      $this->object->add($this->items['bravo']);
      
      $expected = array($this->items['alpha'], $this->items['bravo'], $this->items['charlie']);
      $this->assertEquals($expected, $this->readAttribute($this->object, 'elements'));
    }
    
    public function testRemove()
    {
      $this->items['alpha'] = new MockComparableItem('alpha');
      $this->items['bravo'] = new MockComparableItem('bravo');
      $this->items['charlie'] = new MockComparableItem('charlie');
      $this->items['delta'] = new MockComparableItem('delta');
      
      $this->object->add($this->items['delta']);
      $this->object->add($this->items['alpha']);
      $this->object->add($this->items['bravo']);
      $this->object->add($this->items['charlie']);
      
      
      $this->object->remove($this->items['bravo']);
      $expected = array($this->items['alpha'], $this->items['charlie'], $this->items['delta']);
      $this->assertEquals($expected, $this->readAttribute($this->object, 'elements'));
    }

    public function testAddNoDuplicates() {
      $this->setExpectedException('\\InvalidArgumentException');
      $this->object->add($this->items['alpha']);
      $this->object->add($this->items['alpha']);
    }

    public function testAddAllNoDuplicates() {
      $this->setExpectedException('\\InvalidArgumentException');

      $this->object->add($this->items['alpha']);

      $set = new TreeSet();
      $set->add($this->items['alpha']);
      $set->add($this->items['bravo']);
      $set->add($this->items['charlie']);

      $this->object->addAll($set);
    }
    
    public function testComparator()
    {
      $comparator = new Comparator;
      $this->assertEquals($comparator, $this->object->comparator());
    }
    
    public function testComparatorCustom()
    {
      $comparator = $this->getMock('Versionable\Common\Order\ComparatorInterface');
      $this->object = new TreeSet(array(), $comparator);
      $this->assertEquals($comparator, $this->object->comparator());
    }

    public function testFirst()
    {
      $element = $this->items['alpha'];
      $this->object->add($element);
      $this->assertEquals($element, $this->object->first());
    }
    
    public function testFirstEmpty()
    {
      $this->assertNull($this->object->first());
    }

    public function testHeadSet()
    {
      $elements = array($this->items['alpha'], $this->items['bravo'], $this->items['charlie'], $this->items['delta']);

      $this->object= new TreeSet($elements);
      
      $this->assertEquals(new TreeSet(array($this->items['alpha'], $this->items['bravo'], $this->items['charlie'])), $this->object->headSet($this->items['delta']));
    }
    
    public function testHeadSetNull()
    {
      $elements = array($this->items['alpha'], $this->items['bravo'], $this->items['charlie'], $this->items['delta']);

      $this->object= new TreeSet($elements);
      
      $this->assertNull($this->object->headSet($this->items['alpha']));
    }

    public function testLast()
    {
      $elements = array($this->items['alpha'], $this->items['bravo'], $this->items['charlie']);

      $this->object= new TreeSet($elements);

      $this->assertEquals($this->items['charlie'], $this->object->last());
    }
    
    public function testLastEmpty()
    {
      $this->assertNull($this->object->last());
    }

    public function testSubSet()
    {
      $elements = array($this->items['alpha'], $this->items['bravo'], $this->items['charlie'], $this->items['delta']);

      $this->object = new TreeSet($elements);

      $this->assertEquals(new TreeSet(array_slice($elements, 2, 2)), $this->object->subSet($this->items['charlie'], $this->items['delta']));
    }

    public function testSubSetNull()
    {
      $elements = array($this->items['alpha'], $this->items['bravo'], $this->items['charlie'], $this->items['delta']);

      $this->object = new TreeSet($elements);

      $this->assertEquals(null, $this->object->subSet($this->items['bravo'], $this->items['alpha']));
    }

    public function testTailSet()
    {
      $elements = array($this->items['alpha'], $this->items['bravo'], $this->items['charlie'], $this->items['delta']);

      $this->object = new TreeSet($elements);

      $this->assertEquals(new TreeSet(array_slice($elements, 2)), $this->object->tailSet($this->items['charlie']));
    }
    
    public function testTailNull()
    {
      $elements = array($this->items['alpha'], $this->items['bravo'], $this->items['charlie'], $this->items['delta']);

      $this->object = new TreeSet($elements);

      $this->assertNull($this->object->tailSet(new MockComparableItem('echo')));
    }
}