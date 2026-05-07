<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Anthropic API Key
    |--------------------------------------------------------------------------
    | Set in your .env file:
    |   ANTHROPIC_API_KEY=sk-ant-xxxxxxx
    |
    | Get your key at: https://console.anthropic.com
    */
    'api_key' => env('ANTHROPIC_API_KEY', ''),

    'model' => env('ANTHROPIC_MODEL', 'claude-sonnet-4-20250514'),

    'max_tokens' => env('ANTHROPIC_MAX_TOKENS', 1000),
];
