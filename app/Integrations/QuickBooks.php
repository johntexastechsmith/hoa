<?php
namespace App\Integrations;

use App\Hoa;
use Carbon\Carbon;
use QuickBooksOnline\API\Core\OAuth\OAuth2\OAuth2LoginHelper;
use QuickBooksOnline\API\DataService\DataService;
use QuickBooksOnline\API\Facades\Customer;

class QuickBooks
{
    const CLIENT_ID = 'quickbooks.client_id';

    const CLIENT_SECRET = 'quickbooks.client_secret';

    const ACCESS_TOKEN = 'quickbooks.accessTokenKey';

    const REFRESH_TOKEN = 'quickbooks.refresh_token_key';

    const REALM_ID = 'quickbooks.realmId';

    const BASE_URL = 'quickbooks.base_url';

    /**
     * @var Hoa
     */
    private $hoa;

    public function __construct($hoa)
    {
        $this->hoa = $hoa;
    }

    /**
     * @return DataService
     */
    public function getDataService()
    {
        return DataService::Configure(array(
            'auth_mode' => 'oauth2',
            'ClientID' => $this->hoa->getSettingValue(QuickBooks::CLIENT_ID),
            'ClientSecret' => $this->hoa->getSettingValue(QuickBooks::CLIENT_SECRET),
            'accessTokenKey' => $this->hoa->getSettingValue(QuickBooks::ACCESS_TOKEN),
            'refreshTokenKey' => $this->hoa->getSettingValue(QuickBooks::REFRESH_TOKEN),
            'QBORealmID' => $this->hoa->getSettingValue(QuickBooks::REALM_ID),
            'scope' => "com.intuit.quickbooks.accounting com.intuit.quickbooks.payment",
            'baseUrl' => config('integrations.quickbooks.base_url')
        ));
    }

    public function getAuthCodeUrl($clientId, $clientSecret)
    {
        $OAuth2LoginHelper = new OAuth2LoginHelper(
            $clientId,
            $clientSecret,
            route('quickbooks.return'),
            'com.intuit.quickbooks.accounting com.intuit.quickbooks.payment'
        );
        $authCodeUrl = $OAuth2LoginHelper->getAuthorizationCodeURL();

        return $authCodeUrl;
    }

    /**
     * @param $code
     * @param $realmId
     * @return \QuickBooksOnline\API\Core\OAuth\OAuth2\OAuth2AccessToken
     */
    public function exchangeCodeForAccessToken($code, $realmId)
    {
        $dataService = $this->getDataService();
        $OAuth2AccessToken = new OAuth2LoginHelper(
            $this->hoa->getSettingValue(QuickBooks::CLIENT_ID),
            $this->hoa->getSettingValue(QuickBooks::CLIENT_SECRET),
            route('quickbooks.index', ['id' => $this->hoa->id]),
            'com.intuit.quickbooks.accounting com.intuit.quickbooks.payment',
            null,
            null
        );
        $accessToken = $OAuth2AccessToken->exchangeAuthorizationCodeForToken($code, $realmId);
        $dataService->updateOAuth2Token($accessToken);
        $dataService->throwExceptionOnError(true);

        return $accessToken;
    }

    public function isConnected()
    {
        $lastUpdated = $this->hoa->getSetting(QuickBooks::ACCESS_TOKEN)->updated_at;

        if (Carbon::now()->subMinutes(60)->lte($lastUpdated)) {
            return true;
        } else {
            return false;
        }
    }

    public function refreshToken()
    {
        // This code is non working. leaving for debugging later
        $dataService = $this->getDataService();
        $serviceContext = $dataService->getServiceContext();
        $OAuth2LoginHelper = new OAuth2LoginHelper(
            $this->hoa->getSettingValue(QuickBooks::CLIENT_ID),
            $this->hoa->getSettingValue(QuickBooks::CLIENT_SECRET),
            null,
            "com.intuit.quickbooks.accounting com.intuit.quickbooks.payment",
            null,
            $serviceContext
        );
        $accessToken = $OAuth2LoginHelper->refreshToken();

        $dataService->updateOAuth2Token($accessToken);
    }

    public function createCustomer(array $data)
    {
        $customer = Customer::create($data);

        return $this->getDataService()->Add($customer);
    }

    public function allCustomers()
    {
        return $this->getDataService()->Query("SELECT * FROM Customer");
    }
}