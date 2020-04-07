<?php
require('twitch-curl-php-api.php');

//Get Stats From User
var_dump(getTwitchStatsByUsername('laengenwelle'));


//Check if User is Live && if he is Live get Broadcast Data
var_dump(getTwitchStreamersLiveData('laengenwelle'));
