<?php
declare(strict_types=1);

namespace App\Entity\User;

use App\Core\Traits\Entity\TCreatedAtModel;
use App\Core\Traits\Entity\TUpdatedAtModel;
use App\Core\Traits\Entity\TUuidModel;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Ramsey\Uuid\Uuid;

/**
 * Class User
 * @package App\Entity\User
 *
 * @ORM\Entity(repositoryClass="App\Repository\User\UserRepository")
 */
class User extends BaseUser
{
    use TUuidModel;
    use TCreatedAtModel;
    use TUpdatedAtModel;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
        $this->uuid = Uuid::uuid4()->toString();
        $this->enabled = true;
    }

    public function setEmail($email)
    {
        $email = is_null($email) ? '' : $email;
        parent::setEmail($email);
        $this->setUsername($email);

        return $this;
    }
}