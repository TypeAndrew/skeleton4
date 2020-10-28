<?php
/**
 * Created by PhpStorm.
 * User: adm
 * Date: 27.10.2020
 * Time: 11:42
 */
declare(strict_types=1);

namespace App\Model\User\Entity\Service;


class PasswordHasher
{
    public function hash(string $password): string
    {
        $hash = password_hash($password, PASSWORD_ARGON2I);
        if ($hash ===false){
            throw new \RuntimeException('Unable to generate hash.');
        }
        return $hash;
    }

}