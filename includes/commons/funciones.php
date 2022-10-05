<?php

function isLogged(): bool
{
if(!isset($_SESSION['usuarios'])){
    return false;
}
return true;
}   