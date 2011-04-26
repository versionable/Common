<?php

namespace Versionable\Common\Collection;

abstract class GenericList extends Collection implements ListInterface
{
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
    if ($this->isValid($element) === false)
    {
      throw new \InvalidArgumentException('Invalid element value for collection');
    }
    
    if ($index == 0 || $index < $this->size())
    {
      $this->elements[$index] = $element;

      return true;
    }

    throw new \OutOfBoundsException('Invalid index');
  }
  
  public function addAllAt($index, ListInterface $elements)
  {
    foreach ($elements as $element)
    {
      if ($this->isValid($element) === false)
      {
        throw new \InvalidArgumentException('Invalid element value for collection');
      }
    }
    
    $start = array_slice($this->elements, 0, $index);
    $end = array_slice($this->elements, $index);
    
    $this->elements = array_merge($start, $elements, $end);
  }

  public function get($index)
  {
    if ($index < $this->size())
    {
      return $this->elements[$index];
    }
    
    throw new \OutOfBoundsException('Invalid index');
  }
  
  public function indexOf($element)
  {
    foreach($this->elements as $index => $elem)
    {
      if ($elem === $element)
      {
        return $index;
      }
    }
    
    return false;
  }
  
  public function removeAt($index)
  {
    if (isset($this->elements[$index]))
    {
      unset($this->elements[$index]);
      
      return true;
    }
    
    return false;
  }

  public function set($index, $element) 
  {
    if (!isset($this->elements[$index])) 
    {
      throw new \OutOfBoundsException('Invalid index');
    }
    
    if ($this->isValid($element) === false)
    {
      throw new \InvalidArgumentException('Invalid element value for collection');
    }

    $this->elements[$index] = $element;

    return true;
  }
  
  public function subList($fromIndex, $toIndex)
  {
    if (isset($this->elements[$fromIndex]) && isset($this->elements[$toIndex]))
    {
      return array_splice($this->elements, $fromIndex, $toIndex - $fromIndex);
    }
    
    throw new \OutOfBoundsException('Invalid range');
  }
}
