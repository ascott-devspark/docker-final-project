<?php
/**
 * Created by PhpStorm.
 * User: sarrubia
 * Date: 8/2/15
 * Time: 12:31 PM
 */

namespace App\Http\Controllers;

class ApiController extends Controller {

    public function index(){
        return response()->json("World API 1.0");
    }

    /**
     * @api {get} /countries Return the countries list
     * @apiSampleRequest http://api.world.com.ar/countries
     * @apiVersion 0.1.0
     * @apiName GetCountries
     * @apiGroup Country
     *
     * @apiDescription Retrieve the countries list from the database
     *
     * @apiExample Example usage (To test it, please, see the form at the end of this page):
     * curl -i http://api.world.com.ar/countries
     *
     * @apiSuccess {Object[]} countries              List of Countries (Array of Objects).
     * @apiSuccess {String}   countries.cc_fips      FIPS 10-4 Primary Country Code. A two alphabetic character FIPS 10-4 Primary Country Code uniquely identifying a geopolitical entity.
     * @apiSuccess {String}   countries.cc_iso       ISO 3166-1 alpha-2 – two-letter country codes which are the most widely used of the three, and used most prominently for the Internet's country code top-level domains (with a few exceptions).
     * @apiSuccess {String}   countries.cc_tld       Country code top-level domain (ccTLD) is an Internet top-level domain generally used or reserved for a country, a sovereign state, or a dependent territory.
     * @apiSuccess {String}   countries.country_name Country name human readable format.
     *
     * @apiError (Error 5xx) InternalError Something was wrong, could be the container's configuration.
     *
     * @apiErrorExample Response (example):
     *     HTTP/1.1 500 Internal Error
     *     {
     *       "error": "InternalError"
     *     }
     */
    public function getCountries(){

        $countries = \App\Country::all(["cc_fips","cc_iso","cc_tld","country_name"]);

        return response()->json($countries->toArray());
    }

}