<?php
// include('tableClass.php');
include('eloquentClass.php');
// Write your code here

$newQuery = new EloquentClass('users');
$query = $newQuery->select('last_name')->executeQuery($query);



