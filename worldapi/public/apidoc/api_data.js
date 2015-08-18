define({ "api": [
  {
    "type": "get",
    "url": "/countries",
    "title": "Return the countries list",
    "sampleRequest": [
      {
        "url": "http://api.world.com.ar/countries"
      }
    ],
    "version": "0.1.0",
    "name": "GetCountries",
    "group": "Country",
    "description": "<p>Retrieve the countries list from the database</p> ",
    "examples": [
      {
        "title": "Example usage (To test it, please, see the form at the end of this page):",
        "content": "curl -i http://api.world.com.ar/countries",
        "type": "json"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "<p>Object[]</p> ",
            "optional": false,
            "field": "countries",
            "description": "<p>List of Countries (Array of Objects).</p> "
          },
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "countries.cc_fips",
            "description": "<p>FIPS 10-4 Primary Country Code. A two alphabetic character FIPS 10-4 Primary Country Code uniquely identifying a geopolitical entity.</p> "
          },
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "countries.cc_iso",
            "description": "<p>ISO 3166-1 alpha-2 – two-letter country codes which are the most widely used of the three, and used most prominently for the Internet's country code top-level domains (with a few exceptions).</p> "
          },
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "countries.cc_tld",
            "description": "<p>Country code top-level domain (ccTLD) is an Internet top-level domain generally used or reserved for a country, a sovereign state, or a dependent territory.</p> "
          },
          {
            "group": "Success 200",
            "type": "<p>String</p> ",
            "optional": false,
            "field": "countries.country_name",
            "description": "<p>Country name human readable format.</p> "
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Error 5xx": [
          {
            "group": "Error 5xx",
            "optional": false,
            "field": "InternalError",
            "description": "<p>Something was wrong, could be the container's configuration.</p> "
          }
        ]
      },
      "examples": [
        {
          "title": "Response (example):",
          "content": "HTTP/1.1 500 Internal Error\n{\n  \"error\": \"InternalError\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/ApiController.php",
    "groupTitle": "Country"
  }
] });