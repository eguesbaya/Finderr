<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $category;

    /**
     * @ORM\Column(type="integer")
     */
    private int $level;

    /**
     * @ORM\OneToMany(targetEntity=Skill::class, mappedBy="user")
     */
    private Skill $skill;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private date $memberSince;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $country;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private string $city;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private string $socialNetwork;

    /**
     * @ORM\OneToOne(targetEntity=Sexe::class, cascade={"persist", "remove"})
     */
    private Sexe $sexe;

    public function __construct()
    {
        $this->skill = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): self
    {
        $this->level = $level;

        return $this;
    }

    /**
     * @return Collection|Skill[]
     */
    public function getSkill(): Collection
    {
        return $this->skill;
    }

    public function addSkill(Skill $skill): self
    {
        if (!$this->skill->contains($skill)) {
            $this->skill[] = $skill;
            $skill->setUser($this);
        }

        return $this;
    }

    public function removeSkill(Skill $skill): self
    {
        if ($this->skill->removeElement($skill)) {
            // set the owning side to null (unless already changed)
            if ($skill->getUser() === $this) {
                $skill->setUser(null);
            }
        }

        return $this;
    }

    public function getMemberSince(): ?\DateTimeInterface
    {
        return $this->memberSince;
    }

    public function setMemberSince(?\DateTimeInterface $memberSince): self
    {
        $this->memberSince = $memberSince;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getSocialNetwork(): ?string
    {
        return $this->socialNetwork;
    }

    public function setSocialNetwork(?string $socialNetwork): self
    {
        $this->socialNetwork = $socialNetwork;

        return $this;
    }

    public function getSexe(): ?Sexe
    {
        return $this->sexe;
    }

    public function setSexe(?Sexe $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }
}
