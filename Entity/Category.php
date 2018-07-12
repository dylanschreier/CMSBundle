<?php

namespace App\CMSBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\CMSBundle\Repository\CategoryRepository")
 */
class Category {

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
	 * @ORM\Column(type="string", length=255)
	 */
	private $permalink;

	/**
	 * @ORM\OneToMany(targetEntity="App\CMSBundle\Entity\Post", mappedBy="category", orphanRemoval=true)
	 */
	private $posts;

	/**
	 * Category constructor.
	 */
	public function __construct() {
		$this->posts = new ArrayCollection();
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
	 * @param Post $post
	 */
	public function addPost(Post $post): void {
		if (!$this->posts->contains($post)) {
			$this->posts[] = $post;
			$post->setCategory($this);
		}
	}

	/**
	 * @param Post $post
	 */
	public function removePost(Post $post): void {
		if ($this->posts->contains($post)) {
			$this->posts->removeElement($post);
			if ($post->getCategory() === $this) {
				$post->setCategory(null);
			}
		}
	}

}
