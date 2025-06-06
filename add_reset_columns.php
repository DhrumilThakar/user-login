<?php
require_once 'config.php';

// Add reset token columns to users table
$sql = "ALTER TABLE users 
        ADD COLUMN reset_token VARCHAR(64) NULL,
        ADD COLUMN reset_token_expiry DATETIME NULL";

if ($conn->query($sql) === TRUE) {
    echo "Reset token columns added successfully";
} else {
    echo "Error adding columns: " . $conn->error;
}

$conn->close();
?> 