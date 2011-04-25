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
}
