<?php

namespace Versionable\Common\Collection;

use Versionable\Common\Order\ComparableInterface;

class MockComparableItem implements ComparableInterface
{
  protected $name = '';
  
  public function __construct($name)
  {
    $this->name = $name;
  }
  
  public function compareTo($object)
  {
    if ($this->name < $object->name)
    {
      return -1;
    }
    
    if ($this->name > $object->name)
    {
      return 1;
    }
    
    return 0;
  }
}
