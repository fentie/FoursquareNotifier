<?php
define('VENUE_ID', 'Use Your Own');
define('OAUTH_TOKEN', 'Use Your Own');
define('NOTIFICATION_ADDRESS', 'Use Your Own');

$time = new DateTime();
$time = $time->modify('-15 min');

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, 'https://api.foursquare.com/v2/venues/' .
    VENUE_ID . '/herenow?afterTimestamp=' . $time->format('U') .
    '&oauth_token=' . OAUTH_TOKEN);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_TIMEOUT, 5);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$response = curl_exec($curl);

$checkins = json_decode($response, true);
if (!empty($checkins['response']['hereNow']['items'])) {
    $message = '';
    foreach($checkins['response']['hereNow']['items'] as $item) {
        curl_setopt($curl, CURLOPT_URL, 'https://api.foursquare.com/v2/users/' .
            $item['user']['id'] . '?oauth_token=' . OAUTH_TOKEN);
        $userData = curl_exec($curl);
        $userData = json_decode($userData, true);
        $message .= $item['user']['firstName'] . ' ' . $item['user']['lastName'] . "\n";
        if (!empty($userData['response']['user']['contact']['twitter'])) {
            $message .= 'Twitter: ' . $userData['response']['user']['contact']['twitter'] . "\n";
        }
    }
    if (mail(NOTIFICATION_ADDRESS, 'checkins', $message, 'From: Foursquare Notifier <Use Your Own>')) {
        //echo 'Email sent!';
    }
}

curl_close($curl);
