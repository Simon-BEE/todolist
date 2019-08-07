<?php
namespace App\Model\Entity;

use Core\Model\Entity;

class TaskEntity extends Entity
{
    private $id;
    private $name;
    private $created_at;
    private $done_at;

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of created_at
     */ 
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     *
     * @return  self
     */ 
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get the value of done_at
     */ 
    public function getDoneAt()
    {
        return $this->done_at;
    }

    /**
     * Set the value of done_at
     *
     * @return  self
     */ 
    public function setDoneAt($done_at)
    {
        $this->done_at = $done_at;

        return $this;
    }
}