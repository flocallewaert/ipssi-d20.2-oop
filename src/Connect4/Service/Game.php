<?php

declare(strict_types=1);

namespace App\Connect4\Service;

use App\Connect4\Entity\Piece;
use App\Connect4\Entity\Player; // my own class
use App\Connect4\Entity\Board;
use App\Connect4\Exception\NotEnoughParticipant;
use App\Game as GameInterface; // need this use because of the namespace change
use Support\Renderer\Output;
use Support\Service\RandomValue;
use App\Connect4\Entity\Participant; // my own class

final class Game implements GameInterface
{
    private $output;
    private $participants;
    /**
     * @var RandomValue
     */
    private $randomValueGenerator;
    private $board;

    public function __construct(Output $output, RandomValue $randomValueGenerator, Participant ...$participants)
    {
        $this->validateCorrectParticipants($participants);
        $this->validateEnoughParticipants($participants);
        // some validation
        $this->output = $output;
        $this->participants = $participants;
        $this->randomValueGenerator = $randomValueGenerator;
        $this->board = new Board();
    }

    public function run(): Output
    {
        $output->writeLine(sprintf('Initialisation du jeu avec %d participants.', count($participants)));

        $this->selectFirstPlayer();
        // add some stuff here

        return $this->output;
    }
    
    private function validateCorrectParticipants($participant) {
        array_walk($participants, function (Participant $participant) {
            if (!$participant instanceof Player) {
                throw new \RuntimeException(sprintf(
                    'Les participants doivent être des %s pour pouvoir jouer, au moins un de ceux fourni est un %s',
                    Player::class,
                    get_class($participant)
                ));
            }
        });
    }

    
    private function validateEnoughParticipants($participant) {

    }

    private function selectFirstPlayer(): Player
    {
        /*
        if(\count($this->participants) < 1){
            throw new \LogicialException(sprintf(
                'Il doit y avoir des participants pour pouvoir jouer, le nombre actuel de participants est de ',
                \count($this->participants)
            ));
        }
        */
        $this->output->writeLine("Choix aléatoire de l'identifiant du premier participant");
        $participantRandomIndex = $this->randomValueGenerator->generateRandomInt( 0, \count($this->participants) );
        $this->output->writeLine("Le joueur ".$participantRandomIndex." commence."); // to comment
        
        // return $this->participants[$participantRandomIndex];

        return new Player();
    }
}