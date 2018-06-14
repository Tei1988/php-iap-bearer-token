# Google IAP Bearer Token

## Usage

1. add `tei1988/iap-bearer-token` to composer.json

1. set JSON format Key file path for ServiceAccount to GOOGLE_CLOUD_CREDENTIALS

1. use trait in your class

```php
class Hoge
{
  use GoogleIAP\BearerTokenTrait;

  const GOOGLE_IAP_CLIENT_ID = '<Your Google IAP Client ID>';

  public function fuga() {
    $bearerToken = $this->getBearerToken(self::GOOGLE_IAP_CLIENT_ID);

    var_dump($bearerToken);
  }
}

$instance = new Hoge();
$instance->fuga();
```
