<?php

namespace Api\Entity;

use Api\Repository\BookRepository;
use ApiPlatform\Metadata\ApiResource;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Shared\Bundles\Book\Entity\Book as BaseBook;
use Shared\Contract\Enum\DiscriminatorContext;

#[ApiResource]
#[ORM\Entity(repositoryClass: BookRepository::class)]
class Book extends BaseBook
{
    public function __construct()
    {
        $this->discriminator = DiscriminatorContext::API;
        $this->createdAt = new DateTimeImmutable;
        $this->updatedAt = new DateTimeImmutable;
        $this->uuid = Uuid::uuid1();
    }
}
