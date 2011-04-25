<?php

namespace Versionable\Common\Collection;

abstract class GenericList extends Collection implements ListInterface
{
  public function set($index, $element) 
  {
    if (!isset($this->elements[$index])) 
    {
      throw new \OutOfBoundsException('Invalid index');
    }

    $this->elements[$index] = $element;

    return true;
  }

  /**
   * Inserts the specified element at the specified position in this list.
   * Shifts the element currently at that position (if any) and any subsequent elements to the right (adds one to their indices).
   *
   * @param integer $index
   * @param mixed $element
   * @return <type>
   */
  public function addAt($index, $element) 
  {
    if ($index == 0 || $index < $this->size())
    {
      $this->elements[$index] = $element;

      return true;
    }

    throw new \OutOfBoundsException('Invalid index');
  }
}
