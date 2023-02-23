<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Dinosaur;
use PHPUnit\Framework\TestCase;

class DinosaurTest extends TestCase
{

  public function testCanGetAndSetData(): void
  {
    $dino = new Dinosaur(
      name: "Dinus",
      genus: "Tyrannosaurus",
      length: 10,
      enclosure: 'Paddock A'
    );

    self::assertGreaterThan(
      $dino->getLength(),
      10,
      'Dino must be bigger than 10 meters'
    );

    self::assertSame('Dinus', $dino->getName());
    self::assertSame('Tyrannosaurus', $dino->getGenus());
    self::assertSame(10, $dino->getLength());
    self::assertSame('Paddock A', $dino->getEnclosure());
  }

}