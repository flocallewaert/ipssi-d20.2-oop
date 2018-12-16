<?php

declare(strict_types=1);

namespace App\Connect4\Entity;

final class Piece
{
    private const RED = 'rouge';
    private const YELLOW = 'jaune';
    private $color;

    private function __construct(string $color)
    {
        $this->color = $color;
    }

    public function __toString(): string
    {
        return $this->color;
    }

    public static function createRed(): Piece
    {
        return new self(self::RED);
    }

    public static function createYellow(): Piece
    {
        return new self(self::YELLOW);
    }
}