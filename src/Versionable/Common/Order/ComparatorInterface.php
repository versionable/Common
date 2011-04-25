<?php

namespace Versionable\Common\Order;

interface ComparatorInterface
{
  /**
   * Compares its two arguments for order
   * 
   * @return integer a negative integer, zero, or a positive integer as the first argument is less than, equal to, or greater than the second
   */
  public function compare(ComparableInterface $object1, ComparableInterface $object2);
  
  /**
   * 
   * @return boolean true only if the specified object is also a comparator and it imposes the same ordering as this comparator
   */
  public function equals(ComparableInterface $object);
}
