<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Dinosaur;
use App\Enum\HealthStatus;
use PHPUnit\Framework\TestCase;

class DinosaurTest extends TestCase
{

  public function testCanGetAndSetData(): void
  {
    $dino = new Dinosaur(
      name: "Dinus",
      genus: "Tyrannosaurus",
      length: 15,
      enclosure: 'Paddock A'
    );

    self::assertSame('Dinus', $dino->getName());
    self::assertSame('Tyrannosaurus', $dino->getGenus());
    self::assertSame(15, $dino->getLength());
    self::assertSame('Paddock A', $dino->getEnclosure());
  }

  /**
   * @dataProvider sizeDescriptionProvider
   */
  public function testDinosaurHasCorrectSizeDescriptionFromLength(int $length, string $expectedSize): void
  {
    $dino = new Dinosaur(name: 'Big eaty', length: $length);
    self::assertSame($expectedSize, $dino->getSizeDescription(), );
  }

  public function sizeDescriptionProvider(): \Generator
  {
    yield '10 Meter Large Dino' => [10, 'Large'];
    yield '5 Meter Medium Dino' =>[5, 'Medium'];
    yield '4 Meter Small Dino' =>[4, 'Small'];
  }

  public function testIsAcceptingVisitorsByDefault(): void
  {
    $dino = new Dinosaur('Dennis');

    self::assertTrue($dino->isAcceptingVisitors());
  }

  /**
   * @return void
   * @dataProvider healthStatusProvider
   */
  public function testIsAcceptingVisitorsBasedOnHealthStatus(HealthStatus $healthStatus, bool $expectedVisitorStatus): void
  {
    $dino = new Dinosaur('Charlie');
    $dino->setHealth($healthStatus);


    self::assertSame($expectedVisitorStatus, $dino->isAcceptingVisitors());
  }

  public function healthStatusProvider():\Generator
  {
    yield 'Sick Dino is not accepting visitors' => [HealthStatus::SICK, false];
    yield 'Hungry Dino is accepting visitors' => [HealthStatus::HUNGRY, true];
  }
}