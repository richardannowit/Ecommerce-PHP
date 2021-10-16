<?php
function getList($conn, $sql)
{
    $list = array();
    $list_execute = $conn->query($sql);
    while ($row = $list_execute->fetch_assoc()) {
        array_push($list, $row);
    }
    return $list;
}
