<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function detectLanguage(Request $request)
    {
        $browserLanguage = $request->header('Accept-Language');
        $language = $this->parseAcceptLanguage($browserLanguage);

        return response()->json(['language' => $language]);
    }

    private function parseAcceptLanguage($acceptLanguage)
    {
        $languages = explode(',', $acceptLanguage);

        // Get the first language from the list
        $language = substr($languages[0], 0, 2);

        return $language;
    }
}
