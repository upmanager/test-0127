<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function gitAPI($url)
    {
        return Http::withHeaders([
            'Accept' => 'application/vnd.github.v3+json',
            'Authorization' => 'token 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'
        ])->get($url);
    }
}
