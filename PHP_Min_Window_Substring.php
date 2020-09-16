<?php

function MinWindowSubstring($strArr)
{

    $string = $strArr[0];
    $chars = str_split($strArr[1]);

    $response = null;

    foreach ($chars as $primaryCharIndex => $primaryChatValue) {

        $forkIndexes = getCharIndexes($primaryChatValue, $string);

        foreach ($forkIndexes as $forkIndex) {

            $usedIndexes = [$forkIndex];

            foreach ($chars as $secondaryChatIndex => $secondaryChatValue) {

                if ($primaryCharIndex == $secondaryChatIndex) {
                    continue;
                }

                $matches = getCharIndexes($secondaryChatValue, $string);
                $matches = array_diff($matches, $usedIndexes);

                $selectedIndex = null;
                $selectedDistance = null;

                foreach ($matches as $match) {

                    $min = min($usedIndexes);
                    $max = max($usedIndexes);

                    $center = ($max + $min) / 2;

                    $distance = 0;

                    if ($match > $center) {
                        $distance = $match - $center;
                    } elseif ($match < $center) {
                        $distance = $center - $match;
                    }

                    if (is_null($selectedDistance) || $selectedDistance > $distance) {
                        $selectedIndex = $match;
                        $selectedDistance = $distance;
                    }
                }

                $usedIndexes[] = $selectedIndex;
            }

            $stringPart = substr($string, min($usedIndexes), max($usedIndexes) - min($usedIndexes) + 1);

            if (is_null($response) || strlen($response) > strlen($stringPart)) {
                $response = $stringPart;
            }
        }

    }

    return $response;

}

function getCharIndexes($char, $string)
{
    preg_match_all("/$char/", $string, $matches, PREG_OFFSET_CAPTURE);

    return array_map(function ($match) {

        return $match[1];

    }, $matches[0]);
}

// keep this function call here  
echo MinWindowSubstring(fgets(fopen('php://stdin', 'r')));

?>
