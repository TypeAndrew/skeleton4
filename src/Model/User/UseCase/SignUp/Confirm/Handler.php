<?php
/**
 * Created by PhpStorm.
 * User: adm
 * Date: 27.10.2020
 * Time: 15:35
 */
declare(strict_types=1);

namespace App\Model\User\UseCase\SignUp\Confirm;


use App\Model\User\Entity\User\UserRepository;

class Handler
{
    private $users;
    private  $flusher;

    public function __construct(UserRepository $users, Flusher $flusher)
    {
        $this->users = $users;
        $this->flusher = $flusher;
    }

    public function handle(Command $command): void
    {
        if (!$user = $this->users->findByConfirmToken($command->token)) {
            throw new \DomainException('Incorret for confimed token.');
        }

        $user->confirmSignUp();

        $this->flusher->flush();
    }
}