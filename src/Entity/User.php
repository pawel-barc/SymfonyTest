<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[UniqueEntity( fields: ['email'], message: 'This email is already registered')]
#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 40)]
    #[Assert\NotBlank(message: 'The name field can not be empty')]
    #[Assert\Length(
        min: 2,
        minMessage: 'The firstname field must contain at least two characters',
        max: 40,
        maxMessage: "The firstname field can't contain more than 40 characters"
    )]
    private ?string $firstname = null;

    #[ORM\Column(length: 40, nullable: true)]
    #[Assert\Length(
        max: 40,
        maxMessage: 'The field lastname can not contain more than 40 characters'
    )]
    private ?string $lastname = null;

    #[ORM\Column(length: 40, unique: true)]
    #[Assert\NotBlank(message: 'Email field is required')]
    #[Assert\Email(message: 'Enter the correct email')]
    private ?string $email = null;

    #[ORM\Column]
    #[Assert\Positive(message: 'Age can not be negative')]
    #[Assert\NotBlank(message: 'Age is required')]
    private ?int $age = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;
    #[ORM\Column(type: 'json')]
    private array $roles = [];

    public function getId(): ?int
    {
        return $this->id;
    }
//FirstName////////////////////////////////////////////////
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    //LastName/////////////////////////////////////////////
    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;
        return $this;
    }
//Password//////////////////////////////////////////////////
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self 
    {
        $this->password = $password;

        return $this;
    }

//Email////////////////////////////////////////////////
    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }
//Age///////////////////////////////////////////////////
    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): static
    {
        $this->age = $age;

        return $this;
    }

//Roles/////////////////////////////////////////////////
    public function getRoles() : array
    {
        return $this->roles ?: ['ROLE_USER'] ;
    }

    public function setRoles(array $roles) 
    {
        $this->roles = $roles;
        return $this;
    }
    public function getUserIdentifier() : string
    {
        return $this->email;
    }

    public function eraseCredentials() : void 
    {
        // Just in case
    }
}
