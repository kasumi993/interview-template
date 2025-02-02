<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\User;
use App\Entity\Votes;

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

    public function getVotesCount(){
        $votes=$this->getVotes();
        $voteType=array();
        $positive=array();
        $negative=array();
        foreach($votes as $vote){
            $vote=new Votes($vote);
            $voteType[]=$vote->getVoteType();
            $voteType==true ? $positive[]=$voteType : $negative[]=$voteType;
        }
        

        $positiveNbr=count($positive);
        $negativeNbr=count($negative);

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

    /** 
     * to recognize the ideas this user liked
     * @param \App\Entity\User $user
     * @return boolean
    */


    public function isLikedByUser(User $user):bool
    {
        foreach($this->votes as $vote){
            
            if($vote->getVoterRef() === $user) return true;
        }
        return false;
    }
}
