<?php
$dev = [
    'publicKey' =>  env('WATU_PUBLIC_KEY_TEST', 'WTP-T-PK-'),
    'secretKey' => env('WATU_SECRET_KEY_TEST', 'WTP-T-PK-'),
    'encryptKey' => env('WATU_ENCRYPTION_KEY_TEST', 'WTP-T-PK-'),
    'ivKey' => env('WATU_IV_KEY_TEST', 'WTP-T-PK-'),
    'url' => env('WATU_URL', 'https://api.watu.global/v1'),
];
$pro = [
    'publicKey' =>  env('WATU_PUBLIC_KEY', 'WTP-L-PK'),
    'secretKey' => env('WATU_SECRET_KEY', 'WTP-L-PK'),
    'encryptKey' => env('WATU_ENCRYPTION_KEY', 'WTP-L-PK'),
    'ivKey' => env('WATU_IV_KEY', 'WTP-L-PK'),
    'url' => env('WATU_URL', 'https://api.watu.global/v1'),
];

return env('APP_ENV') == 'production' ? $pro : $dev;
