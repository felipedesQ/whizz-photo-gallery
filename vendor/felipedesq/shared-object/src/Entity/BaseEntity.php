<?php

namespace Whizz\SharedObject\Entity;

use Whizz\SharedObject\Application\Exception\RuntimeException;
use Whizz\SharedObject\Domain\ValueObject\EntityUuid;
use Whizz\SharedObject\Domain\ValueObject\Status;
use Whizz\SharedObject\Domain\ValueObject\EntityId;
use Doctrine\ORM\Mapping as ORM;

abstract class BaseEntity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=36, unique=true, nullable=false)
     */
    protected $uuid;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer", options={"default": Status::STATUS_ACTIVE})
     */
    protected $status = Status::STATUS_ACTIVE;

    /**
     * @var \DateTimeImmutable
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    protected $createdAt;

    /**
     * @var \DateTimeImmutable
     *
     * @ORM\Column(name="modified_at", type="datetime", nullable=false)
     */
    protected $modifiedAt;

    /**
     * @ORM\PrePersist
     */
    public function addUuid()
    {
        if (is_null($this->uuid)) {
            $this->setUuid(KegstarUuid::generate());
        }
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updateTimestamps()
    {
        $this->setModifiedAt(new \DateTimeImmutable());
        if (is_null($this->createdAt)) {
            $this->setCreatedAt(new \DateTimeImmutable());
        }
    }

    protected function getImmutable($date): \DateTimeImmutable
    {
        if ($date instanceof \DateTimeImmutable) {
            return $date;
        }
        if (!$date instanceof \DateTime) {
            throw new RuntimeException(sprintf('Invalid object given to getImmutable. Instance of %s given', get_class($date)));
        }
        return \DateTimeImmutable::createFromMutable($date);
    }

    //TODO: Type hint return variable. This is not done yet as tracking (and other modules?) need updating because of their type hints
    public function getId()
    {
        return EntityId::fromInteger($this->id);
    }

    public function setId(EntityId $id): self
    {
        $this->id = $id->toInteger();

        return $this;
    }

    //TODO: Type hint return variable. This is not done yet as tracking (and other modules?) need updating because of their type hints
    public function getUuid()
    {
        return KegstarUuid::fromString($this->uuid);
    }

    public function setUuid(KegstarUuid $uuid): self
    {
        $this->uuid = $uuid->toString();

        return $this;
    }

    public function setStatus(Status $status)
    {
        $this->status = $status->toInteger();
    }

    public function getStatus(): Status
    {
        return Status::fromInteger($this->status);
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->getImmutable($this->createdAt);
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getModifiedAt(): \DateTimeImmutable
    {
        return $this->getImmutable($this->modifiedAt);
    }

    public function setModifiedAt(\DateTimeImmutable $modifiedAt)
    {
        $this->modifiedAt = $modifiedAt;
        return $this;
    }
}
