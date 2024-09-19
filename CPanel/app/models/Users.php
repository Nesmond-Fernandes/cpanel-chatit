<?php

/** DATABASE CONNECTION
 * 
 * @return mixed if the connection if successful returns a PDO obj
*/
function dbConn()
{
    try {
        $conn = new PDO("mysql:localhost=" . DB_USER . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        throw new Exception($e->getMessage(), 1);
    }
}

/** GET ALL USERS 
 * 
 * @param string $pages the pages to set the offset for the next users result
 * @param string $sort order type of result
 * 
 * @return array list of all users 
 */
function getAllUsers($pages, $sort)
{
    try {



        $offset = ($pages - 1) * 10;
        $offset_q = 'OFFSET ' . $offset;
        $sort_q = 'ORDER BY `users`.`created_at` ' . strtoupper($sort);
        // $sql = "SELECT *,(SELECT COUNT(*) FROM users) as 'total_users' FROM users " . $sort_q . " LIMIT 10 " . $offset_q;
        $sql= "SELECT *,ROW_NUMBER() OVER (".$sort_q.") as sr_no FROM users LIMIT 10 ".$offset_q."";

        $conn = dbConn();
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchall();
    } catch (Exception $e) {
        throw new Exception($e->getMessage());
    }
}

/** GET TOTAL USERS  
 * 
 * @return string Count of total number of users 
 * 
 */
function getTotalUsers()
{
    try {
        $sql = "SELECT COUNT(*) as 'total_users' FROM users";
        $conn = dbConn();
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    } catch (Exception $e) {
        throw new Exception($e->getMessage());
    }
}

/** FETCH USERS BY EMAIL 
 * 
 * @param string $query email keywords to search
 * 
 * @return array List of the users with the keywords 
 */
function searchUsersBY_email($query){
    $conn = dbConn();
    if ($conn) {
        
        // $sql = "SELECT username,email,id,firstname,lastname,created_at,last_logged_in FROM `users` WHERE users.email LIKE '%".$query."%'";
        $sql = "SELECT *,ROW_NUMBER() OVER ( ORDER BY (SELECT 1)) as sr_no FROM `users` WHERE users.email LIKE '%".$query."%'";
        $stmt = $conn->prepare($sql);
        // $stmt->bindParam(":id", $userId);
        // $stmt->bindParam();
        if ($stmt->execute()) {

            return $stmt->fetchall(PDO::FETCH_ASSOC);
        } else {
            throw new Exception("Error : Error Processing Request");
        }
    } else {
        throw new Exception("Database connection could not be established");
    }
}

/** FETCH USERS BY USERNAME 
 * 
 * @param string $query username keywords to search
 * 
 * @return array List of the users with the keywords 
 */
function searchUsersBY_username($query){
    $conn = dbConn();
    if ($conn) {
        
        $sql = "SELECT username,email,id,firstname,lastname,created_at,last_logged_in FROM `users` WHERE users.username LIKE '%".$query."%'";
        $sql = "SELECT *,ROW_NUMBER() OVER ( ORDER BY (SELECT 1)) as sr_no FROM `users` WHERE users.username LIKE '%".$query."%'";
        $stmt = $conn->prepare($sql);
        // $stmt->bindParam(":id", $userId);
        // $stmt->bindParam();
        if ($stmt->execute()) {

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            throw new Exception("Error : Error Processing Request");
        }
    } else {
        throw new Exception("Database connection could not be established");
    }
}
