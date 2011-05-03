<?php

namespace Versionable\Common\Collection;

interface MapInterface extends \IteratorAggregate, \Countable
{
  public function clear();
  
  public function containsKey($key);
  
  public function containsValue($value);
  
  public function entrySet();
  
  public function equals(MapInterface $map);
  
  public function get($key);
  
  public function hashCode();
  
  public function isEmpty();
  
  public function isValid($element);

  public function keySet();
  
  public function put($key, $value);
  
  public function putAll(MapInterface $map);
  
  public function remove($key);
  
  public function values();
}
