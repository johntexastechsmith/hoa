<?php
namespace App\Integrations;

use Illuminate\Support\Facades\App;
use QuickBooksOnline\API\Core\OAuth\OAuth2\OAuth2LoginHelper;
use QuickBooksOnline\API\DataService\DataService;
use QuickBooksOnline\API\Facades\Customer;
use QuickBooksOnline\API\Core\HttpClients\CurlHttpClient;
use QuickBooksOnline\API\Core\CoreConstants;

class QuickBooks
{
    /**
     * @var DataService
     */
    private $dataService;

    public function __construct()
    {
        $this->dataService = DataService::Configure(array(
            'auth_mode' => 'oauth2',
            'ClientID' => config('integrations.quickbooks.client_id'),
            'ClientSecret' => config('integrations.quickbooks.client_secret'),
            'accessTokenKey' => config('integrations.quickbooks.access_token_key'),
            'refreshTokenKey' => config('integrations.quickbooks.refresh_token_key'),
            'QBORealmID' => config('integrations.quickbooks.realm_id'),
            'scope' => "com.intuit.quickbooks.accounting com.intuit.quickbooks.payment",
            'baseUrl' => config('integrations.quickbooks.base_url')
        ));

        $this->authenticate();
    }

    private function authenticate()
    {
        $curlHttpClient = App::make(CurlHttpClient::class);

        $OAuth2LoginHelper = new OAuth2LoginHelper(
            config('integrations.quickbooks.client_id'),
            config('integrations.quickbooks.client_secret'),
            'https://hoa.test',
            'com.intuit.quickbooks.accounting com.intuit.quickbooks.payment'
            );

        $http_header = array(
            'Content-Type' => 'application/json'
        );

        $authCodeUrl = $OAuth2LoginHelper->getAuthorizationCodeURL();
        dd($authCodeUrl);
        $authCode = $curlHttpClient->makeAPICall($authCodeUrl, CoreConstants::HTTP_GET, $http_header, null, null, true);

        dd($authCode);

        /*
        $OAuth2LoginHelper = $this->dataService->getOAuth2LoginHelper();

        $accessToken = $OAuth2LoginHelper->refreshToken();
        $authCodeUrl = $OAuth2LoginHelper->getAuthorizationCodeURL();
        dd($authCodeUrl);
        $error = $OAuth2LoginHelper->getLastError();
        if ($error != null) {
            echo "The Status code is: " . $error->getHttpStatusCode() . "\n";
            echo "The Helper message is: " . $error->getOAuthHelperError() . "\n";
            echo "The Response message is: " . $error->getResponseBody() . "\n";
            return;
        }
        $this->dataService->updateOAuth2Token($accessToken);
        */


        //$OAuth2LoginHelper = $this->dataService->getOAuth2LoginHelper();
        //dd($OAuth2LoginHelper->());
        //$authCodeUrl = $OAuth2LoginHelper->getAuthorizationCodeURL();

        //dd($authCodeUrl);

        //$serviceContext = $this->dataService->getServiceContext();
        //dd($serviceContext);

        //$OAuth2LoginHelper = new OAuth2LoginHelper();

        /*
        $accessToken = $OAuth2LoginHelper->refreshToken();
        $error = $OAuth2LoginHelper->getLastError();
        if ($error != null) {
            echo "The Status code is: " . $error->getHttpStatusCode() . "\n";
            echo "The Helper message is: " . $error->getOAuthHelperError() . "\n";
            echo "The Response message is: " . $error->getResponseBody() . "\n";
            return;
        }
        $this->dataService->updateOAuth2Token($accessToken);
        */
    }

    public function createCustomer(array $data)
    {
        $customer = Customer::create($data);

        return $this->dataService->Add($customer);
    }

    public function allCustomers()
    {
        return $this->dataService->Query("SELECT * FROM Customer");
    }
}