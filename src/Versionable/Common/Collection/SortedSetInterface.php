<?php

namespace Versionable\Common\Collection;

interface SortedSetInterface extends SetInterface
{

  /**
   * Returns the comparator used to order the elements in this set, or null if this set uses the natural ordering of its elements
   *
   * @returns Comparator|null
   */
  public function comparator();

  /**
   * Returns the first (lowest) element currently in this set.
   *
   * @return mixed
   */
  public function first();

  /**
   * Returns a view of the portion of this set whose elements are strictly less than toElement.
   *
   * @param mixed $toElement
   * @return SortedSet
   */
  public function headSet($toElement);

  /**
   * Returns the last (highest) element currently in this set.
   *
   * @return mixed
   */
  public function last();

  /**
   * Returns a view of the portion of this set whose elements range from fromElement, inclusive, to toElement, exclusive.
   *
   * @return SortedSet
   */
  public function subSet($fromElement, $toElement);

  /**
   * Returns a view of the portion of this set whose elements are greater than or equal to fromElement.
   *
   * @param mixed $toElement
   * @return SortedSet
   */
  public function tailSet($fromElement);
}
