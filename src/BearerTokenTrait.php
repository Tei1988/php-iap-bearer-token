<?php

namespace GoogleIAP;

use Google\Auth\OAuth2;

trait BearerTokenTrait
{
    private function getClient($client_id) {
      static $client = null;
      if (isset($client)) return $client;

      $pathToServiceAccount = getenv('GOOGLE_CLOUD_CREDENTIALS');
      $serviceAccountKey = json_decode(file_get_contents($pathToServiceAccount), true);
      $client = new OAuth2([
          'audience' => $serviceAccountKey['token_uri'],
          'issuer' => $serviceAccountKey['client_email'],
          'signingAlgorithm' => 'RS256',
          'signingKey' => $serviceAccountKey['private_key'],
          'tokenCredentialUri' => $serviceAccountKey['token_uri'],
      ]);
      $client->setGrantType(OAuth2::JWT_URN);
      $client->setAdditionalClaims(['target_audience' => $client_id]);
      return $client;
    }

    public function getBearerToken($client_id) {
      $client = $this->getClient($client_id);
      $client->fetchAuthToken();
      return $client->getIdToken();
    }
}
