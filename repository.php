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

function db_insert($conn, $sql)
{
    return $conn->query($sql) ? $conn->insert_id : 0;
}
