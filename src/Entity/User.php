<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=255, nullable=false)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="dni", type="string", length=9, nullable=false)
     */
    private $dni;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     */
    private $password;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="registry_date", type="date", nullable=false)
     */
    private $registryDate;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="unregistry_date", type="date", nullable=true)
     */
    private $unregistryDate;

    /**
     * @var array|null
     *
     * @ORM\Column(name="posts", type="array", length=0, nullable=true)
     */
    private $posts;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Profile", inversedBy="user")
     * @ORM\JoinTable(name="users_profiles",
     *   joinColumns={
     *     @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="profile_id", referencedColumnName="id")
     *   }
     * )
     */
    private $profile;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->profile = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getDni(): ?string
    {
        return $this->dni;
    }

    public function setDni(string $dni): self
    {
        $this->dni = $dni;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRegistryDate(): ?\DateTimeInterface
    {
        return $this->registryDate;
    }

    public function setRegistryDate(\DateTimeInterface $registryDate): self
    {
        $this->registryDate = $registryDate;

        return $this;
    }

    public function getUnregistryDate(): ?\DateTimeInterface
    {
        return $this->unregistryDate;
    }

    public function setUnregistryDate(?\DateTimeInterface $unregistryDate): self
    {
        $this->unregistryDate = $unregistryDate;

        return $this;
    }

    public function getPosts(): ?array
    {
        return $this->posts;
    }

    public function setPosts(?array $posts): self
    {
        $this->posts = $posts;

        return $this;
    }

    /**
     * @return Collection|Profile[]
     */
    public function getProfile(): Collection
    {
        return $this->profile;
    }

    public function addProfile(Profile $profile): self
    {
        if (!$this->profile->contains($profile)) {
            $this->profile[] = $profile;
        }

        return $this;
    }

    public function removeProfile(Profile $profile): self
    {
        if ($this->profile->contains($profile)) {
            $this->profile->removeElement($profile);
        }

        return $this;
    }

}
