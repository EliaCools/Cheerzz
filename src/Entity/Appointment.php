<?php

namespace App\Entity;

use App\Repository\AppointmentRepository;
use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Date;

/**
 * @ORM\Entity(repositoryClass=AppointmentRepository::class)
 */
class Appointment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="appointments")
     * @ORM\JoinColumn(nullable=false)
     */
    private User $requestedBy;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="appointments")
     */
    private User $assignedTo;

    /**
     * @ORM\Column(type="datetime")
     */
    private DateTimeInterface $startTime;

    /**
     * @ORM\Column(type="datetime")
     */
    private DateTimeInterface $endTime;

    /**
     * Appointment constructor.
     * @param $requestedBy
     * @param $startTime
     * @param $endTime
     */
    public function __construct($requestedBy, $startTime, $endTime)
    {
        $this->requestedBy = $requestedBy;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRequestedBy(): User
    {
        return $this->requestedBy;
    }


    public function getAssignedTo(): ?User
    {
        return $this->assignedTo;
    }

    public function setAssignedTo(User $assignedTo): self
    {
        $this->assignedTo = $assignedTo;

        return $this;
    }

    public function getStartTime(): DateTimeInterface
    {
        return $this->startTime;
    }

    public function setStartTime(DateTimeInterface $startTime): self
    {
        $this->startTime = $startTime;

        return $this;
    }

    public function getEndTime(): DateTimeInterface
    {
        return $this->endTime;
    }

    public function setEndTime(DateTimeInterface $endTime): self
    {
        $this->endTime = $endTime;

        return $this;
    }
}
