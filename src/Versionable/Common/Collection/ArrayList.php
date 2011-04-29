<?php

namespace Versionable\Common\Collection;

/**
 * General purpose list
 */
class ArrayList extends AbstractList implements ListInterface
{
  public function removeRange($fromIndex, $toIndex)
  {
    if (isset($this->elements[$fromIndex]) && isset($this->elements[$toIndex]) && $fromIndex < $toIndex)
    {
      $start = array_slice($this->elements, 0, $fromIndex);
      
      $end = array_slice($this->elements, $toIndex);
      $this->elements = array_merge($start, $end);
      
      return;
    }
    
    throw new \OutOfBoundsException('Invalid range');
  }
}
