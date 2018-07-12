<?php

namespace App\CMSBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\CMSBundle\Repository\CategoryRepository")
 */
class Post {

	/**
	 * @ORM\Id()
	 * @ORM\GeneratedValue()
	 * @ORM\Column(type="integer")
	 */
	private $id;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private $name;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private $description;

	/**
	 * @ORM\Column(type="text")
	 */
	private $content;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private $permalink;

	/**
	 * @ORM\Column(type="datetime")
	 */
	private $publishDate;

	/**
	 * @ORM\Column(type="boolean")
	 */
	private $isPublishDateDisplayed = true;

	/**
	 * @ORM\Column(type="boolean")
	 */
	private $isCommentsAllowed = true;

	/**
	 * @ORM\Column(type="boolean")
	 */
	private $isEnabled = true;

	/**
	 * @ORM\ManyToOne(targetEntity="App\CMSBundle\Entity\Category", inversedBy="posts")
	 * @ORM\JoinColumn(nullable=false)
	 */
	private $category;

	/**
	 * @ORM\OneToMany(targetEntity="App\CMSBundle\Entity\Comment", mappedBy="post", orphanRemoval=true)
	 */
	private $comments;

	/**
	 * Post constructor.
	 */
	public function __construct() {
		$this->comments = new ArrayCollection();
	}

	/**
	 * @return int
	 */
	public function getId(): int {
		return $this->id;
	}

	/**
	 * @return null|string
	 */
	public function getName(): ?string {
		return $this->name;
	}

	/**
	 * @param string $name
	 */
	public function setName(string $name): void {
		$this->name = $name;
	}

	/**
	 * @return string
	 */
	public function getDescription(): string {
		return $this->description;
	}

	/**
	 * @param string $description
	 */
	public function setDescription(string $description): void {
		$this->description = $description;
	}

	/**
	 * @return string
	 */
	public function getContent(): string {
		return $this->content;
	}

	/**
	 * @param string $content
	 */
	public function setContent(string $content): void {
		$this->content = $content;
	}

	/**
	 * @return string
	 */
	public function getPermalink(): string {
		return $this->permalink;
	}

	/**
	 * @param string $permalink
	 */
	public function setPermalink(string $permalink): void {
		$this->permalink = $permalink;
	}

	/**
	 * @return \DateTime
	 */
	public function getPublishDate(): \DateTime {
		return $this->publishDate;
	}

	/**
	 * @param \DateTime $publishDate
	 */
	public function setPublishDate(\DateTime $publishDate): void {
		$this->publishDate = $publishDate;
	}

	/**
	 * @return bool
	 */
	public function isPublishDateDisplayed():bool {
		return $this->isPublishDateDisplayed;
	}

	/**
	 * @param bool $isPublishDateDisplayed
	 */
	public function setIsPublishDateDisplayed(bool $isPublishDateDisplayed): void {
		$this->isPublishDateDisplayed = $isPublishDateDisplayed;
	}

	/**
	 * @return bool
	 */
	public function isCommentsAllowed(): bool {
		return $this->isCommentsAllowed;
	}

	/**
	 * @param bool $isCommentsAllowed
	 */
	public function setIsCommentsAllowed(bool $isCommentsAllowed): void {
		$this->isCommentsAllowed = $isCommentsAllowed;
	}

	/**
	 * @return bool
	 */
	public function isEnabled(): bool {
		return $this->isEnabled;
	}

	/**
	 * @param bool $isEnabled
	 */
	public function setIsEnabled(bool $isEnabled): void {
		$this->isEnabled = $isEnabled;
	}

	/**
	 * @return Category
	 */
	public function getCategory(): Category {
		return $this->category;
	}

	/**
	 * @param Category $category
	 */
	public function setCategory(Category $category): void {
		$this->category = $category;
	}

	/**
	 * @param Comment $comment
	 */
	public function addComment(Comment $comment): void {
		if (!$this->comments->contains($comment)) {
			$this->comments[] = $comment;
			$comment->setPost($this);
		}
	}

	/**
	 * @param Comment $comment
	 */
	public function removeComment(Comment $comment): void {
		if ($this->comments->contains($comment)) {
			$this->comments->removeElement($comment);
			if ($comment->getPost() === $this) {
				$comment->setPost(null);
			}
		}
	}
}
