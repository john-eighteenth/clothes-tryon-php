<?php

require_once 'config.php'; // Assuming your configuration constants are defined in config.php

function virtualTryOn() {
    $encodedParams = http_build_query([
        'clothing_image_url' => LOOK_URI,
        'avatar_image_url' => AVATAR_URI
    ]);

    $options = [
        'http' => [
            'method' => 'POST',
            'header' => [
                'Content-Type: application/x-www-form-urlencoded',
                'X-RapidAPI-Key: ' . RAPID_API_KEY,
                'X-RapidAPI-Host: texel-virtual-try-on.p.rapidapi.com'
            ],
            'content' => $encodedParams
        ]
    ];

    $context = stream_context_create($options);

    try {
        $response = file_get_contents('https://texel-virtual-try-on.p.rapidapi.com/try-on-url', false, $context);
        file_put_contents('result.jpg', $response);
    } catch (Exception $error) {
        echo 'Error: ' . $error->getMessage();
    }
}

virtualTryOn();

?>
