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

function getOne($conn, $sql)
{
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    return $row[0];
}

function db_insert($conn, $sql)
{
    return $conn->query($sql) ? $conn->insert_id : 0;
}

function db_update($conn, $sql)
{
    return $conn->query($sql);
}

function db_delete($conn, $sql)
{
    return $conn->query($sql);
}
