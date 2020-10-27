<?php
/**
 * Created by PhpStorm.
 * User: adm
 * Date: 27.10.2020
 * Time: 11:40
 */
declare(strict_types=1);

namespace App\Model\User\Entity\Service;

use Ramsey\Uuid\Uuid;

class ConfirmTokenizer
{
    public function generate() : Uuid
    {
        return Uuid::uuid4()->toString();
    }

}