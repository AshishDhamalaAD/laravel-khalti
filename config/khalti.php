<?php

return [
    /**
     * The public key that you receive from khalti
     */
    'public_key' => env('KHALTI_PUBLIC_KEY'),

    /**
     * The secret key that you receive from khalti
     */
    'secret_key' => env('KHALTI_SECRET_KEY'),

    /**
     * The url that is used to verify khalti payment
     */
    'verification_url' => env('KHALTI_VEFIRICATION_URL', 'https://khalti.com/api/v2/payment/verify/')
];
