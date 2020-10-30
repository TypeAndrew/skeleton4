<?php

declare(strict_types=1);

namespace App\Model\User\Entity\User;


use Doctrine\Common\Collections\ArrayCollection;
use Monolog\DateTimeImmutable;

class User
{
    private const STATUS_WAIT = 'wait';
    private const STATUS_ACTIVE = 'active';
    private const STATUS_NEW = 'new';
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
    /**
     * @var string|null
     */
    private $confirmToken;
    /**
     * @var string
     */
    private $status;
    /**
     * @var Netwowork[]|ArrayCollection
     */
    private $networks;

    public function __construct(Id $id, \DataTimeImmutable $date)
    {
        $this->id = $id;
        $this->date = $date;
        $this->confirmToken = $token;
        $this->status = self::STATUS_NEW;
        $this->networks = new ArrayCollection();
    }

    public static function signUpByEmail(Id $id, \DateTimeImmutable $date, Email $email, string $hash, string $token): void
    {
        if(!this->isNew()) {
            throw new \DomainException('User is already signed up.');
        }
        $this->email = $email;
        $this->passwordHash = $hash;
        $this->confirmToken = $token;
        $this->status = self::STATUS_WAIT;
    }

    public static function signUpByNetwork(Id $id, \DateTimeImmutable $date, string $network, string $hash, string $identity): void
    {
        if(!this->isNew()) {
            throw new \DomainException('User is already signed up.');
         }
        $this->networks->add(new Network($this, $network, $identity));
        $this->status = self::STATUS_ACTIVE;

    }

    private function attachNetwork(string $network, string $identity): void
    {

        foreach($this->networks as $existing) {
            if ($existing->isForNetwork($network)){
                throw new \DomainException('Network is already attached');
            }
            $this->status === self::STATUS_NEW;
        }


    }

    public function confirmSignUp(): void
    {
        if(!$this->isWait()){
            throw new \DomainException('user is already confirm.');
        }
        $this->status = self::STATUS_ACTIVE;
        $this->confirmToken = null;
    }
    public function isWait() : bool
    {
        return $this->status === self::STATUS_WAIT;
    }

    public function isActive() : bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    public function isNew() : bool
    {
        return $this->status === self::STATUS_NEW;
    }

    public function getEmail(): Email
    {
            return $this->email;
    }

    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }

    public function getConfirmToken(): ?string
    {
        return $this->confirmToken;
    }

    public function getId(): Id
    {
        return $this->id;
    }

    public function getDate(): \DateTimeImmutable
    {
        return $this->date;
    }
}