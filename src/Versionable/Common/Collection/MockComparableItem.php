<?php

namespace Versionable\Common\Collection;

use Versionable\Common\Compare\ComparableInterface;

class MockComparableItem implements ComparableInterface
{
  protected $name = '';
  
  public function __construct($name)
  {
    $this->name = $name;
  }
  
  public function getName()
  {
    return $this->name;
  }


  public function compareTo($object)
  {
    if ($this->getName() < $object->getName())
    {
      return -1;
    }
    
    if ($this->getName() > $object->getName())
    {
      return 1;
    }
    
    return 0;
  }
}
