<?php

namespace App\Entity;

use App\Repository\IdeasRepository;
use App\Repository\VotesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=IdeasRepository::class)
 */
class Ideas
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $ideaTitle;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ideaContent;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="ideas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ideaAuthor;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity=Votes::class, mappedBy="ideaRef", orphanRemoval=true)
     */
    private $votes;

    public function __construct()
    {
        $this->votes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdeaTitle(): ?string
    {
        return $this->ideaTitle;
    }

    public function setIdeaTitle(string $ideaTitle): self
    {
        $this->ideaTitle = $ideaTitle;

        return $this;
    }

    public function getIdeaContent(): ?string
    {
        return $this->ideaContent;
    }

    public function setIdeaContent(string $ideaContent): self
    {
        $this->ideaContent = $ideaContent;

        return $this;
    }

    public function getIdeaAuthor(): ?User
    {
        return $this->ideaAuthor;
    }

    public function setIdeaAuthor(?User $ideaAuthor): self
    {
        $this->ideaAuthor = $ideaAuthor;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection|Votes[]
     */
    public function getVotes(): Collection
    {
        return $this->votes;
    }

    public function getVotesCount(VotesRepository $VotesRepo){
        $positive=$VotesRepo->findBy(["VoterRef"=>"id","voteType"=>"1"]);
        $negative=$VotesRepo->findBy(["VoterRef"=>"id","voteType"=>"0"]);

        $positiveNbr=array_count_values($positive);
        $negativeNbr=array_count_values($negative);

        return array($positiveNbr,$negativeNbr);
    }

    public function addVote(Votes $vote): self
    {
        if (!$this->votes->contains($vote)) {
            $this->votes[] = $vote;
            $vote->setIdeaRef($this);
        }

        return $this;
    }

    public function removeVote(Votes $vote): self
    {
        if ($this->votes->removeElement($vote)) {
            // set the owning side to null (unless already changed)
            if ($vote->getIdeaRef() === $this) {
                $vote->setIdeaRef(null);
            }
        }

        return $this;
    }
}
