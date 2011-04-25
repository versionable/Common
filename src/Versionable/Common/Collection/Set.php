<?php

namespace Versionable\Common\Collection;

/**
 * A unique collection of elements
 *
 */
class Set extends Collection implements SetInterface, \Serializable
{
  public function __construct(array $elements = array())
  {
    parent::__construct($elements);
  }

    /**
   * Addings element to Set unless it already exists with the set
   *
   * @param scalar $element
   * @throws \InvalidArgumentException
   * @return boolean
   */
  public function add($element)
  {
    if ($this->contains($element))
    {
      $message = 'Duplicate element added';
      throw new \InvalidArgumentException($message);
    }

    return parent::add($element);
  }

  /**
   * Adds a set of elements as long no duplicates are found
   *
   * @param CollectionInterface $collection
   * @return boolean
   */
  public function addAll(CollectionInterface $collection = NULL) 
  {
    $iterator = $collection->getIterator();

    foreach($iterator as $element) 
    {
      if ($this->contains($element))
      {
        throw new \InvalidArgumentException('Duplicate element are not allowed');
      }
    }

    return parent::addAll($collection);
  }

  public function serialize()
  {
    return \serialize($this->elements);
  }

  public function unserialize($serializedData)
  {
    $elements = @\unserialize($serializedData);

    if (is_array($elements))
    {
      foreach ($elements as $element)
      {
        $this->add($element);
      }

      return true;
    }

    throw new \InvalidArgumentException('Unable to unserialize data');
  }
}
