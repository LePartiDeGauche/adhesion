<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Donation
 *
 * @ORM\Table(name="donation")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DonationRepository")
 *
 */
class Donation
{
    const PAYMENT_MODE_ONLINE = 'online';
    const PAYMENT_MODE_ONSITE = 'onsite';

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="postal_code", type="string", length=10)
     */
    private $postalCode;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=255, nullable=true)
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     *
     * @Assert\Email(
     *     message = "L'adresse « {{ value }} » n'est pas une adresse de courriel valide.",
     * )
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="phonenumber", type="string", length=100, nullable=true)
     */
    private $phoneNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="comments", type="text", nullable=true)
     */
    private $comments;

    /**
     * @var string
     *
     * @ORM\Column(name="amount", type="float")
     */
    private $amount;

    /**
     * @var MembershipPayment
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Payment\DonationPayment")
     * @ORM\JoinTable(name="donation_payments",
     *      joinColumns={@ORM\JoinColumn(name="donation_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="payment_id", referencedColumnName="id", unique=true)}
     * )
     */
    private $payments;

    /**
     * @var string
     *
     * @ORM\Column(name="payment_mode", type="string", length=255, nullable=true)
     */
    private $paymentMode;

    /**
    * @var DateTime
    *
    * @ORM\Column(name="created_at", type="datetime")
    */
    private $createdAt;

    public function __construct()
    {
        $this->createdAt = new \DateTime('now');
        $this->paymentMode = self::PAYMENT_MODE_ONLINE;
        $this->payments = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function getReference()
    {
        return sprintf("D%010d");
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return Joining
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return Joining
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Joining
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set postalCode
     *
     * @param string $postalCode
     *
     * @return Joining
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * Get postalCode
     *
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return Joining
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return Joining
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Joining
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set phoneNumber
     *
     * @param string $phoneNumber
     *
     * @return Joining
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * Get phoneNumber
     *
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * Set comments
     *
     * @param string $comments
     *
     * @return Joining
     */
    public function setComments($comments)
    {
        $this->comments = $comments;

        return $this;
    }

    /**
     * Get comments
     *
     * @return string
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Add payment
     *
     * @param \AppBundle\Entity\Payment\DonationPayment $payment
     *
     * @return Donation
     */
    public function addPayment(\AppBundle\Entity\Payment\DonationPayment $payment)
    {
        $this->payments[] = $payment;

        return $this;
    }

    /**
     * Remove payment
     *
     * @param \AppBundle\Entity\Payment\DonationPayment $payment
     */
    public function removePayment(\AppBundle\Entity\Payment\DonationPayment $payment)
    {
        $this->payments->removeElement($payment);
    }

    /**
     * Get payments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPayments()
    {
        return $this->payments;
    }

    /**
     * Set paymentMode
     *
     * @param string $paymentMode
     *
     * @return Joining
     */
    public function setPaymentMode($paymentMode)
    {
        $this->paymentMode = $paymentMode;

        return $this;
    }

    /**
     * Get paymentMode
     *
     * @return string
     */
    public function getPaymentMode()
    {
        return $this->paymentMode;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set amount.
     *
     * @param float $amount
     *
     * @return Donation
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount.
     *
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set createdAt.
     *
     * @param \DateTime $createdAt
     *
     * @return Donation
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
