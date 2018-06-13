<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Validator\Constraints as AdhesionAssert;

/**
 * Joining
 *
 * @ORM\Table(name="joining")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\JoiningRepository")
 *
 * @AdhesionAssert\ContainsPhonenumber
 */
class Joining
{
    const GENDER_MALE = 'M';
    const GENDER_FEMALE = 'F';
    const GENDER_UNKNOWN = '?';

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
     * @ORM\Column(name="isRenewed", type="boolean")
     */
     private $isRenewed;

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
     * @ORM\Column(name="gender", type="string", length=1)
     */
    private $gender;

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
     * @ORM\Column(name="department", type="string", length=255, nullable=true)
     */
    private $department;

    /**
     * @var string
     *
     * @ORM\Column(name="local_comitee", type="string", length=255, nullable=true)
     */
    private $localComitee;

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
     * @var DateTime
     *
     * @ORM\Column(name="birthdate", type="date")
     *
     * @Assert\Date()
     */
    private $birthdate;

    /**
     * @var string
     *
     * @ORM\Column(name="phonenumber", type="string", length=100, nullable=true)
     */
    private $phoneNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="mobilephone", type="string", length=100, nullable=true)
     */
    private $mobilephone;

    /**
     * @var string
     *
     * @ORM\Column(name="job", type="string", length=255, nullable=true)
     */
    private $job;

    /**
     * @var string
     *
     * @ORM\Column(name="elective_mandate", type="string", length=255, nullable=true)
     */
    private $electiveMandate;

    /**
     * @var string
     *
     * @ORM\Column(name="mandate_location", type="string", length=255, nullable=true)
     */
    private $mandateLocation;

    /**
     * @var string
     *
     * @ORM\Column(name="trade_union_commitment", type="string", length=255, nullable=true)
     */
    private $tradeUnionCommitment;

    /**
     * @var string
     *
     * @ORM\Column(name="associative_commitment", type="string", length=255, nullable=true)
     */
    private $associativeCommitment;

    /**
     * @var string
     *
     * @ORM\Column(name="responsabilities", type="string", length=255, nullable=true)
     */
    private $responsabilities;

    /**
     * @var MembershipFee
     *
     * @ORM\ManyToOne(targetEntity="MembershipFee")
     * @ORM\JoinColumn(name="membershipfee_id",
     *                 referencedColumnName="id",
     *                 nullable=true,
     *                 onDelete="SET NULL"
     * )
     */
    private $membershipFee;

    /**
     * @var string
     *
     * @ORM\Column(name="comments", type="text", nullable=true)
     */
    private $comments;

    /**
     * @var MembershipPayment
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Payment\MembershipPayment", mappedBy="attachedJoining")
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
    * @ORM\Column(name="joining_date", type="datetime")
    */
    private $joiningDatetime;

    public function __construct()
    {
        $this->joiningDatetime = new \DateTime('now');
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
        return sprintf("%s%010d", $this->getIsRenewed() ? 'R' : 'A', $this->getId());
    }

    /**
     * Set isRenewed
     *
     * @param boolean $isRenewed
     *
     * @return Joining
     */
    public function setIsRenewed($isRenewed)
    {
        $this->isRenewed = $isRenewed;

        return $this;
    }

    /**
     * Get isRenewed
     *
     * @return boolean
     */
    public function getIsRenewed()
    {
        return $this->isRenewed;
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
     * Set gender
     *
     * @param string $gender
     *
     * @return Joining
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
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
     * Set birthdate
     *
     * @param \DateTime $birthdate
     *
     * @return Joining
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    /**
     * Get birthdate
     *
     * @return \DateTime
     */
    public function getBirthdate()
    {
        return $this->birthdate;
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
     * Set mobilephone
     *
     * @param string $mobilephone
     *
     * @return Joining
     */
    public function setMobilephone($mobilephone)
    {
        $this->mobilephone = $mobilephone;

        return $this;
    }

    /**
     * Get mobilephone
     *
     * @return string
     */
    public function getMobilephone()
    {
        return $this->mobilephone;
    }

    /**
     * Set job
     *
     * @param string $job
     *
     * @return Joining
     */
    public function setJob($job)
    {
        $this->job = $job;

        return $this;
    }

    /**
     * Get job
     *
     * @return string
     */
    public function getJob()
    {
        return $this->job;
    }

    /**
     * Set electiveMandate
     *
     * @param string $electiveMandate
     *
     * @return Joining
     */
    public function setElectiveMandate($electiveMandate)
    {
        $this->electiveMandate = $electiveMandate;

        return $this;
    }

    /**
     * Get electiveMandate
     *
     * @return string
     */
    public function getElectiveMandate()
    {
        return $this->electiveMandate;
    }

    /**
     * Set mandateLocation
     *
     * @param string $mandateLocation
     *
     * @return Joining
     */
    public function setMandateLocation($mandateLocation)
    {
        $this->mandateLocation = $mandateLocation;

        return $this;
    }

    /**
     * Get mandateLocation
     *
     * @return string
     */
    public function getMandateLocation()
    {
        return $this->mandateLocation;
    }

    /**
     * Set tradeUnionCommitment
     *
     * @param string $tradeUnionCommitment
     *
     * @return Joining
     */
    public function setTradeUnionCommitment($tradeUnionCommitment)
    {
        $this->tradeUnionCommitment = $tradeUnionCommitment;

        return $this;
    }

    /**
     * Get tradeUnionCommitment
     *
     * @return string
     */
    public function getTradeUnionCommitment()
    {
        return $this->tradeUnionCommitment;
    }

    /**
     * Set associativeCommitment
     *
     * @param string $associativeCommitment
     *
     * @return Joining
     */
    public function setAssociativeCommitment($associativeCommitment)
    {
        $this->associativeCommitment = $associativeCommitment;

        return $this;
    }

    /**
     * Get associativeCommitment
     *
     * @return string
     */
    public function getAssociativeCommitment()
    {
        return $this->associativeCommitment;
    }

    /**
     * Set responsabilities
     *
     * @param string $responsabilities
     *
     * @return Joining
     */
    public function setResponsabilities($responsabilities)
    {
        $this->responsabilities = $responsabilities;

        return $this;
    }

    /**
     * Get responsabilities
     *
     * @return string
     */
    public function getResponsabilities()
    {
        return $this->responsabilities;
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
     * Set department
     *
     * @param string $department
     *
     * @return Joining
     */
    public function setDepartment($department)
    {
        $this->department = $department;

        return $this;
    }

    /**
     * Get department
     *
     * @return string
     */
    public function getDepartment()
    {
        return $this->department;
    }

    /**
     * Set localComitee
     *
     * @param string $localComitee
     *
     * @return Joining
     */
    public function setLocalComitee($localComitee)
    {
        $this->localComitee = $localComitee;

        return $this;
    }

    /**
     * Get localComitee
     *
     * @return string
     */
    public function getLocalComitee()
    {
        return $this->localComitee;
    }

    /**
     * Set membershipFee
     *
     * @param \AppBundle\Entity\MembershipFee $membershipFee
     *
     * @return Joining
     */
    public function setMembershipFee(\AppBundle\Entity\MembershipFee $membershipFee = null)
    {
        $this->membershipFee = $membershipFee;

        return $this;
    }

    /**
     * Get membershipFee
     *
     * @return \AppBundle\Entity\MembershipFee
     */
    public function getMembershipFee()
    {
        return $this->membershipFee;
    }

    /**
     * Add payment
     *
     * @param \AppBundle\Entity\Payment\MembershipPayment $payment
     *
     * @return Joining
     */
    public function addPayment(\AppBundle\Entity\Payment\MembershipPayment $payment)
    {
        $this->payments[] = $payment;

        return $this;
    }

    /**
     * Remove payment
     *
     * @param \AppBundle\Entity\Payment\MembershipPayment $payment
     */
    public function removePayment(\AppBundle\Entity\Payment\MembershipPayment $payment)
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
     * Set joiningDatetime
     *
     * @param \DateTime $joiningDatetime
     *
     * @return Joining
     */
    public function setJoiningDatetime($joiningDatetime)
    {
        $this->joiningDatetime = $joiningDatetime;

        return $this;
    }

    /**
     * Get joiningDatetime
     *
     * @return \DateTime
     */
    public function getJoiningDatetime()
    {
        return $this->joiningDatetime;
    }
}
