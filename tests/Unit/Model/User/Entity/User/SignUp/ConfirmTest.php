<?php
/**
 * Created by PhpStorm.
 * User: adm
 * Date: 27.10.2020
 * Time: 16:31
 */

declare(strict_types=1);

namespace App\Tests\Unit\Model\User\Entity\User\SignUp;


use App\Model\User\Entity\User\Email;
use App\Model\User\Entity\User\Id;
use App\Model\User\Entity\User\User;
use PHPUnit\Framework\TestCase;


class ConfirmTest extends TestCase
{
    public function testSuccess(): void
    {
        //$user = $this->buildSignedUpUser();
        $user = new User(
            Id::next(),
            new \DateTimeImmutable(),
            new Email('test@app.test'),
            'hash',
            $token = 'token'
            );


        $user->confirmSignUp();

        self::assertFalse($user->isWait());
        self::assertTrue($user->isActive());

        self::assertNull($user->getConfirmToken());
    }

    /*public function testAlready(): void
    {
       // $user = $this->buildSignedUpUser();

        $user = new User(
            Id::next(),
            new \DateTimeImmutable(),
            new Email('test@app.test'),
            'hash',
            $token = 'token'
        );
        $user->confirmSignUp();
        $this->expectExceptionMessage('User is already confirmed.');
        $user->confirmSignUp();
    }*/

    /*  private function buildSignedUpUser(): User
      {

          return;
      }*/
}