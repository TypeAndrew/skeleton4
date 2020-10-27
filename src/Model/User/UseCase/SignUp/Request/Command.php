<?php

declare(strict_types=1);

namespace App\Model\User\UseCase\SignUp\Request;


class Command
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var \DateTimeImmutable
     */
    private $date;
    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $passwordHash;
}