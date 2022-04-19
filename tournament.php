<?php

class Tournament
{
  private $players = [];
  private $title;
  private $date;

  private const DATE_FORMAT = 'Y.m.d';
  private const DUMMY_PLAYER = 'skip';

  public function __construct($title, $date = null)
  {
    $this->title = $title;
    $this->date = $date != null
      ? DateTime::createFromFormat('Y.m.d', $date)
      : new DateTime();
    $this->date->add(new DateInterval('P1D'));
  }

  public function addPlayer($player): Tournament
  {
    $this->players[] = $player;
    return $this;
  }

  public function createPairs()
  {
    $players = $this->players;

    if (count($players) % 2 != 0) {
      $players[] = new Player(self::DUMMY_PLAYER);
    }

    $pairsSet = $this->generatePairs($players);
    $date = $this->date;
    foreach ($pairsSet as $pairs) {
      $this->echoPairs($pairs, $date);
      $date = $date->add(new DateInterval('P1D'));
    }
    echo '<br />';
  }

  private function generatePairs(&$players)
  {
    $number = count($players);
    for ($tour=0; $tour < $number-1; $tour++) {
      $pairs = [];
      for ($i = 0; $i < $number / 2; $i++) {
        $pairs[] = [$players[$i], $players[$number-1-$i]];
      }

      yield $pairs;

      $temp = $players[$number-1];
      for ($i=$number-1; $i > 1; $i--) {
        $players[$i] = $players[$i-1];
      }
      $players[1] = $temp;
    }
  }

  private function echoPairs($pairs, $date)
  {
    echo $this->title . ', ' . $date->format('d.m.Y') . '<br />';
    foreach ($pairs as $pair) {
      if ($pair[0]->getName() == self::DUMMY_PLAYER || $pair[1]->getName() == self::DUMMY_PLAYER) {
        continue;
      }
      echo $pair[0]->toString() . ' - ' . $pair[1]->toString() . '<br />';
    }
  }
}
