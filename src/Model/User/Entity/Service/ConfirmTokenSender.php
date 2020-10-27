<?php
/**
 * Created by PhpStorm.
 * User: adm
 * Date: 27.10.2020
 * Time: 11:40
 */
declare(strict_types=1);

namespace App\Model\User\Entity\Service;

use App\Model\User\Entity\User\Email;

interface ConfirmTokenSender
{
    public function send(Email $email, string $token): void

}