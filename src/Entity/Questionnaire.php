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
     * @var int
     */
    private $age;

    /**
     * @Assert\NotBlank
     * @Assert\Url
     * @var string
     */
    private $url;

    /**
     * @Assert\NotBlank
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = true
     * )
     * @var string
     */
    private $email;

    /**
     * @Assert\NotBlank
     * @Assert\Length(min = 8, max = 20, minMessage = "Min length is  {{ limit }}", maxMessage = "Max length is {{ limit }}")
     * @Assert\Regex(pattern="/^\+?[0-9]+$/", message="number_only")
     * @var string
     */
    private $phone;

    /**
     * @Assert\NotBlank
     * @Assert\Locale(
     *     canonicalize = true
     * )
     * @var string
     */
    private $locale;

    /**
     * @Assert\Type(
     *     type="string"
     * )
     * @var string
     */
    private $hobby;

    /**
     * @Assert\NotBlank
     * @Assert\Country
     * @var string
     */
    private $country;

    /**
     * @Assert\Type(
     *     type="bool"
     * )
     * @var bool
     */
    private $married;

    /**
     * @Assert\NotBlank
     * @Assert\Type(
     *     type="string"
     * )
     * @var string
     */
    private $lastName;

    /**
     * @Assert\NotBlank
     * @Assert\Type(
     *     type="string"
     * )
     * @var string
     */
    private $firstName;

    /**
     * @Assert\NotNull
     * @Assert\Date
     * @var \DateTime
     */
    private $dateOfBirth;

    /**
     * @return int|null
     */
    public function getAge(): ?int
    {
        return $this->age;
    }

    /**
     * @return null|string
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @return null|string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @return null|string
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @return null|string
     */
    public function getLocale(): ?string
    {
        return $this->locale;
    }

    /**
     * @return null|string
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * @return bool|null
     */
    public function getMarried(): ?bool
    {
        return $this->married;
    }

    /**
     * @return null|string
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @return null|string
     */
    public function getHobby(): ?string
    {
        return $this->hobby;
    }

    /**
     * @return null|string
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @return \DateTime|null
     */
    public function getDateOfBirth(): ?\DateTime
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
     * @param null|string $email
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    /**
     * @param null|string $hobby
     */
    public function setHobby(?string $hobby): void
    {
        $this->hobby = $hobby;
    }

    /**
     * @param null|string $url
     */
    public function setUrl(?string $url): void
    {
        $this->url = $url;
    }

    /**
     * @param null|string $phone
     */
    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @param null|string $locale
     */
    public function setLocale(?string $locale): void
    {
        $this->locale = $locale;
    }

    /**
     * @param bool|null $married
     */
    public function setMarried(?bool $married): void
    {
        $this->married = $married;
    }

    /**
     * @param null|string $country
     */
    public function setCountry(?string $country): void
    {
        $this->country = $country;
    }

    /**
     * @param null|string $lastName
     */
    public function setLastName(?string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @param null|string $firstName
     */
    public function setFirstName(?string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @param \DateTime|null $dateOfBirth
     */
    public function setDateOfBirth(?\DateTime $dateOfBirth): void
    {
        $this->dateOfBirth = $dateOfBirth;
    }
}
