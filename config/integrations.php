<?php

return [

    /*
    |--------------------------------------------------------------------------
    | QuickBooks Access Keys
    |--------------------------------------------------------------------------
    |
    | Access and Refresh token keys
    |
     */
    'quickbooks' => [
        'client_id' => env('QB_CLIENT_ID', 'Q0KTvcOHQwJobYTe9a0C9xqTnFjBxmvHIATCmIh3D1Nuo6wfzY'),
        'client_secret' => env('QB_CLIENT_SECRET', 'AziJ4SHUO4fPbFdCZTPMvW5hYA7wls7FNp4bZpRv'),
        'access_token_key' => env('QB_ACCESS_TOKEN_KEY', 'eyJlbmMiOiJBMTI4Q0JDLUhTMjU2IiwiYWxnIjoiZGlyIn0..ROPD4rZXkaMA9-uvHYc6iQ.cb4fph1k-Y7dYkDjYmn6RaqGnfT4AdmXnyYDozL5qXoWdJUKTAqgxSlHXcoEHP4wpbueILH8r8AjcOKJGuHtCFuxlI_-SBdDXG-Q6Ix9NKSS9N0PXKj8EmVOrx1Kqje_cbf4VLznbiNpfwpH0CIJnrkHyEAMif4wKpyTWDU2o2zNKdWZXcRh7b1UPyVcMBfu16mPeuvpUEGYHAlUuGBmy77fHxn_5Pa3LEs-vfvZPveRtJwdKy-Y8vR98b66ZJV7TiIyXSa--XhSdcY62U8FMcchx8wx_bwG0omOPAMp7tHZJxcW8CneFztz-FNxuBHH8V6Z5ErKUQ1yiiPsLDRao0RWImG7jp5Ck6sJt_5BvzoCJzE395jZpdeZorjpiyHglXFQVka-TPvpdEuwgyfPRTEB2p4mV1tQcc1t5PtSHsAfUiIvbuai6Rm9byqvSPBrj5nnLfZDLS3esuHOSBdDi6WFy_esGm2f6s6xr9BkgySc15zxLTZPfv3O43oH1djgYEiLr0iGDVLE7e9hgpmesK3UAtCyf2FoYpEYhlxLevYrzMeVlAGU3RqjHHT41Fu5YRVCYL5HFNRrzpRSJQYDjL_F2JynGv3vrVVp5Xw-DJiDkIRTpPL6xmEUUWkjIA1mIZuiVva7dyct8rvfi9zjUzXSuIF0Sp015lw0iObuZmO7s0GrRrmxIoLq0OVvrMsJ.CSDYjm58mGewv77wSRzEqA'),
        'refresh_token_key' => env('QB_REFRESH_TOKEN_KEY', 'Q0115251464250okKOMYwQXF2TJiMHAiQIJxBeVbo0FsGq9xOB'),
        'realm_id' => env('QB_REALM_ID', '193514694895924'),
        'base_url' => env('QB_BASE_URL', 'https://sandbox-quickbooks.api.intuit.com'),
    ],
];