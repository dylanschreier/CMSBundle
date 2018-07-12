<?php

namespace App\CMSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\CMSBundle\Repository\CommentRepository")
 */
class Comment {

	/**
	 * @ORM\Id()
	 * @ORM\GeneratedValue()
	 * @ORM\Column(type="integer")
	 */
	private $id;

	/**
	 * @ORM\Column(type="text")
	 */
	private $content;

	/**
	 * @ORM\ManyToOne(targetEntity="App\CMSBundle\Entity\Post", inversedBy="comments")
	 * @ORM\JoinColumn(nullable=false)
	 */
	private $post;

	/**
	 * @return int
	 */
	public function getId(): int {
		return $this->id;
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
	 * @return Post
	 */
	public function getPost(): Post {
		return $this->post;
	}

	/**
	 * @param Post $post
	 */
	public function setPost(Post $post): void {
		$this->post = $post;
	}

}
