<?php

namespace Versionable\Common\Collection;

interface ListInterface extends CollectionInterface
{

  /**
   * Sets an element as a specific index
   *
   * @throws
   * @returns boolean
   */
  public function set($index, $element);

  public function addAt($index, $element);
  
  public function addAllAt($index, ListInterface $elements);
  
  public function get($index);
  
  public function indexOf($element);
  
  public function removeAt($index);
  
  public function subList($fromIndex, $toIndex);
}
