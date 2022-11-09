<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class Category extends CoreModel
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $color;

    /**
     * @var string
     */
    private $img;

    /**
     * @var string
     */
    private $slug;


    /**
     * Get the value of name
     *
     * @return  string
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param  string  $name
     */ 
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * Get the value of color
     */ 
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set the value of color
     */ 
    public function setColor($color)
    {
        $this->color = $color;
    }

    /**
     * Get the value of img
     *
     * @return  string|null
     */ 
    public function getImg()
    {
        return $this->img;
    }

    /**
     * Set the value of img
     *
     * @param  string  $img
     */ 
    public function setImg(string $img)
    {
        $this->img = $img;
    }

    /**
     * Get the value of slug
     */ 
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set the value of slug
     */ 
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * Get category by Id
     * 
     * @param int $categoryId ID category
     * @return Category
     */
    public static function find($categoryId)
    {
        $pdo = Database::getPDO();

        $sql = '
            SELECT *
            FROM category
            WHERE id = :id
        ';
        
        // prepare() return PDOStatement object
        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->execute([':id' => $categoryId]);
        $result = $pdoStatement->fetchObject(self::class);
        
        return $result;
    }

    /**
     * Get All category
     * 
     * @return Category[]
     */
    public static function findAll()
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM `category`';
        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->execute();
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);
        
        return $results;
    }

    public function insert()
    {
        $pdo = Database::getPDO();

        $sql = '
        INSERT INTO category (name, color, img, slug)
        VALUES (:name, :color, :img, :slug)
        ';

        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->bindValue(':name', $this->name);
        $pdoStatement->bindValue(':color', $this->color);
        $pdoStatement->bindValue(':img', $this->img);
        $pdoStatement->bindValue(':slug', $this->slug);

        $queryWorked = $pdoStatement->execute();

        // $queryWorked return a boolean if the request work
        if ($queryWorked) {
            $this->id = $pdo->lastInsertId();

            return true;
        } else {
            return false;
        }
    }

    /**
     * Update category
     */
    public function update()
    {
        $pdo = Database::getPDO();

        $sql = '
            UPDATE `category`
            SET
                `name` = :name,
                `color` = :color,
                `img` = :img,
                `slug` = :slug,
                `updated_at` = NOW()
            WHERE id = :id
        ';

        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->bindValue(':name', $this->name);
        $pdoStatement->bindValue(':color', $this->color);
        $pdoStatement->bindValue(':img', $this->img);
        $pdoStatement->bindValue(':slug', $this->slug);
        $pdoStatement->bindValue(':id', $this->id);

        return $pdoStatement->execute();
    }

    /**
     * Delete category
     */
    public function delete()
    {
        $pdo = Database::getPDO();

        $sql = '
            DELETE FROM `category`
            WHERE `id` = :id
        ';
        
        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->bindValue(':id', $this->id);

        return $pdoStatement->execute();
    }

    //-----
    // static method
    //-----

    /**
     * Get all categories
     * 
     * @return JSON
     */
    public static function browse()
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM `category`';

        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->execute();
        $results = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    /**
     * Get anecdotes by category
     * 
     * @param int $categoryId ID of anecdote
     * @return JSON
     */
    public static function browseAnecdotes($categoryId){

        $pdo = Database::getPDO();
        $sql = 'SELECT 
        `anecdote`.`id`, 
        `anecdote`.`title`, 
        `anecdote`.`description`, 
        `anecdote`.`content`,
        `anecdote`.`img`,
        `anecdote`.`source`,
        `anecdote`.`created_at`,
        
        (SELECT `category_id`
                    FROM `anecdote_category`
                    WHERE `anecdote_id` = `anecdote`.`id` LIMIT 1 OFFSET 0) AS `categoryId1`,
        (SELECT `name`
                    FROM `category`
                    WHERE `category`.`id` = `categoryId1`) AS `categoryName1`,
        (SELECT `color`
                    FROM `category`
                    WHERE `category`.`id` = `categoryId1`) AS `categoryColor1`,
        (SELECT `slug`
                    FROM `category`
                    WHERE `category`.`id` = `categoryId1`) AS `categorySlug1`,
        
        (SELECT `category_id`
                    FROM `anecdote_category`
                    WHERE `anecdote_id` = `anecdote`.`id` LIMIT 1 OFFSET 1) AS `categoryId2`,
        (SELECT `name`
                    FROM `category`
                    WHERE `category`.`id` = `categoryId2`) AS `categoryName2`,
        (SELECT `color`
                    FROM `category`
                    WHERE `category`.`id` = `categoryId2`) AS `categoryColor2`,
        (SELECT `slug`
                    FROM `category`
                    WHERE `category`.`id` = `categoryId2`) AS `categorySlug2`,
        
        (SELECT `category_id`
                    FROM `anecdote_category`
                    WHERE `anecdote_id` = `anecdote`.`id` LIMIT 1 OFFSET 2) AS `categoryId3`,
        (SELECT `name`
                    FROM `category`
                    WHERE `category`.`id` = `categoryId3`) AS `categoryName3`,
        (SELECT `color`
                    FROM `category`
                    WHERE `category`.`id` = `categoryId3`) AS `categoryColor3`,
        (SELECT `slug`
                    FROM `category`
                    WHERE `category`.`id` = `categoryId3`) AS `categorySlug3`, 

        `user`.`id` AS `userId`,
        `user`.`pseudo`,
        `user`.`img` AS `userImg`,

        (SELECT COUNT(`user_id`) 
                FROM `anecdote_action` 
                WHERE `anecdote_action`.`vote` = 1 AND `anecdote_id` = `anecdote`.`id`
        ) AS `upvote`,
        (SELECT COUNT(`user_id`) 
                FROM `anecdote_action` 
                WHERE `anecdote_action`.`vote` = 2 AND `anecdote_id` = `anecdote`.`id`
        ) AS `downvote`

        FROM `anecdote` 
        LEFT JOIN `user` ON `anecdote`.`writer_id` = `user`.`id`
        HAVING :id IN( `categoryId1`, `categoryId2`, `categoryId3`)';

        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->execute([':id' => $categoryId]);
        $results = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    /**
     * Find categoryName by category Id.
     * 
     * @param int $categoryId ID of category
     * @return JSON
     */
    public static function findNameCategoryById($categoryId)
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT name FROM `category` WHERE `category`.`id` = :id';

        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->bindValue(':id', $categoryId);
        $pdoStatement->execute();
        $results = $pdoStatement->fetch(PDO::FETCH_ASSOC);

        return $results;
    }
}
