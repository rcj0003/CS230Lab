<?php

require 'exceptions.php';

function executePrepared($sql, $fieldTypes, ...$variables) {
    require 'dbhandler.php';
    $statement = $conn->stmt_init();

    if (!$statement->prepare($sql)) {
        throw new SQLInjectionException();
    } else {
        if (!empty($variables)) {
            $statement->bind_param($fieldTypes, ...$variables);
        }
        $statement->execute();
        $result = $statement->store_result();
        $rowsAffected = $statement->num_rows();

        $statement->close();

        return $rowsAffected;
    }
}

function queryPrepared($sql, $fieldTypes, ...$variables) {
    require 'dbhandler.php';
    $statement = $conn->stmt_init();

    if (!$statement->prepare($sql)) {
        throw new SQLInjectionException();
    } else {
        if (!empty($variables)) {
            $statement->bind_param($fieldTypes, ...$variables);
        }
        $statement->execute();
        $result = $statement->get_result();
        $data = $result->fetch_assoc();

        $statement->close();

        return $data;
    }
}

?>