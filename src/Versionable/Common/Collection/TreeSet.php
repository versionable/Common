<?php

namespace Versionable\Common\Collection;

use Versionable\Common\Compare\Comparator;
use Versionable\Common\Compare\ComparatorInterface;
use Versionable\Common\Compare\ComparableInterface;

class TreeSet extends Set implements SortedSetInterface
{
  protected $comparator = null;
  
  public function __construct(array $elements = array(), ComparatorInterface $comparator = null)
  {
    parent::__construct($elements);
    
    if (false === is_null($comparator))
    {
      $this->setComparator($comparator);
    }
    
    $this->sort();
  }
    
  public function comparator()
  {
    return $this->comparator;
  }

  public function add($element)
  {
    $ret = parent::add($element);

    $this->sort();

    return $ret;
  }

  public function remove($element)
  {
    $ret = parent::remove($element);

    $this->sort();

    return $ret;
  }
  
  public function first()
  {
    if ($this->isEmpty() === false)
    {
      return $this->elements[0];
    }
    
    return null;
  }
  
  public function headSet($toElement)
  {
    $set = array();
    foreach($this->elements as $key => $element)
    {
      if ($element === $toElement && !empty($set))
      {
        $class = get_class($this);
        
        return new $class($set);
      }
      
      $set[] = $element;
    }
    
    return null;
  }
  
  public function isValid($element)
  {
    if (parent::isValid($element) && $element instanceof ComparableInterface)
    {
      return true;
    }    
    
    return false;
  }

  public function last()
  {
    if ($this->isEmpty() === false)
    {
      return $this->elements[$this->size() - 1];
    }
    
    return null;
  }
  
  public function subSet($fromElement, $toElement)
  {
    $subSet = array();    
    $inRange = false;
    
    foreach($this->elements as $key => $element)
    {

      if ($element === $fromElement)
      {
        $inRange = true;
      }
      
      if ($inRange === false)
      {
        continue;
      }
      
      $subSet[] = $element;
      
      if ($inRange && $element === $toElement)
      {
        $class = get_class($this);
        
        return new $class($subSet);
      }
    }
    
    return null;
  }
  
  public function tailSet($fromElement) 
  {
    $set = array();
    
    $found = false;
    foreach($this->elements as $key => $element)
    {
      if ($element === $fromElement)
      {
        $found = true;
      }
      
      if (false === $found)
      {
        continue;
      }
      
      $set[] = $element;
    }
    
    if ($found)
    {
      $class = get_class($this);

      return new $class($set);
    }
    
    return null;
  }
  
  protected function setComparator(ComparatorInterface $comparator)
  {
    $this->comparator = $comparator;
  }
  
  protected function sort()
  {
    if (false === is_null($this->comparator()))
    {
      usort($this->elements, array($this->comparator(), 'compare'));
    }
    else
    {
      sort($this->elements);
    }
  }
  
}
