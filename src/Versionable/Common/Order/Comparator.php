<?php

namespace Versionable\Common\Order;

class Comparator implements ComparatorInterface
{
  public function compare(ComparableInterface $object1, ComparableInterface $object2)
  {
    return $object1->compareTo($object2);
  }
  
  public function equals(ComparableInterface $object)
  {
    return $this->equals($object);
  }
}
