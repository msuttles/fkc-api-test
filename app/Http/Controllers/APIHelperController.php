<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Validator;

class APIHelperController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Validate data passed through the request.
     *
     * @return void
     */
    static function FormatChecker (Request $request, $Validationfields)
    {
        // Need to implement custom error messaging to append to payload
        // Customized Error Messaging syntax example below
        // request()->validate([
        //     'name' => 'required',
        //     'id' => 'exists:doc_contractors,id'
        // ], [
        //     'name.required' => 'your message',
        //     'id.exists' => 'your message'
        // ]);
        \Validator::validate($request->all(),[$Validationfields]);

    }

    public function FormatJsonResponse($Resource, $request)
    {
        $response = array(
            "data" => array(),
            "message" => array(),
            "status" => array(),
            "error" => array()
        );

        if($Resource == 0){
            $response['message'] = 'Update Failed!';
            $response['status'] = '500';
        }
        elseif($Resource == 1){
            $response['message'] = 'Update Successful';
            $response['status'] = '200';
        }
        elseif($Resource){
            $response['message'] = 'Update Successful';
            $response['status'] = '200';
        }
        echo $response['message'];
        return response()->json($response);
    }

    public function getCountryAbbr ()
    {
        $countries = [
            "ASCENSION ISLAND" => "AC",
            "AFGHANISTAN" => "AF",
            "ALAND" => "AX",
            "ALBANIA" => "AL",
            "ALGERIA" => "DZ",
            "ANDORRA" => "AD",
            "ANGOLA" => "AO",
            "ANGUILLA" => "AI",
            "ANTARCTICA" => "AQ",
            "ANTIGUA AND BARBUDA" => "AG",
            "ARGENTINA REPUBLIC" => "AR",
            "ARMENIA" => "AM",
            "ARUBA" => "AW",
            "AUSTRALIA" => "AU",
            "AUSTRIA" => "AT",
            "AZERBAIJAN" => "AZ",
            "BAHAMAS" => "BS",
            "BAHRAIN" => "BH",
            "BANGLADESH" => "BD",
            "BARBADOS" => "BB",
            "BELARUS" => "BY",
            "BELGIUM" => "BE",
            "BELIZE" => "BZ",
            "BENIN" => "BJ",
            "BERMUDA" => "BM",
            "BHUTAN" => "BT",
            "BOLIVIA" => "BO",
            "BOSNIA AND HERZEGOVINA" => "BA",
            "BOTSWANA" => "BW",
            "BOUVET ISLAND" => "BV",
            "BRAZIL" => "BR",
            "BRITISH INDIAN OCEAN TERR" => "IO",
            "BRITISH VIRGIN ISLANDS"	=> "VG",
            "BRUNEI DARUSSALAM" => "BN",
            "BULGARIA" => "BG",
            "BURKINA FASO" => "BF",
            "BURUNDI" => "BI",
            "CAMBODIA" => "KH",
            "CAMEROON" => "CM",
            "CANADA"=> "CA",
            "CAPE VERDE"=> "CV",
            "CAYMAN ISLANDS"	=> "KY",
            "CENTRAL AFRICAN REPUBLIC" => "CF",
            "CHAD" => "TD",
            "CHILE" => "CL",
            "PEOPLE’S REPUBLIC OF CHINA" => "CN",
            "CHRISTMAS ISLANDS" => "CX",
            "COCOS ISLANDS" => "CC",
            "COLOMBIA" => "CO",
            "COMORAS" => "KM",
            "CONGO" => "CG",
            //CONGO (DEMOCRATIC REPUBLIC)	CD
            "COOK ISLANDS" => "CK",
            "COSTA RICA" => "CR",
            
            "COTE D IVOIRE" => "CI",
            "CROATIA"	=> "HR",
            "CUBA" => "CU",
            "CYPRUS" => "CY",
            "CZECH REPUBLIC" => "CZ",
            "DENMARK"	=> "DK",
            "DJIBOUTI" => "DJ",
            "DOMINICA" => "DM",
            "DOMINICAN REPUBLIC" => "DO",
            "EAST TIMOR" => "TP",
            "ECUADOR"	=> "EC",
            "EGYPT" => "EG",
            "EL SALVADOR"	=> "SV",
            "EQUATORIAL GUINEA" => "GQ",
            "ESTONIA"	=> "EE",
            "ETHIOPIA" => "ET",
            "FALKLAND ISLANDS" => "FK",
            "FAROE ISLANDS" => "FO",
            "FIJI" => "FJ",
            "FINLAND"	=> "FI",
            "FRANCE" => "FR",
            "FRANCE METROPOLITAN"	=> "FX",
            "FRENCH GUIANA" => "GF",
            "FRENCH POLYNESIA" => "PF",
            "FRENCH SOUTHERN TERRITORIES"	=> "TF",
            "GABON" => "GA",
            "GAMBIA" => "GM",
            "GEORGIA" => "GE",
            "GERMANY" => "DE",
            "GHANA" => "GH",
            "GIBRALTAR" => "GI",
            "GREECE" => "GR",
            "GREENLAND" => "GL",
            "GRENADA"	=> "GD",
            "GUADELOUPE"	=> "GP",
            "GUAM" => "GU",
            "GUATEMALA" => "GT",
            "GUINEA" => "GN",
            "GUINEA-BISSAU" => "GW",
            "GUYANA" => "GY",
            "HAITI" => "HT",
            "HEARD & MCDONALD ISLAND"	=> "HM",
            "HONDURAS" => "HN",
            "HONG KONG" => "HK",
            "HUNGARY"	=> "HU",
            "ICELAND"	=> "IS",
            "INDIA" => "IN",
            "INDONESIA" => "ID",
            "IRAN, ISLAMIC REPUBLIC OF" => "IR",
           
            "IRAQ" => "IQ",
            "IRELAND"	=> "IE",
            "ISLE OF MAN"	=> "IM",
            "ISRAEL" => "IL",
            "ITALY" => "IT",
            "JAMAICA"	=> "JM",
            "JAPAN" => "JP",
            "JORDAN" => "JO",
            "KAZAKHSTAN" => "KZ",
            "KENYA" => "KE",
            "KIRIBATI" => "KI",
            "KOREA, DEM. PEOPLES REP OF" => "KP",
            "KOREA, REPUBLIC OF" => "KR",
            "KUWAIT" => "KW",
            "KYRGYZSTAN" => "KG",
            "LAO PEOPLE’S DEM. REPUBLIC" => "LA",
            "LATVIA" => "LV",
            "LEBANON"	=> "LB",
            "LESOTHO"	=> "LS",
            "LIBERIA"	=> "LR",
            "LIBYAN ARAB JAMAHIRIYA"	=> "LY",
            "LIECHTENSTEIN" => "LI",
            "LITHUANIA" => "LT",
            "LUXEMBOURG" => "LU",
            "MACAO" => "MO",
            "MACEDONIA" => "MK",
            "MADAGASCAR"	=> "MG",
            "MALAWI"	=> "MW",
            "MALAYSIA" => "MY",
            "MALDIVES" => "MV",
            "MALI" => "ML",
            "MALTA" => "MT",
            "MARSHALL ISLANDS" => "MH",
            "MARTINIQUE" => "MQ",
            "MAURITANIA" => "MR",
            "MAURITIUS" => "MU",
            "MAYOTTE"	=> "YT",
            "MEXICO" => "MX",
            "MICRONESIA" => "FM",
            "MOLDOVA"	=> "MD",
            "MONACO"	=> "MC",
            "MONGOLIA" => "MN",
            "MONTENEGRO" => "ME",
            "MONTSERRAT" => "MS",
            "MOROCCO"	=> "MA",
            "MOZAMBIQUE" => "MZ",
            "MYANMAR"	=> "MM",
            "NAMIBIA"	=> "NA",
            "NAURU" => "NR",
            "NEPAL" => "NP",
            
            "NETHERLANDS ANTILLES" => "AN",
            "NETHERLANDS" => "NL",
            "NEW CALEDONIA" => "NC",
            "NEW ZEALAND"	=> "NZ",
            "NICARAGUA" => "NI",
            "NIGER" => "NE",
            "NIGERIA"	=> "NG",
            "NIUE" => "NU",
            "NORFOLK ISLAND" => "NF",
            "NORTHERN MARIANA ISLANDS" => "MP",
            "NORWAY" => "NO",
            "OMAN" => "OM",
            "PAKISTAN" => "PK",
            "PALAU" => "PW",
            "PALESTINE" => "PS",
            "PANAMA" => "PA",
            "PAPUA NEW GUINEA" => "PG",
            "PARAGUAY" => "PY",
            "PERU" => "PE",
            //PHILIPPINES (REPUBLIC OF THE)	PH
            "PITCAIRN" => "PN",
            "POLAND"	=> "PL",
            "PORTUGAL" => "PT",
            "PUERTO RICO"	=> "PR",
            "QATAR" => "QA",
            "REUNION"	=> "RE",
            "ROMANIA"	=> "RO",
            "RUSSIAN"	=> "RU",
            "RWANDA"	=> "RW",
            "SAMOA" => "WS",
            "SAN MARINO" => "SM",
            "SAO TOME/PRINCIPE" => "ST",
            "SAUDI ARABIA" => "SA",
            "SCOTLAND" => "UK",
            "SENEGAL" => "SN",
            "SERBIA" => "RS",
            "SEYCHELLES" => "SC",
            "SIERRA LEONE" => "SL",
            "SINGAPORE" => "SG",
            "SLOVAKIA" => "SK",
            "SLOVENIA" => "SI",
            "SOLOMON ISLANDS"	=> "SB",
            "SOMALIA"	=> "SO",
            "SOMOA,GILBERT,ELLICE ISLANDS" => "AS",
            "SOUTH AFRICA" => "ZA",
            "SOUTH GEORGIA, SOUTH SANDWICH ISLANDS" => "GS",
            "SOVIET UNION" => "SU",
            "SPAIN" => "ES",
            "SRI LANKA" => "LK",
            "ST. HELENA"	=> "SH",
            
            "ST. KITTS AND NEVIS"	=> "KN",
            "ST. LUCIA" => "LC",
            "ST. PIERRE AND MIQUELON"	=> "PM",
            "ST. VINCENT & THE GRENADINES" => "VC",
            "SUDAN" => "SD",
            "SURINAME" => "SR",
            "SVALBARD AND JAN MAYEN" => "SJ",
            "SWAZILAND" => "SZ",
            "SWEDEN" => "SE",
            "SWITZERLAND"	=> "CH",
            "SYRIAN ARAB REPUBLIC" => "SY",
            "TAIWAN" => "TW",
            "TAJIKISTAN"	=> "TJ",
            "TANZANIA" => "TZ",
            "HAILAND"	=> "TH",
            "TOGO" => "TG",
            "TOKELAU"	=> "TK",
            "TONGA" => "TO",
            "TRINIDAD AND TOBAGO"	=> "TT",
            "TUNISIA"	=> "TN",
            "TURKEY" => "TR",
            "TURKMENISTAN" => "TM",
            "TURKS AND CAICOS ISLANDS" => "TC",
            "TUVALU" => "TV",
            "UGANDA"	=> "UG",
            "UKRAINE"	=> "UA",
            "UNITED ARAB EMIRATES" => "AE",
            //UNITED KINGDOM (no new registrations)	GB
            "UNITED KINGDOM" => "UK",
            "UNITED STATES" => "US",
            //UNITED STATES MINOR OUTL.IS.	UM
            "URUGUAY"	=> "UY",
            "UZBEKISTAN" => "UZ",
            "VANUATU"	=> "VU",
            "VATICAN CITY STATE" => "VA",
            "VENEZUELA" => "VE",
            "VIET NAM" => "VN",
            //VIRGIN ISLANDS (USA)	VI
            "WALLIS AND FUTUNA ISLANDS" => "WF",
            "WESTERN SAHARA" > "EH",
            "YEMEN" => "YE",
            "ZAMBIA"	=> "ZM",
            "ZIMBABWE" => "ZW"
        ];
    }

    //
}
