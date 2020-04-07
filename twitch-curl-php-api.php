<?php
$clientid = "YOUR CLIENT ID";


function getTwitchStatsByUsername($username) {
    global $clientid;
    $customHeaders = array(
        'Client-ID: ' . $clientid,
        'Accept: application/vnd.twitchtv.v5+json'
    );
    $cURLConnection = curl_init();
    curl_setopt($cURLConnection, CURLOPT_URL, 'https://api.twitch.tv/kraken/users?login=' . $username);
    curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($cURLConnection, CURLOPT_HTTPHEADER, $customHeaders);
    $phoneList = curl_exec($cURLConnection);
    curl_close($cURLConnection);

    if(json_decode($phoneList)->users == NULL) {
        return 'Not found';
    }

    $userid = json_decode($phoneList)->users[0]->_id;


    $cURLConnectiontoUser = curl_init();
    curl_setopt($cURLConnectiontoUser, CURLOPT_URL, 'https://api.twitch.tv/kraken/channels/' . $userid);
    curl_setopt($cURLConnectiontoUser, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($cURLConnectiontoUser, CURLOPT_HTTPHEADER, $customHeaders);
    $fetch_data = curl_exec($cURLConnectiontoUser);
    curl_close($cURLConnectiontoUser);

    return json_decode($fetch_data);

}

function getTwitchStatsByUsernameLive($username) {
    global $clientid;
    $customHeaders = array(
        'Client-ID: ' . $clientid,
        'Accept: application/vnd.twitchtv.v5+json'
    );
    $cURLConnection = curl_init();
    curl_setopt($cURLConnection, CURLOPT_URL, 'https://api.twitch.tv/kraken/users?login=' . $username);
    curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($cURLConnection, CURLOPT_HTTPHEADER, $customHeaders);
    $phoneList = curl_exec($cURLConnection);
    curl_close($cURLConnection);

    if(json_decode($phoneList)->users == NULL) {
        return 'Not found';
    }

    $userid = json_decode($phoneList)->users[0]->_id;


    $cURLConnectiontoUser = curl_init();
    curl_setopt($cURLConnectiontoUser, CURLOPT_URL, 'https://api.twitch.tv/helix/streams?user_id=' . $userid);
    curl_setopt($cURLConnectiontoUser, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($cURLConnectiontoUser, CURLOPT_HTTPHEADER, $customHeaders);
    $fetch_data = curl_exec($cURLConnectiontoUser);
    curl_close($cURLConnectiontoUser);

    return json_decode($fetch_data);
}

function getTwitchStreamersLiveData($username) {
    $data = getTwitchStatsByUsernameLive($username);

    if($data == 'Not found') {
        return 'Not found';
    }elseif($data->data == NULL) {
        return 'false';
    } else {
        return $data;
    }

}