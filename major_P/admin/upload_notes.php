<?php
include ("admin_inc/db.php");

if (isset($_POST['submit'])) {
    $course = $_POST['course'];
    $semester = $_POST['semester'];
    $subject = $_POST['subject'];
    $sub_name = $_POST['sub_name'];
    $desc = $_POST['desc'];

    // File upload handling
    $file_name = $_FILES['notes']['name'];
    $file_tmp = $_FILES['notes']['tmp_name'];
    $escaped_file_name = $con->real_escape_string($file_name);
    move_uploaded_file($file_tmp, "uploads/notes/" . $file_name);

    $insert_query = "INSERT INTO notes SET course='$course', sem='$semester', sub='$subject', sub_name='$sub_name', notes='$escaped_file_name', descr='$desc'";

    $insert_query2 = "INSERT INTO subjects SET sub_name='$sub_name'";
    $con->query($insert_query2);

    if ($con->query($insert_query) === TRUE) {
        echo '<script>alert("File uploaded successfully!"); document.location="show_files.php"</script>';
    } else {
        echo '<script>alert("Something went wrong!! Please try Again!!"); document.location="show_files.php"</script>';
    }
}
?>
