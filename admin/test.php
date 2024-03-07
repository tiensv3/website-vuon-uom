<?php
include("../connect.php");
$current_date = date("Y-m-d");
// echo "" . $current_date . "";
$businessid = 1;
$status = 1;
$sql = "SELECT COUNT(businesspackages.businesspackageid) AS total_count FROM businesspackages INNER JOIN businesses
ON businesspackages.businessid = businesses.businessid
WHERE businesspackages.status = $status AND DATE(businesspackages.enddate) >= DATE('$current_date')
AND businesspackages.businessid = $businessid";

$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    echo $row['total_count'];
}
