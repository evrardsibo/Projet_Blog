<?php 
    $pdo = require_once './database/database.php';
        class DbModel
        {
            private PDOStatement $statementCreate;
            private PDOStatement $statementUpadte;
            private PDOStatement $statementRead;
            private PDOStatement $statementReadAll;
            private PDOStatement $statementDelete;

            public function __construct(private PDO $pdo)
            {
                $this->statementCreate = $pdo->prepare("INSERT INTO 
                articles (
                    title,
                    image,
                    category,
                    content
                ) VALUES (
                    :title,
                    :image,
                    :category,
                    :content
            
                )");
            
                $this->statementUpadte = $pdo->prepare("UPDATE articles 
                SET 
                    title = :title,
                    image = :image,
                    category = :category,
                    content = :content
            
                 WHERE idarticles = :idarticles");
            
                $this->statementRead = $pdo->prepare("SELECT * FROM articles WHERE idarticles = :idarticles");

                $this->statementDelete = $pdo->prepare("DELETE FROM articles where idarticles = :idarticles");

                $this->statementReadAll = $pdo->prepare("SELECT * FROM articles");
            }

            public function fetchAll()
            {
                $this->statementReadAll->execute();
                return $this->statementReadAll->fetchAll();
            }

            public function fetch(int $id)
            {
                $this->statementRead->bindValue(':idarticles', $id);
                $this->statementRead->execute();
                return $this->statementRead->fetch();
            }

            public function delete(int $id)
            {
                $this->statementDelete->bindValue(':idarticles',$id);
                $this->statementDelete->execute();
                return $id;
            }

            public function update($articles)
            {
                $this->statementUpadte->bindValue(':title',$articles['title'], PDO::PARAM_STR);
                $this->statementUpadte->bindValue(':image',$articles['image'], PDO::PARAM_STR);
                $this->statementUpadte->bindValue(':category',$articles['category'], PDO::PARAM_STR);
                $this->statementUpadte->bindValue(':content',$articles['content'], PDO::PARAM_STR);
                $this->statementUpadte->bindValue(':idarticles',$articles['idarticles'], PDO::PARAM_INT);
                $this->statementUpadte->execute();
                return $articles;
            }

            public function create($articles)
            {
                $this->statementCreate->bindValue(':title', $articles['title'],PDO::PARAM_STR);
                $this->statementCreate->bindValue(':image', $articles['image'],PDO::PARAM_STR);
                $this->statementCreate->bindValue(':category', $articles['category'],PDO::PARAM_STR);
                $this->statementCreate->bindValue(':content', $articles['content'],PDO::PARAM_STR);
                $this->statementCreate->execute();
                return $this->fetch($this->pdo->lastInsertId());
            }
        }

        return new DbModel($pdo);