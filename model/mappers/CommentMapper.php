<?php

class CommentMapper extends PdoDataMapper {
    
    /**
     * Set the object parameters.
     * @param PdoAdapter $pdo
     */
    public function __construct(PdoAdapter $pdo) {
        parent::__construct($pdo);
    }
    
    /**
     * Insert image comment.
     * @param IComment $comment
     * @return mixed boolean or PDO errors
     */
    public function insertComment(IComment $comment) {
        try {
            $sql = "INSERT INTO comment (user_id, image_id, comment) VALUES (?, ?, ?)";
            $sth = $this->pdo->prepare($sql);
            return $sth->execute([$comment->getUserId(), $comment->getImageId(), $comment->getComment()]);
        } catch (PDOException $e) {
            return $this->returnPdoErrors($e);
        }
    }
    
    /**
     * Fetch comments details based on passed image id.
     * @param int $imageId
     * @return mixed - array of data if query was successfull or errors
     */
    public function fetchCommentsByImageId($imageId) {
        try {
            $sql = "SELECT c.id, c.comment, c.image_id AS image_id, c.user_id, u.username, "
                . "IF(c.created_at < CURDATE(), DATE_FORMAT(c.created_at, '%d %b %Y'), DATE_FORMAT(c.created_at, '%H:%i')) AS date_created "
                . "FROM comment c "
                . "JOIN user u ON c.user_id = u.id "
                . "WHERE c.image_id = ?";
            return $this->getAllColumns($sql, 'id', [$imageId]);
        } catch (PDOException $e) {
            return $this->returnPdoErrors($e);
        }
    }
}
