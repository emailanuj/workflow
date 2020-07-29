<?php

return [
    'adminEmail' => 'admin@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',
    //'topologyServiceUrl' => 'http://100.67.249.101/allpath/path/', // Prod IP
    //'topologyServiceUrl' => 'http://10.127.248.19:8000/allpath/path/',  // lab IP
    'topologyServiceUrl' => 'http://127.0.0.1:8010/allpath/path/', //prod localhost IP

    'bandwidthServiceUrl' => 'http://10.127.248.27:5000/bws/api/v1/utilization' // lab IP
];
