<?php
include '../includes/db_config.php';

// --- ADD MEMBER ---
if (isset($_POST['add_member'])) {
    $member_id = $_POST['member_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $birthday = $_POST['birthday'];

    $check_member = "SELECT * FROM member WHERE member_id = '$member_id'";
    $member_result = mysqli_query($conn, $check_member);
    if (mysqli_num_rows($member_result) > 0) {
        header("Location: ../members/addmember.php?error=duplicate_member_id");
        exit();
    }

    $stmt = $conn->prepare("INSERT INTO member (member_id, first_name, last_name, email, birthday) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $member_id, $first_name, $last_name, $email, $birthday);

    if ($stmt->execute()) {
        header("Location: ../members/member_details.php?msg=Member Added Successfully");
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();

}

// --- UPDATE MEMBER ---
if (isset($_POST['update_member'])) {
    $member_id = $_POST['member_id']; // This should be a hidden input in your edit form
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $birthday = $_POST['birthday'];

    $stmt = $conn->prepare("UPDATE member SET first_name=?, last_name=?, email=?, birthday=? WHERE member_id=?");
    $stmt->bind_param("sssss", $first_name, $last_name, $email, $birthday, $member_id);

    if ($stmt->execute()) {
        header("Location: ../members/edit_member.php?id=$member_id&status=updated");
    } else {
        echo "Error: " . $stmt->error;
    }
}

// --- DELETE MEMBER ---
if (isset($_GET['delete_id'])) {
    $member_id = $_GET['delete_id'];

    $stmt = $conn->prepare("DELETE FROM member WHERE member_id = ?");
    $stmt->bind_param("s", $member_id);

    if ($stmt->execute()) {
        header("Location: ../members/member_list.php?msg=Member Deleted Successfully");
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

$conn->close();
?>
