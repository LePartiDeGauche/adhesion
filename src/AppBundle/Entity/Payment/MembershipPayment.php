<?php

namespace AppBundle\Entity\Payment;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Joining;

/**
 * MembershipPayment.
 *
 * @ORM\Entity
 */
class MembershipPayment extends Payment
{
    /**
     * @var \stdClass
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Joining", inversedBy="payments")
     */
    protected $attachedJoining;

    /**
     * Get referenceIdentifierPrefix.
     *
     * @return string
     * @overrides
     */
    public function getReferenceIdentifierPrefix()
    {
        return sprintf("%s %s %s",
            $this->getAttachedJoining()->getReference(),
            $this->getAttachedJoining()->getLastname(),
            $this->getAttachedJoining()->getFirstname()
        );
    }

    /**
     * Set attachedRegistration.
     *
     * @param Joining $attachedJoining
     *
     * @return MembershipPayment
     */
    public function setAttachedJoining(Joining $attachedJoining)
    {
        $this->attachedJoining = $attachedJoining;

        return $this;
    }

    /**
     * Get attachedJoining.
     *
     * @return Joining
     */
    public function getAttachedJoining()
    {
        return $this->attachedJoining;
    }

    public function __construct(Joining $joining = null, Adherent $author = null)
    {
        parent::__construct();
        // $this->author = $author;
        $this->attachedJoining = $joining;
    }
}
