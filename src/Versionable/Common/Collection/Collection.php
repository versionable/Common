<?php

namespace Versionable\Common\Collection;

abstract class Collection implements CollectionInterface
{
  protected $elements = array();

  public function __construct(array $elements = array())
  {
    $this->doAddAll($elements);
  }
  
  /**
   * Adds a new element to the collection
   *
   * @return boolean
   */
  public function add($element) 
  {
    $this->doCheckValid($element);
    
    $this->elements[] = $element;
  }
  
  /**
   * Adds all the elements to the array
   *
   * @param CollectionInterface $collection
   */
  public function  addAll(CollectionInterface $collection = NULL) 
  {
    $elements = $collection->toArray();
    
    $this->doAddAll($elements);

    return true;
  }
  
  /**
   * Returns whether a element exists in the collection
   *
   * @return boolean
   */
  public function contains($element) 
  {
    return \in_array($element, $this->elements, true);
  }
  

  /**
   *
   * @param CollectionInterface $collection
   * @return boolean
   */
  public function  containsAll(CollectionInterface $collection) 
  {
    $iterator = $collection->getIterator();
    foreach ($iterator as $element) 
    {
      if (!$this->contains($element)) 
      {
        return false;
      }
    }

    return true;
  }
  
  /**
   * Implements Countable.
   * Returns the number of elements in the collection
   *
   * @return integer
   */
  public function count()
  {
    return count($this->elements);
  }
  
  public function clear()
  {
    $this->elements = array();
  }

  /**
   * Implements ArrayAgregator
   *
   * @return \ArrayIterator
   */
  public function getIterator() 
  {
    return new \ArrayIterator($this->elements);
  }
  
  /**
   * Returns the hash code
   * 
   * @return string
   */
  public function hashCode()
  {
    return sha1(__CLASS__ . serialize($this->elements));
  }

  /**
   * Returns whether the collection is empty or not
   *
   * @return boolean
   */
  public function isEmpty()
  {
    return empty($this->elements);
  }

  public function isValid($element) 
  {
    if (is_object($element))
    {
      return true;
    }
    
    return false;
  }

  /**
   * Removes the specified element
   *
   * @return boolean
   */
  public function remove($element) 
  {
    $key = array_search($element, $this->elements);
       
    if ($key !== false) 
    {
      unset($this->elements[$key]);

      $this->elements = array_merge(array(), $this->elements);

      return true;
    }

    return false;
  }

  /**
   * Removes all the elements found in the passed collection
   *
   * @param CollectionInterface $collection
   * @return boolean
   */
  public function removeAll(CollectionInterface $collection = NULL) 
  {

    if (is_null($collection)) 
    {
      $this->elements = array();
    }
    
    else
    {
      $iterator = $collection->getIterator();

      foreach($iterator as $index => $element) 
      {
        if ($this->contains($element)) 
        {
          while(array_search($element, $this->elements) !== false)
          {
            $this->remove($element);
          }
        }
      }
    }

    return true;
  }

  /**
   * Retains elements that are common to both collections
   *
   * @param CollectionInterface $collection
   * @return boolean
   */
  public function retainAll(CollectionInterface $collection = NULL) 
  {

    if (is_null($collection)) 
    {
      $this->elements = array();
    }
    else
    {
      $elements = array();

      $iterator = $collection->getIterator();
      foreach($iterator as $element)
      {
        if(\in_array($element, $this->elements))
        {
          $elements[] = $element;
        }
      }

      $this->elements = $elements;
    }

    return true;
  }

  /**
   * Returns the collection elements as an array
   *
   * @return array
   */
  public function toArray()
  {
    return $this->elements;
  }
  
  protected function doAddAll($elements)
  {   
    foreach ($elements as $element)
    {
      $this->doCheckValid($element);
    }
    
    $this->elements = \array_merge($this->elements, $elements);
  }
  
  protected function doCheckValid($element)
  {
    if ($this->isValid($element) === false)
    {
      throw new \InvalidArgumentException('Invalid element value for collection');
    }    
  }
}
