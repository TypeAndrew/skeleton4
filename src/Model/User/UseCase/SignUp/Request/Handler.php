<?php

declare(strict_types=1);

namespace App\Model\User\UseCase\SignUp\Request;


use App\Model\Flusher;
use App\Model\User\Entity\User\Email;
use App\Model\User\Entity\User\Id;
use App\Model\User\Entity\User\User;
use App\Model\User\Entity\User\UserRepository;
use App\Model\User\Entity\User\PasswordHasher;
//use App\Model\User\Entity\User\User;
//use Doctrine\ORM\EntityManagerInterface;
//use PharIo\Manifest\Email;
//use Ramsey\Uuid\Uuid;


class Handler
{

    private $users;
    private $hasher;
    private $tokenizer;
    private $sender;
    private $flusher;

    public function __construct(
        UserRepository $users,
        PasswordHasher $hasher,
        ConfirmTokenizer $tokenizer,
        ConfirmTokenSender $sender,
        Flusher $flusher)
    {
        $this->users = $users;
        $this->hasher = $hasher;
        $this->tokenizer = $tokenizer;
        $this->sender = $sender;
        $this->flusher = $flusher;
    }

    public function handle(Command $command): void
    {
        $email = new Email($command->enail);

        if ($this->users->hasByEmail($Email)){
            throw new \DomainException('User already exist');
        }

        $user = User::signUpByEmail(
            Id::next(),
            new \DateTimeImmutable(),
            $Email,
            this->hasher->hash($command->passwword),
             $this->tokinizer->generate()
        )

        $this->users->add($user);

        $this->sender->send($email, $token);

        $this->flusher->flush();
    }
}
//class Handler0
//{
//    private $em;
//




  //  public function __construct(EntityManagerInterface $em)
    //{
      //  $this->em = $em;
    //}

    //public function handle(Command $command): void
    //{
      //  $email = mb_strtolower($command->email);

       // if ($this->em->getRepository(User::class)->findOneBy(['email' => $email])) {
         //   throw new DomainException('user already exist.');
        //}

        //$user = new User(
         //   Uuid::uuid4()->toString(),
           // new \DateTimeImmutable(),
            //$email,
            //password_hash($command->password, PASSWORD_ARGON2I)

        //);

        //$this->em->persist($user);

        //$this->

        //$this->em->flush();
    //}
//}