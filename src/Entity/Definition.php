<?php

namespace App\Entity;

use App\Repository\DefinitionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Type;

#[ORM\Entity(repositoryClass: DefinitionRepository::class)]
class Definition
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?string $title = null;

    #[ORM\Column, Type(Types::TEXT)]
    private ?string $body = null;

    #[ORM\ManyToOne(inversedBy: 'definitions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Language $language = null;

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     */
    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return text|null
     */
    public function getBody(): ?string
    {
        return $this->body;
    }

    /**
     * @param text|null $body
     */
    public function setBody(?text $body): void
    {
        $this->body = $body;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getLanguage(): ?Language
    {
        return $this->language;
    }

    public function setLanguage(?Language $language): self
    {
        $this->language = $language;

        return $this;
    }


}