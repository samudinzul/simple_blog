<?php 
include 'config.php';

function encyrptPassword($pwd) {
    $pwd_peppered = hash_hmac("sha256", $pwd, $GLOBALS['pepper']);
    $pwd_hashed = password_hash($pwd_peppered, PASSWORD_BCRYPT);
    return $pwd_hashed;
}

function loggedIn() {
    return isset($_SESSION['userID']);
}

function getPosts() {
    global $conn;
	$sql = "SELECT * FROM posts ORDER BY created DESC;";
	$result = mysqli_query($conn, $sql);

	// fetch all posts as an associative array called $posts
	$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

	return $posts;
}


function getUsername($userID) {
    //error here
    if ($query = mysqli_query($GLOBALS['conn'], "SELECT * FROM users WHERE id='$userID'")) {
        if (mysqli_num_rows($query) > 0) {
            while ($row = mysqli_fetch_assoc($query)) { 
                return $row['username'];
            }
        } else {
            echo 'username not found';
        }
    }
}


