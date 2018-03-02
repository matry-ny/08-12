<?php

class NotFoundException extends Exception
{
    public $message = 'Not found';
    public $code = 404;
}