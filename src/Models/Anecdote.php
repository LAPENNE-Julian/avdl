<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class Anecdote extends CoreModel {
    
    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $content;

    /**
     * @var string
     */
    private $img;

    /**
     * @var string
     */
    private $source;

    /**
     * @var int
     */
    private $writer_id;

    /**
     * @var int
     */
    private $category_1;

    /**
     * @var int
     */
    private $category_2;
    
    /**
     * @var int
     */
    private $category_3;

    /**
     * Get the value of title
     *
     * @return  string
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @param  string  $title
     */ 
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * Get the value of description
     *
     * @return  string|null
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @param  string  $description
     */ 
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * Get the value of content
     *
     * @return  string
     */ 
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @param  string  $content
     */ 
    public function setContent(string $content)
    {
        $this->content = $content;
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
     * Get the value of source
     *
     * @return  string|null
     */ 
    public function getSource()
    {
        return $this->source;
    }

    /**
     * Set the value of source
     *
     * @param  string  $source
     */ 
    public function setSource(string $source)
    {
        $this->source = $source;
    }
    
    /**
     * Get the value of writer_id
     *
     * @return  int
     */ 
    public function getWriterId(): int
    {
        return $this->writer_id;
    }

    /**
     * Set the value of writerId
     *
     * @param  int  $writer_id
     */ 
    public function setWriterId(int $writerId)
    {
        $this->writer_id = $writerId;
    }

    /**
     * Get the value of category_1
     *
     * @return  int|null 
     */ 
    public function getCategory1(): ?int
    {
        return $this->category_1;
    }

    /**
     * Set the value of category_1
     *
     * @param  int|null  $category_1
     */ 
    public function setCategory1($categoryId)
    {
        $this->category_1 = $categoryId;
    }

    /**
     * Get the value of category_2
     *
     * @return  int|null 
     */ 
    public function getCategory2(): ?int
    {
        return $this->category_2;
    }

    /**
     * Set the value of category_2
     *
     * @param  int|null $category_2
     */ 
    public function setCategory2($categoryId)
    {
        $this->category_2 = $categoryId;
    }

    /**
     * Get the value of category_3
     *
     * @return  int|null 
     */ 
    public function getCategory3(): ?int
    {
        return $this->category_3;
    }

    /**
     * Set the value of category_3
     *
     * @param  int|null $category_3
     */ 
    public function setCategory3($categoryId)
    {
        $this->category_3 = $categoryId;
    }

    /**
     * Insert new anecdote
     */
    public function insert()
    {
        $pdo = Database::getPDO();

        $sql = '
            INSERT INTO anecdote (title, description, content, img, source, writer_id, category_1, category_2, category_3)
            VALUES (:title, :description, :content, :img, :source, :writer_id, :category_1, :category_2, :category_3)
        ';

        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->bindValue(':title', $this->title);
        $pdoStatement->bindValue(':description', $this->description);
        $pdoStatement->bindValue(':content', $this->content);
        $pdoStatement->bindValue(':img', $this->img);
        $pdoStatement->bindValue(':source', $this->source);
        $pdoStatement->bindValue(':writer_id', $this->writer_id);
        $pdoStatement->bindValue(':category_1', $this->category_1);
        $pdoStatement->bindValue(':category_2', $this->category_2);
        $pdoStatement->bindValue(':category_3', $this->category_3);

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
     * Update anecdote
     */
    public function update()
    {
        $pdo = Database::getPDO();

        $sql = '
            UPDATE `anecdote`
            SET
                `title` = :title,
                `description` = :description,
                `content` = :content,
                `img` = :img,
                `source` = :source,
                `updated_at` = NOW(),
                `category_1` = :category_1,
                `category_2` = :category_2,
                `category_3` = :category_3
            WHERE id = :id
        ';

        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->bindValue(':title', $this->title);
        $pdoStatement->bindValue(':description', $this->description);
        $pdoStatement->bindValue(':content', $this->content);
        $pdoStatement->bindValue(':img', $this->img);
        $pdoStatement->bindValue(':source', $this->source);
        $pdoStatement->bindValue(':category_1', $this->category_1);
        $pdoStatement->bindValue(':category_2', $this->category_2);
        $pdoStatement->bindValue(':category_3', $this->category_3);
        $pdoStatement->bindValue(':id', $this->id);

        $queryWorked = $pdoStatement->execute();

        // $queryWorked return a boolean if the request work
        if ($queryWorked) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Delete anecdote
     */
    public function delete()
    {
        $pdo = Database::getPDO();

        $sql = '
            DELETE FROM `anecdote`
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
     * Get anecdote by id
     * 
     * @param int $anecdoteId ID of anecdote
     * @return Anecdote
     */
    public static function find($anecdoteId)
    {
        $pdo = Database::getPDO();

        $sql = 'SELECT 
        `anecdote`.`id`, 
        `anecdote`.`title`, 
        `anecdote`.`description`, 
        `anecdote`.`content`,
        `anecdote`.`img`,
        `anecdote`.`source`,
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
                    WHERE `category`.`id` = `category_3`) AS `categorySlug3`

        FROM `anecdote`
        WHERE `anecdote`.`id` = :id';
        
        // prepare() return PDOStatement object
        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->execute([':id' => $anecdoteId]);
        $result = $pdoStatement->fetchObject(self::class);
        
        return $result;
    }

    /**
     * Get all anecdotes
     * 
     * @return Anecdote[]
     */
    public static function findAll()
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM `anecdote`';
        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->execute();
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);
        
        return $results;
    }

    /**
     * Get categories of anecdote
     */
    public static function getCategoryAnecdote(int $anecdoteId)
    {
        $pdo = Database::getPDO();

        $sql = 'SELECT 
        `anecdote`.`id`, 
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
                    WHERE `category`.`id` = `category_3`) AS `categorySlug3`

        FROM `anecdote`
        WHERE `anecdote`.`id` = :anecdoteId';

        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->bindValue(':anecdoteId', $anecdoteId);

        $pdoStatement->execute();
        $results = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    /**
     * add vote : upVote (vote => 1)
     * @param int $userId 
     * @param int $anecdoteId 
     * 
     * @return bool 
     */
    public static function insertUpvote(int $userId, int $anecdoteId)
    {
        $pdo = Database::getPDO();
        $sql = '
            INSERT INTO `anecdote_action` (vote, favorite, anecdote_id, user_id)
            VALUES (:vote, :favorite, :anecdoteId, :userId)';

            $pdoStatement = $pdo->prepare($sql);
            
            $pdoStatement->bindValue(':vote', 1);
            $pdoStatement->bindValue(':favorite', 0);
            $pdoStatement->bindValue(':anecdoteId', $anecdoteId);
            $pdoStatement->bindValue(':userId', $userId);

            $queryWorked = $pdoStatement->execute();

        // $queryWorked return a boolean if the request work
        if ($queryWorked) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * add vote : downVote (vote => 2)
     * @param int $userId 
     * @param int $anecdoteId 
     * 
     * @return bool 
     */
    public static function insertdownvote(int $userId, int $anecdoteId)
    {
        $pdo = Database::getPDO();
        $sql = '
            INSERT INTO `anecdote_action` (vote, favorite, anecdote_id, user_id)
            VALUES (:vote, :favorite, :anecdoteId, :userId)';

            $pdoStatement = $pdo->prepare($sql);
            
            $pdoStatement->bindValue(':vote', 2);
            $pdoStatement->bindValue(':favorite', 0);
            $pdoStatement->bindValue(':anecdoteId', $anecdoteId);
            $pdoStatement->bindValue(':userId', $userId);

            $queryWorked = $pdoStatement->execute();

        // $queryWorked return a boolean if the request work
        if ($queryWorked) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * update vote upVote (vote => 1)
     * @param int $userId 
     * @param int $anecdoteId 
     * 
     * @return bool 
     */
    public static function updateUpvote(int $userId, int $anecdoteId)
    {
        $pdo = Database::getPDO();
        $sql = '
                UPDATE `anecdote_action`
                SET
                    `vote` = :vote
                    WHERE `user_id` = :userId 
                    AND `anecdote_id` = :anecdoteId';

            $pdoStatement = $pdo->prepare($sql);

            $pdoStatement->bindValue(':vote', 1);
            $pdoStatement->bindValue(':userId', $userId);
            $pdoStatement->bindValue(':anecdoteId', $anecdoteId);
        
            $queryWorked = $pdoStatement->execute();

        // $queryWorked return a boolean if the request work
        if ($queryWorked) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * update vote downVote (vote => 2)
     * @param int $userId 
     * @param int $anecdoteId 
     * 
     * @return bool 
     */
    public static function updateDownvote(int $userId, int $anecdoteId)
    {
        $pdo = Database::getPDO();
        $sql = '
                UPDATE `anecdote_action`
                SET
                    `vote` = :vote
                    WHERE `user_id` = :userId 
                    AND `anecdote_id` = :anecdoteId';

            $pdoStatement = $pdo->prepare($sql);

            $pdoStatement->bindValue(':vote', 2);
            $pdoStatement->bindValue(':userId', $userId);
            $pdoStatement->bindValue(':anecdoteId', $anecdoteId);
        
            $queryWorked = $pdoStatement->execute();

        // $queryWorked return a boolean if the request work
        if ($queryWorked) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Set vote downVote and Upvote => 0
     * @param int $userId 
     * @param int $anecdoteId 
     * 
     * @return bool 
     */
    public static function updateVote(int $userId, int $anecdoteId)
    {
        $pdo = Database::getPDO();
        $sql = '
                UPDATE `anecdote_action`
                SET
                    `vote` = :vote
                    WHERE `user_id` = :userId 
                    AND `anecdote_id` = :anecdoteId';

            $pdoStatement = $pdo->prepare($sql);

            $pdoStatement->bindValue(':vote', 0);
            $pdoStatement->bindValue(':userId', $userId);
            $pdoStatement->bindValue(':anecdoteId', $anecdoteId);
        
            $queryWorked = $pdoStatement->execute();

        // $queryWorked return a boolean if the request work
        if ($queryWorked) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Delete all vote (vote => upVote, downvote and favorite)
     * @param int $userId 
     * @param int $anecdoteId 
     * 
     * @return bool 
     */
    public static function deleteAllVote(int $userId, int $anecdoteId)
    {
        $pdo = Database::getPDO();
        $sql = 'DELETE FROM `anecdote_action`
                    WHERE `user_id` = :userId 
                    AND `anecdote_id` = :anecdoteId';

            $pdoStatement = $pdo->prepare($sql);
            
            $pdoStatement->bindValue(':userId', $userId);
            $pdoStatement->bindValue(':anecdoteId', $anecdoteId);
        
            $queryWorked = $pdoStatement->execute();

        // $queryWorked return a boolean if the request work
        if ($queryWorked) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get anecdote by id
     * 
     * @param int $anecdoteId ID of anecdote
     * @return JSON
     */
    public static function read($anecdoteId)
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT 
        `anecdote`.`id`, 
        `anecdote`.`title`, 
        `anecdote`.`description`, 
        `anecdote`.`content`,
        `anecdote`.`img`,
        `anecdote`.`source`,
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
        WHERE `anecdote`.`id` = :id';

        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->execute([':id' => $anecdoteId]);
        $result = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }

    /**
     * Get all anecdotes 
     * 
     * @return JSON
     */
    public static function browse()
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
        WHERE `anecdote`.`id` = :id';

        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->execute();
        $results = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    /**
     * Get 5 best anecdotes (upvote)
     * 
     * @return JSON
     */
    public static function best()
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
        ORDER BY `upvote` DESC
        LIMIT 5';

        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->execute();
        $result = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }

    /**
     * Get 5 latest anecdotes (created_at)
     * 
     * @return JSON
     */
    public static function latest()
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
        ORDER BY created_at DESC
        LIMIT 5';

        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->execute();
        $result = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }

    /**
     * Get random anecdote Id
     * 
     * @return JSON
     */
    public static function random()
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT `id` 
        FROM `anecdote`
        ORDER BY RAND()
        LIMIT 1';

        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->execute();
        //Use fetch because, just need one ligne.
        //Use result like object
        $result = $pdoStatement->fetch(PDO::FETCH_OBJ);
        
        return $result;
    }

    /**
     * Get random five anecdote Id
     * 
     * @return JSON
     */
    public static function randomFive()
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
        ORDER BY RAND()
        LIMIT 5
        ';

        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->execute();
        $result = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }
}
