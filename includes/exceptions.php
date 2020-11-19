<?php

class SQLException extends Exception {
    function __construct($message) {
        parent::__construct($message);
    }
}

class SQLInjectionException extends Exception {}

class LoginFailedException extends Exception {
    function __construct($message) {
        parent::__construct($message);
    }
}

class RegistrationFailedException extends Exception {
    function __construct($message) {
        parent::__construct($message);
    }
}

class UserNotLoggedInException extends Exception {}

class InvalidSessionException extends Exception {}

class NoPermissionException extends Exception {
    function __construct($message) {
        parent::__construct($message);
    }
}

class UploadException extends Exception {
    function __construct($message) {
        parent::__construct($message);
    }
}

?>