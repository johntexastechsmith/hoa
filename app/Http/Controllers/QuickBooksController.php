<?php
namespace App\Http\Controllers;

use App\Hoa;
use App\Integrations\QuickBooks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class QuickBooksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $hoa = Hoa::findOrFail($request->session()->get('hoa_id'));

        $quickBooks = new QuickBooks($hoa);

        return view('hoa.admin.quickbooks', [
            'isConnected' => $quickBooks->isConnected(),
            'clientId' => $hoa->getSettingValue(QuickBooks::CLIENT_ID),
            'clientSecret' => $hoa->getSettingValue(QuickBooks::CLIENT_SECRET),
            'accessToken' => $hoa->getSettingValue(QuickBooks::ACCESS_TOKEN),
            'refreshToken' => $hoa->getSettingValue(QuickBooks::REFRESH_TOKEN),
            'realmId' => $hoa->getSettingValue(QuickBooks::REALM_ID),
        ]);
    }

    public function authorizeAccess(Request $request)
    {
        $hoa = Hoa::findOrFail($request->session()->get('hoa_id'));

        $hoa->createOrUpdateSetting(QuickBooks::CLIENT_ID, $request->client_id);
        $hoa->createOrUpdateSetting(QuickBooks::CLIENT_SECRET, $request->client_secret);
        $hoa->createOrUpdateSetting(QuickBooks::ACCESS_TOKEN, $request->access_token);
        $hoa->createOrUpdateSetting(QuickBooks::REFRESH_TOKEN, $request->refresh_token);
        $hoa->createOrUpdateSetting(QuickBooks::REALM_ID, $request->realm_id);

        return redirect()->route('quickbooks.index', ['id' => $request->session()->get('hoa_id')]);

        /*
         * @todo need to get oauth working still. this part works but
         * haven't been able to exchange code for access and refresh tokens
        $quickBooks = new QuickBooks($hoa);
        $url = $quickBooks->getAuthCodeUrl($request->client_id, $request->client_secret);

        Cache::put('quickbooks.returnCode.hoaId', $hoa->id, 5);

        return redirect()->away($url);
        */
    }

    public function acceptCode(Request $request)
    {
        if (Cache::has('quickbooks.returnCode.hoaId')) {
            $hoa = Hoa::findOrFail(Cache::get('quickbooks.returnCode.hoaId'));

            $quickBooks = new QuickBooks($hoa);
            $accessCode = $quickBooks->exchangeCodeForAccessToken($request->input('code'), $request->input('realmId'));

            $hoa->createOrUpdateSetting(QuickBooks::ACCESS_TOKEN, $accessCode->getAccessToken());
            $hoa->createOrUpdateSetting(QuickBooks::REALM_ID, $accessCode->getRefreshToken());

            return redirect()->route('quickbooks.index', ['id' => $request->session()->get('hoa_id')]);
        } else {
            throw new \Exception('No Return Code Requested');
        }
    }
}