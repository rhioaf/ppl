<?php
    function bubblesort(&$arr){
        $len = sizeof($arr);
        for($i = 0; $i < $len; $i++){
            for($j = 0; $j < $len - $i - 1; $j++){
                if($arr[$j] > $arr[$j+1]){
                    $temp = $arr[$j];
                    $arr[$j] = $arr[$j+1];
                    $arr[$j+1] = $temp;
                }
            }
        }
    }

    function selectionsort(&$arr){
        $len = sizeof($arr);
        for($i = 0; $i < $len; $i++){
            $minIndex = $i;
            for($j = $i + 1; $j < $len; $j++){
                if($arr[$j] < $arr[$minIndex]){
                    $minIndex = $j;
                }
            }
            if($arr[$i] > $arr[$minIndex]){
                $temp = $arr[$i];
                $arr[$i] = $arr[$minIndex];
                $arr[$minIndex] = $temp;
            }
        }
    }
    
    function printArray($arr){
        $len = sizeof($arr);
        for($i = 0; $i < $len; $i++){
            echo $arr[$i]. " ";
        }
        echo "<br>";
    }

    echo "Demonstration Bubble Sort <br>";
    $data = array(64, 6, 14, 2, 10, 199, 21, 45);
    echo "Unsorted Array <br>";
    printArray($data);

    bubblesort($data);

    echo "Sorted Array <br>";
    printArray($data);

    echo "Demonstration Selection Sort <br>";
    $data2 = array(100, 2, 5, 14, 25, 7, 14, 67, 1);

    echo "Unsorted Array <br>";
    printArray($data2);

    selectionsort($data2);

    echo "Sorted Array <br>";
    printArray($data2);

?>