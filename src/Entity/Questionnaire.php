<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Questionnaire
 * @package App\Entity
 */
class Questionnaire
{
    /**
     * @Assert\NotBlank
     * @Assert\Type(
     *     type="integer",
     *     message="The value {{ value }} is not a valid {{ type }}."
     * )
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Your first name must be at least {{ limit }} characters long",
     *      maxMessage = "Your first name cannot be longer than {{ limit }} characters"
     * )
     */
    protected $age;

    /**
     * @Assert\NotBlank
     * @Assert\Url
     */
    protected $url;

    /**
     * @Assert\NotBlank
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = true
     * )
     *
     */
    protected $email;

    /**
     * @Assert\NotBlank
     * @Assert\Length(min = 8, max = 20, minMessage = "Min length is 8", maxMessage = "Max length is 20")
     * @Assert\Regex(pattern="/^\+?[0-9]+$/", message="number_only")
     */
    protected $phone;

    /**
     * @Assert\NotBlank
     * @Assert\Locale(
     *     canonicalize = true
     * )
     */
    protected $locale;

    /**
     * @Assert\Type(
     *     type="string"
     * )
     */
    protected $hobby;

    /**
     * @Assert\NotBlank
     * @Assert\Country
     */
    protected $country;

    /**
     * @Assert\Type(
     *     type="bool"
     * )
     */
    protected $married;

    /**
     * @Assert\NotBlank
     * @Assert\Type(
     *     type="string"
     * )
     */
    protected $lastName;

    /**
     * @Assert\NotBlank
     * @Assert\Type(
     *     type="string"
     * )
     */
    protected $firstName;

    /**
     * @Assert\NotNull
     * @Assert\Date
     * @var string A "Y-m-d" formatted value
     */
    protected $dateOfBirth;

    /**
     * @return mixed
     */
    public function getAge(): ?int
    {
        return $this->age;
    }

    /**
     * @return mixed
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @return mixed
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @return mixed
     */
    public function getLocale(): ?string
    {
        return $this->locale;
    }

    /**
     * @return mixed
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * @return mixed
     */
    public function getMarried(): ?bool
    {
        return $this->married;
    }

    /**
     * @return mixed
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @return mixed
     */
    public function getHobby(): ?string
    {
        return $this->hobby;
    }

    /**
     * @return mixed
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @return mixed
     */
    public function getDateOfBirth(): ?string
    {
        return $this->dateOfBirth;
    }

    /**
     * @param int $age
     */
    public function setAge(int $age): void
    {
        $this->age = $age;
    }

    /**
     * @param mixed $email
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    /**
     * @param mixed $hobby
     */
    public function setHobby(?string $hobby): void
    {
        $this->hobby = $hobby;
    }

    /**
     * @param mixed $url
     */
    public function setUrl(?string $url): void
    {
        $this->url = $url;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @param mixed $locale
     */
    public function setLocale(?string $locale): void
    {
        $this->locale = $locale;
    }

    /**
     * @param mixed $married
     */
    public function setMarried(?bool $married): void
    {
        $this->married = $married;
    }

    /**
     * @param mixed $country
     */
    public function setCountry(?string $country): void
    {
        $this->country = $country;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName(?string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName(?string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @param \DateTime $dateOfBirth
     */
    public function setDateOfBirth(?\DateTime $dateOfBirth): void
    {
        $this->dateOfBirth = $dateOfBirth;
    }
}
