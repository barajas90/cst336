<?php
session_start();

include 'connect.php';
$connect = getDBConnection();

$score = $_GET['https://wbarajas-williambarajas.c9users.io/cst336/labs/csumb_quiz/index.php?question1=1994&question2=C'];

$sql = "INSERT INTO scores(username, score)
        VALUES (:username, :score)";
$data = array(
    ":username" => $_SESSION['username'],
    ":score" => $score
);
$stmt = $connect->prepare($sql);
$stmt->execute($data);

//Retrieving total times quiz has been submitted and average score for this user
$sql = "SELECT count(1) times, avg(score) average
        FROM scores
        WHERE username = :username";
$stmt = $connect->prepare($sql);
$stmt->execute(array(":username"=>$_SESSION['username']));
$result = $stmt->fetch(PDO::FETCH_ASSOC);
echo json_encode($result);
?>