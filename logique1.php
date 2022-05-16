<?php 

// function rsum($v, $w)
// {
// 	$v += $w;
// 	return $v;
// }
 
// function rmul($v, $w)
// {
// 	$v *= $w;
// 	return $v;
// }
 
// $a = array(1, 2, 3, 4, 5);
// $x = array();
// $b = array_reduce($a, "rsum");
// $c = array_reduce($a, "rmul", 10);
// $d = array_reduce($x, "rsum", "Aucune donnée à réduire");


    $filename = __DIR__ . './data/data.json';

    $articles = [];
    $categories = [];
    $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $selectedCat = $_GET['cat'] ?? '';
    //echo $selectedCat;

    if(file_exists($filename))
    {
        $articles = json_decode(file_get_contents($filename),true) ?? [];
        $cattmp = array_map(fn ($a) => $a['category'], $articles );
        $categories = array_reduce($cattmp,function ($acc, $cat ){
            if(isset($acc[$cat]))
            {
                $acc[$cat]++;
            }else
            {
                $acc[$cat] = 1;
            }
            return $acc;
        } ,[]);
        //print_r($categories);

        $articlePercategories = array_reduce($articles, function ($acc, $article){
            if(isset($acc[$article['category']]))
            {
                $acc[$article['category']] = [...$acc[$article['category']], $article];
            }else
            {
                $acc[$article['category']] = [$article];
            }
            return $acc;
        }, []);
    }

   //echo count($articles);