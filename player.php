<?php

class Player
{
  private $name;
  private $city;

  /**
   * @param $name mixed
   * @param $city mixed
   */

  public function __construct($name)
  {
    $this->name = $name;
  }

  /**
   *
   * @return mixed
   */
  public function getName()
  {
    return $this->name;
  }

  /**
   *
   * @param mixed $name
   * @return Player
   */
  public function setName($name): self
  {
    $this->name = $name;
    return $this;
  }

  /**
   *
   * @return mixed
   */
  public function getCity()
  {
    return $this->city;
  }

  /**
   *
   * @param mixed $city
   * @return Player
   */
  public function setCity($city): self
  {
    $this->city = $city;
    return $this;
  }

  public function toString(): String
  {
    return $this->name . ' ' . (!empty($this->city)  ? '(' . $this->city . ')' : '');
  }
}
