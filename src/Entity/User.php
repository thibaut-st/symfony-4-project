<?php
/**
 * Created by PhpStorm.
 * User: X3900147
 * Date: 17/04/2018
 * Time: 14:38
 */

namespace App\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class User
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{

    /**
     * @var string $id
     *
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="guid")
     */
    protected $id;

    /**
     * @var string $locale
     *
     * @ORM\Column(type="string", length=2, nullable=true, options={"default": "en"})
     *
     * @Assert\Locale()
     */
    private $locale;

    /**
     * @return null|string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @return null|string
     */
    public function getLocale(): ?string
    {
        return $this->locale;
    }

    /**
     * @param string $locale
     * @return User
     */
    public function setLocale(string $locale): self
    {
        $this->locale = $locale;

        return $this;
    }

}