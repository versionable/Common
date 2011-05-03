<?php

namespace Versionable\Common\Collection;

use Versionable\Common\Compare\ComparableInterface;

interface CollectionInterface extends \IteratorAggregate, \Countable
{

  /**
   *
   * @return boolean
   */
  public function add($element);
  

  /**
   *
   * @return boolean
   */
  public function addAll(CollectionInterface $collection = NULL);
  
  /**
   * 
   */
  public function clear();

  /**
   *
   * @return boolean
   */
  public function contains($element);


  /**
   *
   * @return boolean
   */
  public function containsAll(CollectionInterface $collection);
    
  /**
   * 
   * @return string
   */
  public function hashCode();
  

  /**
   *
   * @return boolean
   */
  public function isEmpty();

  /**
   *
   * @return boolean
   */
  public function isValid($element);

  /**
   *
   * @return boolean
   */
  public function remove($element);

  /**
   *
   * @return boolean
   */
  public function removeAll(CollectionInterface $collection = NULL);

  /**
   *
   * @return boolean
   */
  public function retainAll(CollectionInterface $collection = NULL);
  
  /**
   *
   * @return array
   */
  public function toArray();
}
