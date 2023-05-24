
<?php

function generate_captcha () {

    $first = rand (10, 100);
    $second = rand (1, $first);
    $thrid = $first - $second;

    $operation = ["-", "plus", "minus", "+"][rand (0, 3)];

    $ask = shuffle_words (digit_to_string ($thrid) . " " . $operation . " " . digit_to_string ($second));
    $answer = $first;

    if ($operation == "minus" || $operation == "-") {

        $ask = shuffle_words (digit_to_string ($first) . " " . $operation . " " . digit_to_string ($second));
        $answer = $thrid;

    }

    return [ "ask" => $ask, "answer" => $answer];

}

function shuffle_words ($sentence) {

    $words = explode (" ", $sentence);
    $distorted_words = [];

    foreach ($words as $word) {

        $distorted = "";

        if (strpos ($word, "-") == false) {

            if (strlen ($word) <= 3) $distorted = $word;

            else {

                $first_char = $word[0];
                $last_char = $word[strlen ($word) - 1];
                $middle_chars = str_shuffle (substr ($word, 1, -1));

                $distorted = $first_char . $middle_chars . $last_char;

            }
        }

        elseif (strpos ($word, "-") !== false) {

            $i = 0;

            foreach (explode ("-", $word) as $sub_word) {

                $i++;

                $first_char = $sub_word[0];
                $last_char = $sub_word[strlen ($sub_word) - 1];
                $middle_chars = str_shuffle (substr ($sub_word, 1, -1));

                $distorted .= (strlen ($sub_word) <= 3) ? $sub_word : $first_char . $middle_chars . $last_char;

                if ($i == 1) $distorted .= "-";

            }
        }

        else $distorted = $word;

        $distorted_words[] = $distorted;

    }

    return implode (" ", $distorted_words);

}

function digit_to_string($number) {

    $full = "";

    $unit = ["zero", "one", "two", "three", "four", "five", "six", "seven", "eight", "nine", "ten"];
    $dozen = ["eleven", "twelve", "thirteen", "fourteen", "fifteen", "sixteen", "seventeen", "eighteen", "nineteen"];
    $dozens = ["", "", "twenty", "thirty", "forty", "fifty", "sixty", "seventy", "eighty", "ninety"];

    if ($number <= 10) $full = $unit[$number];

    elseif ($number >= 11 && $number <= 19) $full = $dozen[$number - 11];
    elseif ($number >= 20 && $number <= 99) {

        $tens = (int)($number / 10);
        $ones = $number % 10;
        $full = (rand (0, 1) == 1) ? $dozens[$tens] . "-" . $unit[$ones] : $dozens[$tens] . " " . $unit[$ones];

        if ($ones === 0) $full = $dozens[$tens];

    }

    return $full;

}
