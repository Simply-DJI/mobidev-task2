<?php

/**
 * Class Test.
 */
class Test
{
    private array $units = [
        "ZERO",
        "ONE",
        "TWO",
        "THREE",
        "FOUR",
        "FIVE",
        "SIX",
        "SEVEN",
        "EIGHT",
        "NINE",
        "TEN",
        "ELEVEN",
        "TWELVE",
        "THIRTEEN",
        "FOURTEEN",
        "FIFTEEN",
        "SIXTEEN",
        "SEVENTEEN",
        "EIGHTEEN",
        "NINETEEN",
    ];

    private array $tens = [
        "ZERO",
        "TEN",
        "TWENTY",
        "THIRTY",
        "FORTY",
        "FIFTY",
        "SIXTY",
        "SEVENTY",
        "EIGHTY",
        "NINETY"
    ];

    private array $hundreds = [
        "HUNDRED",
        "THOUSAND",
        "MILLION",
        "BILLION",
    ];

    /**
     * @param int $number
     * @return string
     */
    public function numberToWord(int $number): string
    {
        return $this->processNumber($number);
    }

    /**
     * @param int $number
     * @return string
     */
    private function processNumber(int $number): string
    {
        $result = "";
        $numberArr = explode(".", number_format($number, 2, ".", ","));
        $wholeArr = array_reverse(explode(",", $numberArr[0]));
        krsort($wholeArr, 1);

        foreach ($wholeArr as $key => $i) {
            while (substr($i, 0, 1) == "0")
                $i = substr($i, 1, 5);
            if ($i < 20) {
                $result .= $this->units[$i];
            } elseif ($i < 100) {
                if (substr($i, 0, 1) != "0") {
                    $result .= $this->units[substr($i, 0, 1)] . " " . $this->hundreds[0];
                }
                if (substr($i, 1, 1) != "0") {
                    $result .= " " . $this->units[substr($i, 1, 1)];
                }
            } else {
                if (substr($i, 0, 1) != "0") {
                    $result .= $this->units[substr($i, 0, 1)] . " " . $this->hundreds[0];
                }
                if (substr($i, 1, 1) != "0") {
                    $result .= " " . $this->tens[substr($i, 1, 1)];
                }
                if (substr($i, 2, 1) != "0") {
                    $result .= " " . $this->units[substr($i, 2, 1)];
                }
            }
            if ($key > 0) {
                $result .= " " . $this->hundreds[$key] . " ";
            }
        }

        return $this->getTest($result, $numberArr[1]);
    }

    /**
     * @param string $result
     * @param $decimalNumbers
     * @return string
     */
    private function getTest(string $result, $decimalNumbers): string
    {
        if ($decimalNumbers > 0) {
            $result .= " and ";
            if ($decimalNumbers < 20) {
                $result .= $this->units[$decimalNumbers];
            } elseif ($decimalNumbers < 100) {
                $result .= $this->tens[substr($decimalNumbers, 0, 1)];
                $result .= " " . $this->units[substr($decimalNumbers, 1, 1)];
            }
        }

        return $result;
    }
}

$test = new Test();
echo 'Result: ' . $test->numberToWord((int) $argv[1]) . "\n";
