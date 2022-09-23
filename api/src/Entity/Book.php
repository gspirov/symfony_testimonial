<?php

namespace Api\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\BookRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Shared\Bundles\Book\Entity\Book as BaseBook;
use Shared\Enum\DiscriminatorContext;

#[ORM\Entity(repositoryClass: BookRepository::class)]
#[ApiResource]
#[ORM\InheritanceType('SINGLE_TABLE')]
#[ORM\DiscriminatorColumn('discriminator')]
#[ORM\DiscriminatorMap([
    'api' => self::class
])]
class Book extends BaseBook
{
    public function __construct()
    {
        $this->discriminator = DiscriminatorContext::API;
        $this->createdAt = new DateTimeImmutable;
    }
}
