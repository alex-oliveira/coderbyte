<?php 

function FindIntersection($strArr) {

  $arr1 = explode(', ', $strArr[0]);
  $arr2 = explode(', ', $strArr[1]);

  $intersection = array_intersect($arr1, $arr2);

  return empty($intersection) ? false : implode(',', $intersection);

}
   
// keep this function call here  
echo FindIntersection(fgets(fopen('php://stdin', 'r')));  

?>
