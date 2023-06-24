<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['update'])) {
    $scoreID = $_POST['scoreID'];
    $studentID = $_POST['studentID'];
    $score1 = $_POST['score1'];
    $score2 = $_POST['score2'];
    $score3 = $_POST['score3'];
    $score4 = $_POST['score4'];
    $score5 = $_POST['score5'];
    $score6 = $_POST['score6'];

    // Update the record in the database
    $stmt = $db->prepare("UPDATE scores SET Score1 = ?, Score2 = ?, Score3 = ?, Score4 = ?, Score5 = ?, Score6 = ? WHERE ScoreID = ?");
    $result = $stmt->execute([$score1, $score2, $score3, $score4, $score5, $score6, $scoreID]);

    if ($result) {
      echo "Record updated successfully.";
    } else {
      echo "Update failed.";
    }
  } elseif (isset($_POST['delete'])) {
    $scoreID = $_POST['scoreID'];

    // Delete the record from the database
    $stmt = $db->prepare("DELETE FROM scores WHERE ScoreID = ?");
    $result = $stmt->execute([$scoreID]);

    if ($result) {
      echo "Record deleted successfully.";
    } else {
      echo "Delete failed.";
    }
  }
}
?>
