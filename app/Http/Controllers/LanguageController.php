<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function switchLang($lang)
    {
        // Available languages
        $availableLocales = ['en', 'es','fa','ar','us','uk','de','ae','es','cz','fr','pt','it','tr','ro','dk','pl','se','no'];

        // Check if the requested language is available
        if (in_array($lang, $availableLocales)) {
            session()->put('locale', $lang);
        }
        
        return redirect()->back();
    }
} 