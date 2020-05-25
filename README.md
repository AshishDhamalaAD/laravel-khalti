The package to verify Khalti payment.

## Installation

```sh
composer require asdh/laravel-khalti
```

## Publishing config file

To publish the config file run below command.

```sh
php artisan vendor:publish --provider="AsDh\KhaltiServiceProvider" --tag="khalti"
```

This command will add `khalti.php` file in `config` directory where you can add public and secret keys.

It looks like this.

```php
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
```

## Usage

```php
<?php

namespace App\Http\Controllers;

use AsDh\Khalti;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KhaltiVerificationController extends Controller
{
    public function verify(Request $request, Khalti $khalti)
    {
        $khalti->withToken($request->token)
            ->withAmount((int) $request->amount)
            ->verify();

        if($khalti->hasError()) {
            $errorMessage = $khalti->errorMessage();

            // perform your action
            return $errorMessage;
        }

        // The payment is verified
        // perform your action
        return $khalti->response();
    }
}
```

The `amount` must be in paisa. The `token` is what you get from Khalti after successful payment.

Instead of checking if it has any errors, you can also check if the payment is verified like so.

```php
<?php

namespace App\Http\Controllers;

use AsDh\Khalti;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KhaltiVerificationController extends Controller
{
    public function verify(Request $request, Khalti $khalti)
    {
        $khalti->withToken($request->token)
            ->withAmount((int) $request->amount)
            ->verify();

        if($khalti->isVerified()) {
            $response = $khalti->response();

            // perform your action
            return $response;
        }

        // The payment is not verified
        // perform your action
        return $khalti->errorMessage();
    }
}
```

There is a `statusCode` method to get the status code from the Khalti's response.

```php
$khalti->statusCode();
```

If there is any issue with the package, please create an issue. I would be happy to solve it.
