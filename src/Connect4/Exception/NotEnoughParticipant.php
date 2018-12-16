<?php

declare(strict_types=1);

namespace App\Connect4\Exception;

use RuntimeException;

final class NotEnoughParticipant extends RuntimeException
{
    public function __construct($numberParticipant)
    {
        parent::__construct("Il n'y a pas assez de participants pour ce jeu. Il y a actuellement '".$numberParticipant."'");
    }
}