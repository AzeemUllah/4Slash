<?php
return [
    'client_id' => 'AfSEYPS8dUhoIKX0Dk5Cwr55nag4oxgmG9DBUsmMLVOnHh5wKj87Fz9D-9OuzwZV9HMrdfvXHlXQNYt5',
    'secret' => 'EOA_cqiGudh59Hl-5X4G2UyV5n-aZrEtkpqd8IwC1K3YtJKGMciyRAH51Ar5VL-UlzEL2iCBFtCzda8K',
    'settings' => [
        /**
         * Available option 'sandbox' or 'live'
         */
        'mode' => 'sandbox',

        /**
         * Specify the max request time in seconds
         */
        'http.ConnectionTimeOut' => 30,

        'log.LogEnabled' => true,

        'log.FileName' => storage_path() . '/logs/paypal.log',

        /**
         * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
         *
         * Logging is most verbose in the 'FINE' level and decreases as you
         * proceed towards ERROR
         */
        'log.LogLevel' => 'FINE'
    ],
];