<?php
namespace App\Model\Entity;

use Core\Model\Entity;

class CategoryEntity extends Entity
{
    private $id;
    private $name;
    private $slug;
    private $created_at;
    private $posts;

    /**
     * Get the value of id
     */ 
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of slug
     */ 
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * Set the value of slug
     *
     * @return  self
     */ 
    public function setSlug(string $slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get the value of created_at
     */ 
    public function getCreatedAt(): Datetime
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     *
     * @return  self
     */ 
    public function setCreatedAt(Datetime $created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get the value of posts
     */ 
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * Set the value of posts
     *
     * @return  self
     */ 
    public function setPosts($posts)
    {
        $this->posts = $posts;

        return $this;
    }
}