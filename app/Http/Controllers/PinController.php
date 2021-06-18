<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Handles the generation a PIN number.
 */
class PinController extends Controller
{
    
    /**
     * Generates a 4 digit numeric pin number
     * 
     * @return string
     */
    public function getPinNumber()
    {
        $blacklistedPins = [
            '1111',
            '2222',
            '3333',
            '4444',
            '5555',
            '6666',
            '7777',
            '8888',
            '9999',
            '0123',
            '3210',
            '1234',
            '2345',
            '3456',
            '4567',
            '5678',
            '6789',
            '7890',
            '0987',
            '9876',
            '8765',
            '7654',
            '6543',
            '5432',
            '4321',
            '3210',
        ];

        $digit = $this->generatePinNumber();
        $isGoodDigit = false;
        
        //Loop through the pins.
        while (!$isGoodDigit) {
            $invalidDigit = false;

            foreach ($blacklistedPins as $badDigit) {
                if (strcmp($digit, $badDigit) == 0) {
                    $invalidDigit = true;
                }
            }

            if ($invalidDigit) {
                $digit = $this->generatePinNumber();
            } else {
                $isGoodDigit = true;
            }
        }

        return $digit;
    }

    /**
     * Generates a new 4 digit pin number
     * 
     * @return string
     */
    protected function generatePinNumber()
    {
        $digits = [];
        for ($i = 0; $i <= 3; $i++) {
            $singleDigit = random_int(0, 9);
            array_push($digits, $singleDigit);
        }

        //concat the generated digits via cast
        $digit = (string) $digits[0] . $digits[1] . $digits[2] . $digits[3];

        return $digit;
    }

    /**
     * Returns a series of pins in JSON format
     * 
     * @param $req The request object.
     * 
     * @return application/json
     */
    public function getPinNumbers(Request $req)
    {
        $req->validate(
            [
            'totalPins' => 'required|integer|max:9974',
            ]
        );

        $totalPins = $req->totalPins;

        $pins = [];

        for ($i = 0; $i < $totalPins; $i++) {
            $digit = $this->getPinNumber();

            //Check if the pin already exists in the array, otherwise get a new one.
            $isNotDupe = false;

            while (!$isNotDupe) {
                if (!in_array($digit, $pins)) {
                    array_push($pins, $digit);
                    $isNotDupe = true;
                } else {
                    $digit = $this->getPinNumber();
                }
            }
        }

        $pins = json_encode($pins);

        return $pins;
    }

    /**
     * Returns the web view with the PIN number
     *  
     * @return view
     */
    public function viewPinNumber()
    {
        return View('main');
    }
}
