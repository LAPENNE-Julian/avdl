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

    /**
     * Get All anecdotes by category
     * 
     * @param int $categoryId
     * @return Category[]
     */
    public static function findAnecdotes($categoryId)
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT 
        `anecdote`.`id`, 
        `anecdote`.`title`, 
        `anecdote`.`description`, 
        `anecdote`.`created_at`,
        `anecdote`.`category_1`,
        `anecdote`.`category_2`,
        `anecdote`.`category_3`,

        (SELECT `name`
                    FROM `category`
                    WHERE `category`.`id` = `category_1`) AS `categoryName1`,
        (SELECT `color`
                    FROM `category`
                    WHERE `category`.`id` = `category_1`) AS `categoryColor1`,
        (SELECT `slug`
                    FROM `category`
                    WHERE `category`.`id` = `category_1`) AS `categorySlug1`,          
        (SELECT `name`
                    FROM `category`
                    WHERE `category`.`id` = `category_2`) AS `categoryName2`,
        (SELECT `color`
                    FROM `category`
                    WHERE `category`.`id` = `category_2`) AS `categoryColor2`,
        (SELECT `slug`
                    FROM `category`
                    WHERE `category`.`id` = `category_2`) AS `categorySlug2`,
        
        (SELECT `name`
                    FROM `category`
                    WHERE `category`.`id` = `category_3`) AS `categoryName3`,
        (SELECT `color`
                    FROM `category`
                    WHERE `category`.`id` = `category_3`) AS `categoryColor3`,
        (SELECT `slug`
                    FROM `category`
                    WHERE `category`.`id` = `category_3`) AS `categorySlug3`,

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
        HAVING :id IN( `category_1`, `category_2`, `category_3`)';

        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->execute([':id' => $categoryId]);
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
        `anecdote`.`created_at`,
        `anecdote`.`category_1`,
        `anecdote`.`category_2`,
        `anecdote`.`category_3`,

        (SELECT `name`
                    FROM `category`
                    WHERE `category`.`id` = `category_1`) AS `categoryName1`,
        (SELECT `color`
                    FROM `category`
                    WHERE `category`.`id` = `category_1`) AS `categoryColor1`,
        (SELECT `slug`
                    FROM `category`
                    WHERE `category`.`id` = `category_1`) AS `categorySlug1`,          
        (SELECT `name`
                    FROM `category`
                    WHERE `category`.`id` = `category_2`) AS `categoryName2`,
        (SELECT `color`
                    FROM `category`
                    WHERE `category`.`id` = `category_2`) AS `categoryColor2`,
        (SELECT `slug`
                    FROM `category`
                    WHERE `category`.`id` = `category_2`) AS `categorySlug2`,
        
        (SELECT `name`
                    FROM `category`
                    WHERE `category`.`id` = `category_3`) AS `categoryName3`,
        (SELECT `color`
                    FROM `category`
                    WHERE `category`.`id` = `category_3`) AS `categoryColor3`,
        (SELECT `slug`
                    FROM `category`
                    WHERE `category`.`id` = `category_3`) AS `categorySlug3`,

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
        HAVING :id IN( `category_1`, `category_2`, `category_3`)';

        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->execute([':id' => $categoryId]);
        $results = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    /**
     * Get page of anecdotes (9 anecdotes by pages) by category
     * 
     * @param int $categoryId ID of anecdote
     * @param int $offsetNum
     * @return JSON
     */
    public static function browsePage($categoryId, int $offsetNum){

        $pdo = Database::getPDO();
        $sql = 'SELECT 
        `anecdote`.`id`, 
        `anecdote`.`title`, 
        `anecdote`.`description`, 
        `anecdote`.`created_at`,
        `anecdote`.`category_1`,
        `anecdote`.`category_2`,
        `anecdote`.`category_3`,

        (SELECT `name`
                    FROM `category`
                    WHERE `category`.`id` = `category_1`) AS `categoryName1`,
        (SELECT `color`
                    FROM `category`
                    WHERE `category`.`id` = `category_1`) AS `categoryColor1`,
        (SELECT `slug`
                    FROM `category`
                    WHERE `category`.`id` = `category_1`) AS `categorySlug1`,          
        (SELECT `name`
                    FROM `category`
                    WHERE `category`.`id` = `category_2`) AS `categoryName2`,
        (SELECT `color`
                    FROM `category`
                    WHERE `category`.`id` = `category_2`) AS `categoryColor2`,
        (SELECT `slug`
                    FROM `category`
                    WHERE `category`.`id` = `category_2`) AS `categorySlug2`,
        
        (SELECT `name`
                    FROM `category`
                    WHERE `category`.`id` = `category_3`) AS `categoryName3`,
        (SELECT `color`
                    FROM `category`
                    WHERE `category`.`id` = `category_3`) AS `categoryColor3`,
        (SELECT `slug`
                    FROM `category`
                    WHERE `category`.`id` = `category_3`) AS `categorySlug3`,

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
        HAVING :id IN( `category_1`, `category_2`, `category_3`)
        LIMIT 9 OFFSET ' . $offsetNum;

        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->execute([':id' => $categoryId]);
        $results = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }
}
