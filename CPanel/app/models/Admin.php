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

/** GET ADMIN USER 
 * 
 * @param string $username username of the admin
 * 
 * @return mixed return admin data 
 */
function getAdminUser($username)
{

    $conn = dbConn();
    if ($conn) {
        // $sql = "SELECT firstname,lastname,password FROM admins Where username = :username ";
        $sql = "SELECT * FROM admins Where username = :username ";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":username", $username);
        if ($stmt->execute()) {

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            throw new Exception("Error : Error Processing Request");
        }
    } else {
        throw new Exception("Database connection could not be established");
    }
}

/** UPDATE ADMIN LOGIN TIME
 * 
 * @param string $userid userid of the admin
 *  
 */
function updateLog($userId)
{
    $conn = dbConn();
    if ($conn) {

        $sql = "UPDATE `admins` SET `last_logged_in` = :last_logged_in WHERE `admins`.`id` = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":id", $userId);
        $stmt->bindParam(":last_logged_in", date('Y-m-d H:i:s'));
        if ($stmt->execute()) {

            // return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            throw new Exception("Error : Error Processing Request");
        }
    } else {
        throw new Exception("Database connection could not be established");
    }
}
