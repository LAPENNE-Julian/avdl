<?php

namespace App\Models;

abstract class CoreModel
{
    /**
     * @var int
     */
    protected $id;
    /**
     * @var string
     */
    protected $created_at;
    /**
     * @var string
     */
    protected $updated_at;

    abstract public static function find($id);

    abstract public static function findAll();

    abstract public function insert();

    abstract public function update();

    abstract public function delete();
    
    //save object in database
    public function save()
    {
        //if object have an id, insert else update database
        if ($this->id === null) {
            return $this->insert();
        } else {
            return $this->update();
        }
    }

    /**
     * Get the value of id
     *
     * @return int|null
     */ 
    public function getId() : ?int
    {
        return $this->id;
    }

    /**
     * Get the value of created_at
     *
     * @return  string
     */ 
    public function getCreatedAt() : string
    {
        return $this->created_at;
    }

    /**
     * Get the value of updated_at
     *
     * @return  string
     */ 
    public function getUpdatedAt() : string
    {
        return $this->updated_at;
    }
}
