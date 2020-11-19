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

function buildQuery($table, array $returnFields, $paginate, ...$variables) {
    $sql = "SELECT ".join(", ", $returnFields)." FROM ".$table;

    if ($variables->length > 0) {
        $sql = $sql." WHERE ".join("=? AND ", $variables);
    }

    if ($paginate == NULL) {
        $sql = $sql." LIMIT ".$pageinate[0]." OFFSET ".$pageinate[1];
    }

    return $sql;
}

function buildAndPrepareQuery($table, array $returnFields, array $paginate, $fieldTypes, ...$variables) {
    $sql = buildQuery($table, $returnFields, $paginate, ...$variables);
    return queryPrepared($sql, $fieldTypes, ...$variables);
}

?>