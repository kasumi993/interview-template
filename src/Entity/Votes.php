<?php

namespace App\Entity;

use App\Repository\VotesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VotesRepository::class)
 */
class Votes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $voteType;

    /**
     * @ORM\ManyToOne(targetEntity=Ideas::class, inversedBy="votes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ideaRef;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="votes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $VoterRef;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVoteType(): ?bool
    {
        return $this->voteType;
    }

    public function setVoteType(bool $voteType): self
    {
        $this->voteType = $voteType;

        return $this;
    }

    public function getIdeaRef(): ?Ideas
    {
        return $this->ideaRef;
    }

    public function setIdeaRef(?Ideas $ideaRef): self
    {
        $this->ideaRef = $ideaRef;

        return $this;
    }

    public function getVoterRef(): ?User
    {
        return $this->VoterRef;
    }

    public function setVoterRef(?User $VoterRef): self
    {
        $this->VoterRef = $VoterRef;

        return $this;
    }


}
