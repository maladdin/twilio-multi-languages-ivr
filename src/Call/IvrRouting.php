<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use Twilio\TwiML\VoiceResponse;

$response = new VoiceResponse();

if (array_key_exists('Digits', $_POST)) {
    if (empty($_GET['lang'])) {
        switch ($_POST['Digits']) {
            case 1:
                $response->redirect('https://6656edd8baa7.ngrok.io/src/TwiML/IVR-english.xml');
                break;
            case 2:
                $response->redirect('https://6656edd8baa7.ngrok.io/src/TwiML/IVR-arabic.xml');
                break;
            default:
                $response->say('Sorry, This choice is not available');
        }
    } elseif ($_GET['lang'] == 'en') {
        switch ($_POST['Digits']) {
            case 1:
                $response->say('Thanks. one of our agents will contact you very soon');
                break;
            case 2:
                $response->say('Thanks for listening to our latest offers');
                break;
        }
    } elseif ($_GET['lang'] == 'ar') {
        switch ($_POST['Digits']) {
            case 1:
                $response->say('أَحَدُ مَنْدوبينا سَيَتَوَاصَلُ مَعَكَ حَالًا.', ['voice' => 'Polly.Zeina']);
                break;
            case 2:
                $response->say('شُكْرًا لِإِسْتِمَاعِكْ لاحَّدِثِ عُروضِنا', ['voice' => 'Polly.Zeina']);
                break;
        }
    }
}


// Render the response as XML in reply to the webhook request
    header('Content-Type: text/xml');
    echo $response;