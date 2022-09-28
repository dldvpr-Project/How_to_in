<?php

namespace App\Entity;

use App\Repository\LanguageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LanguageRepository::class)]
class Language
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\OneToMany(mappedBy: 'language', targetEntity: Definition::class, orphanRemoval: true)]
    private Collection $definitions;

    public function __construct()
    {
        $this->definitions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return Collection<int, Definition>
     */
    public function getDefinitions(): Collection
    {
        return $this->definitions;
    }

    public function addDefinition(Definition $definition): self
    {
        if (!$this->definitions->contains($definition)) {
            $this->definitions->add($definition);
            $definition->setLanguage($this);
        }

        return $this;
    }

    public function removeDefinition(Definition $definition): self
    {
        if ($this->definitions->removeElement($definition)) {
            // set the owning side to null (unless already changed)
            if ($definition->getLanguage() === $this) {
                $definition->setLanguage(null);
            }
        }

        return $this;
    }
}
