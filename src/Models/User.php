<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class User extends CoreModel
{
    /**
     * @var string
     */
    private $pseudo;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $img;

    /**
     * @var int
     */
    private $roles;

    /**
     * @var bool
     */
    private $isVerified = false;

    /**
     * Get the value of pseudo
     * 
     * @return string
     */ 
    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    /**
     * Set value of the pseudo
     * 
     * @param string $pseudo
     * @return void
     */ 
    public function setPseudo(string $pseudo)
    {
        $this->pseudo = $pseudo;
    }
    
    /**
     * Get the value of email
     * 
     * @return string
     */ 
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Set value of the email
     * 
     * @param string $email
     * @return void
     */ 
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /**
     * Get the value of password
     * 
     * @return string
     */ 
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * Set the value of password
     * 
     * @param string $password
     * @return void
     */ 
    public function setPassword(string $password)
    {
        $this->password = $password;
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
     * Get the value of role
     * 
     * @return int
     */ 
    public function getRoles(): ?int
    {
        return $this->roles;
    }

    /**
     * Set the value of role
     * 
     * @param int $roles
     * @return void
     */ 
    public function setRoles(int $roles)
    {
        $this->roles = $roles;
    }

    /**
     * Get the value for verified email
     * 
     * @return bool
     */ 
    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    /**
     * Set the value for verified email
     * 
     * @param bool $isVerified
     * @return bool
     */ 
    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function insert()
    {
        $pdo = Database::getPDO();

        $sql = '
            INSERT INTO user (pseudo, email, password, img, roles)
            VALUES (:pseudo, :email, :password, :img, :roles)
        ';

        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->bindValue(':pseudo', $this->pseudo);
        $pdoStatement->bindValue(':email', $this->email);
        $pdoStatement->bindValue(':password', $this->password);
        $pdoStatement->bindValue(':img', $this->img);
        $pdoStatement->bindValue(':roles', $this->roles);

        $queryWorked = $pdoStatement->execute();

        // $queryWorked return a boolean if the request work
        if ($queryWorked) {
            $this->id = $pdo->lastInsertId();

            return true;
        } else {
            return false;
        }
    }

    public function update()
    {
        $pdo = Database::getPDO();

        $sql = '
            UPDATE `user`
            SET
                `pseudo` = :pseudo,
                `email` = :email,
                `password` = :password,
                `img` = :img,
                `roles` = :roles,
                `updated_at` = NOW()
            WHERE id = :id
        ';

        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->bindValue(':pseudo', $this->pseudo);
        $pdoStatement->bindValue(':email', $this->email);
        $pdoStatement->bindValue(':password', $this->password);
        $pdoStatement->bindValue(':img', $this->img);
        $pdoStatement->bindValue(':roles', $this->roles);
        $pdoStatement->bindValue(':id', $this->id);

        return $pdoStatement->execute();
    }

    public function delete()
    {
        $pdo = Database::getPDO();

        $sql = '
            DELETE FROM `user`
            WHERE `id` = :id
        ';

        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->bindValue(':id', $this->id);

        return $pdoStatement->execute();
    }

    //-----
    // Static Method
    //-----

    public static function find($id)
    {
        $pdo = Database::getPDO();

        $sql = '
            SELECT *
            FROM user
            WHERE id = :id
        ';

        // prepare() return PDOStatement object
        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->execute([':id' => $id]);
        $result = $pdoStatement->fetchObject(self::class);
        
        return $result;
    }

    public static function findAll()
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM `user`';
        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->execute();
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);
        
        return $results;
    }

    /**
     * Get all informations of user by email.
     * 
     * @param $email
     * @return JSON
     */
    public static function readByEmail($email)
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT pseudo, email, img, created_at FROM `user`
        WHERE `user`.`email` = :email';

        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->execute([ ':email' => $email]);
        $result = $pdoStatement->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    public static function findByEmail(string $email)
    {
        $pdo = Database::getPDO();

        $sql = 'SELECT 
                `email`,
                `pseudo`,
                `roles`
                FROM `user`
                WHERE `email` = :email
        ';

        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->execute([':email' => $email]);
        $result = $pdoStatement->fetchObject(self::class);
        
        return $result;
    }

    public static function findByPseudo(string $pseudo)
    {
        $pdo = Database::getPDO();

        $sql = '
            SELECT *
            FROM user
            WHERE pseudo = :pseudo
        ';

        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->execute([':pseudo' => $pseudo]);
        $result = $pdoStatement->fetchObject(self::class);
        
        return $result;
    }

    /**
     * Get favorite anecdoteId By UserId.
     * 
     * @param int $userId
     * @return JSON
     */
    public static function getFavorite(int $userId)
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT 
        `anecdote`.`id`, 
        `anecdote`.`title`, 
        `anecdote`.`description`,
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

        FROM `anecdote_action`
        LEFT JOIN `anecdote` ON `anecdote`.`id` = `anecdote_action`.`anecdote_id`
        LEFT JOIN `user` ON `anecdote`.`writer_id` = `user`.`id`

        WHERE `anecdote_action`.`user_id` = :userId 
        AND `anecdote_action`.`favorite` = 1';

        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->bindValue(':userId', $userId);

        $pdoStatement->execute();
        $results = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    
    }

    /**
     * Get favorite anecdoteId By UserId.
     * 
     * @param int $userId
     * @return JSON
     */
    public static function getUpvote(int $userId)
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT 
        `anecdote`.`id`, 
        `anecdote`.`title`, 
        `anecdote`.`description`,
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

        FROM `anecdote_action`
        JOIN `anecdote` ON `anecdote`.`id` = `anecdote_action`.`anecdote_id`
        JOIN `user` ON `anecdote`.`writer_id` = `user`.`id`

        WHERE `anecdote_action`.`user_id` = :userId 
        AND `anecdote_action`.`vote` = 1';

        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->bindValue(':userId', $userId);

        $pdoStatement->execute();
        $results = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    /**
     * Check if anecdote has already voted by userId 
     * in Anecdote_action table
     * Use to know if vote is null (no vote => 0) 
     * 
     * @param int $userId 
     * @param int $anecdoteId 
     * @return JSON
     */
    public static function checkVotedNull(int $userId, int $anecdoteId)
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT user_id,anecdote_id FROM `anecdote_action` 
        WHERE user_id = :userId 
        AND anecdote_id = :anecdoteId
        AND `vote` = 0';

        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->bindValue(':userId', $userId);
        $pdoStatement->bindValue(':anecdoteId', $anecdoteId);

        $pdoStatement->execute();
        $results = $pdoStatement->fetch(PDO::FETCH_ASSOC);

        return $results;
    }

    /**
     * Check if anecdote has already voted by userId 
     * in Anecdote_action table
     * Use to know if vote is an update ou insert
     * 
     * @param int $userId 
     * @param int $anecdoteId 
     * @return JSON
     */
    public static function checkAllVote(int $userId, int $anecdoteId)
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT user_id,anecdote_id FROM `anecdote_action` 
        WHERE user_id = :userId 
        AND anecdote_id = :anecdoteId';

        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->bindValue(':userId', $userId);
        $pdoStatement->bindValue(':anecdoteId', $anecdoteId);

        $pdoStatement->execute();
        $results = $pdoStatement->fetch(PDO::FETCH_ASSOC);

        return $results;
    }

    /**
     * Check if anecdote has already favorite vote by userId 
     * in Anecdote_action table
     * @param int $userId 
     * @param int $anecdoteId 
     * 
     * @return JSON
     */
    public static function checkFavorite(int $userId, int $anecdoteId)
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT user_id,anecdote_id, favorite FROM `anecdote_action` 
        WHERE user_id = :userId 
        AND anecdote_id = :anecdoteId
        AND favorite = 1';

        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->bindValue(':userId', $userId);
        $pdoStatement->bindValue(':anecdoteId', $anecdoteId);

        $pdoStatement->execute();
        $results = $pdoStatement->fetch(PDO::FETCH_ASSOC);

        return $results;
    }

    /**
     * add vote favorite
     * @param int $userId 
     * @param int $anecdoteId 
     * 
     * @return bool 
     */
    public static function insertVoteFavorite(int $userId, int $anecdoteId)
    {
        $pdo = Database::getPDO();
        $sql = '
            INSERT INTO `anecdote_action` (favorite, anecdote_id, user_id)
            VALUES (:favorite, :anecdoteId, :userId)';

            $pdoStatement = $pdo->prepare($sql);
            
            $pdoStatement->bindValue(':favorite', 1);
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
     * update vote favorite
     * @param int $userId 
     * @param int $anecdoteId 
     * 
     * @return bool 
     */
    public static function updateVoteFavorite(int $userId, int $anecdoteId)
    {
        $pdo = Database::getPDO();
        $sql = '
                UPDATE `anecdote_action`
                SET
                    `favorite` = :favorite
                    WHERE `user_id` = :userId 
                    AND `anecdote_id` = :anecdoteId';

            $pdoStatement = $pdo->prepare($sql);

            $pdoStatement->bindValue(':favorite', 1);
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
     * Delete vote favorite
     * @param int $userId 
     * @param int $anecdoteId 
     * 
     * @return bool 
     */
    public static function deleteVoteFavorite(int $userId, int $anecdoteId)
    {
        $pdo = Database::getPDO();
        $sql = '
                UPDATE `anecdote_action`
                SET
                    `favorite` = :favorite
                    WHERE `user_id` = :userId 
                    AND `anecdote_id` = :anecdoteId';

            $pdoStatement = $pdo->prepare($sql);

            $pdoStatement->bindValue(':favorite', 0);
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
}