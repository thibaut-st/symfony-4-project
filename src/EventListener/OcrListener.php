<?php

namespace App\EventListener;

use App\Entity\Ocr;
use App\Entity\User;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class OcrListener
 * @package App\EventListener
 */
class OcrListener
{
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * OcrListener constructor.
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @param Ocr $ocr
     */
    public function prePersist(Ocr $ocr)
    {
        $ocr->setOwner($this->tokenStorage->getToken()->getUser());
    }
}