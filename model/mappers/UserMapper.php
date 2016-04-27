<?php

class UserMapper extends PdoDataMapper {
    
    /**
     * Set the object parameters.
     * @param PdoAdapter $pdo
     */
    public function __construct(PdoAdapter $pdo) {
        parent::__construct($pdo);
    }
    
    /**
     * Find user id.
     * @param int $userId
     * @return boolean
     */
    public function findUserId($userId) {
        return $this->getField('id', $userId, 'user');
    }
    
    /**
     * Find username.
     * @param string $username
     * @return boolean
     */
    public function findUsername($username) {
        return $this->getField('username', $username, 'user');
    }
    
    /**
     * Find email.
     * @param string $email
     * @return boolean
     */
    public function findEmail($email) {
        return $this->getField('email', $email, 'user');
    }
    
    /**
     * Inserts new user in the registration process.
     * @param IUser $user
     * @return mixed boolean or PDO errors
     */
    public function insertOnRegister(IUser $user) {
        try {
            $email = $user->getEmail();
            $username = $user->getUsername();
            $password = $user->getPasswordForRegister();
            $gender = $user->getGender();
            $active = $user->getActive();
            $role = $user->getRole();
            
            $sql = "INSERT INTO user (email, username, password, gender, is_active, role) VALUES (?, ?, ?, ?, ?, ?)";
            $sth = $this->pdo->prepare($sql);
            return $sth->execute([$email, $username, $password, $gender, $active, $role]);
        } catch (PDOException $e) {
            return $this->returnPdoErrors($e);
        }    
    }

    /**
     * Updates user active status.
     * @param IUser $user
     * @return mixed boolean or PDO errors
     */
    public function updateActiveUser(IUser $user) {
        try {
            $sql = "UPDATE user SET is_active = NULL WHERE (email = ? AND is_active = ?) LIMIT 1";
            $sth = $this->pdo->prepare($sql);
            $sth->execute([$user->getEmail(), $user->getActive()]);
            return ($sth->rowCount() > 0);
        } catch (PDOException $e) {
            return $this->returnPdoErrors($e);
        }
    }
    
    /**
     * Update user info.
     * @param IUser $user
     * @return mixed boolean or PDO errors
     */
    public function updateUserDetails(Iuser $user) {
        try {
            $userId = $user->getId();
            $username = $user->getUsername();
            $gender = $user->getGender();
            $firstName = $user->getFirstName();
            $lastName = $user->getLastName();
            $city = $user->getCity();
            $state = $user->getState();
            $country = $user->getCountry();
            $about = $user->getAbout();
            
            $sql = "UPDATE user SET username = ?, gender = ?, first_name = ?, last_name = ?, city = ?, state = ?, country = ?, about = ? WHERE id = ?";
            $sth = $this->pdo->prepare($sql);
            return $sth->execute([$username, $gender, $firstName, $lastName, $city, $state, $country, $about, $userId]);
        } catch (PDOException $e) {
            return $this->returnPdoErrors($e);
        }
    }
    
    /**
     * Update user profile image.
     * @param IUser $user
     * @return mixed boolean or PDO errors
     */
    public function updateProfileImage(IUser $user) {
        try {
            $userId = $user->getId();
            $image = $user->getProfileImage();            
            $sql = "UPDATE user SET profile_image = ? WHERE id = ?";
            $sth = $this->pdo->prepare($sql);
            return $sth->execute([$image, $userId]);
        } catch (PDOException $e) {
            return $this->returnPdoErrors($e);
        }
    } 
    
    /**
     * Fetch the user id.
     * @param int $userId
     * @return mixed
     */
    public function fetchUserId($userId) {
        try {
	$sql = "SELECT id FROM user WHERE id = ? AND is_active IS NULL LIMIT 1";
	$row = $this->getColumn($sql, $userId);
	return $row;
        } catch (PDOException $e) {
	return $this->returnPdoErrors($e);
        }
    }
    
    /**
     * Fetch user details for login process.
     * @param IUser $user
     * @return mixed - if password verification pass returns the fetched row, otherwise boolean false or PDO errors
     */
    public function fetchOnLogin(IUser $user) {
        try { 
	$sql = "SELECT id, username, password, role FROM user WHERE username = ? AND is_active IS NULL LIMIT 1";
	$row = $this->getColumns($sql, [$user->getUsername()]);
	return (password_verify($user->getPassword(), $row['password'])) ? $row : false;
        } catch (PDOException $e) {
	return $this->returnPdoErrors($e);
        }
    }
    
    /**
     * Fetch user details.
     * @param int $userId
     * @return mixed - array of user details or errors if query was not successfull
     */
    public function fetchUserDetails($userId) {
        try {
            $sql = "SELECT id AS user_id, username, first_name, last_name, gender, city, state, country, profile_image, about "
                    . "FROM user WHERE id = ?";
            return $this->getColumns($sql, [$userId]);
        } catch (PDOException $e) {
            return $this->returnPdoErrors($e);
        }
    }
    
    /**
     * Fetch profile image.
     * @param int $userId
     * @return mixed - array of fetched details or errors if query was not successfull
     */
    public function fetchProfileImage($userId) {
        try {
            $sql = "SELECT profile_image FROM user WHERE id = ?";
            return $this->getColumn($sql, [$userId]);
        } catch (PDOException $e) {
            return $this->returnPdoErrors($e);
        }
    }
}
