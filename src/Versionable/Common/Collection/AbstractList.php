<?php

namespace Versionable\Common\Collection;

abstract class AbstractList extends Collection implements ListInterface
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
    $this->doCheckValid($element);
    
    if ($index == 0 || $index < $this->size())
    {
      $this->elements[$index] = $element;

      return true;
    }

    throw new \OutOfBoundsException('Invalid index');
  }
  
  public function addAllAt($index, ListInterface $list)
  {
    foreach ($list as $element)
    {
      $this->doCheckValid($element);
    }
    
    $start = array_slice($this->elements, 0, $index);
    $end = array_slice($this->elements, $index);
    
    
    $this->elements = array_merge($start, $list->toArray(), $end);
    
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
    
    $this->doCheckValid($element);

    $this->elements[$index] = $element;

    return true;
  }
  
  public function subList($fromIndex, $toIndex)
  {
    if (isset($this->elements[$fromIndex]) && isset($this->elements[$toIndex]) && $fromIndex < $toIndex)
    {
      return array_slice($this->elements, $fromIndex, $toIndex - $fromIndex);
    }
    
    throw new \OutOfBoundsException('Invalid range');
  }
}
