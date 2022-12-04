<?php
 $sims = [
  "!","$","#","2022","?","@",
  ".","-",":","&",",","_"
 ];
 
 $dseps = [
  ".","-","_",":","|","/",","
 ];

 $leet = [
  "o" => "0",
  "e" => "3",
  "i" => "1",
  "a" => "4"
 ];

 function leetspeek($thing) {
  global $leet;
  $newthing = "";
  for($i = 0; $i < strlen($thing); $i++) {
   if(array_key_exists($thing[$i], $leet) !== false) {
    $newthing .= $leet[$thing[$i]];
   } else {
    $newthing .= $thing[$i];
   }
  }
  return $newthing;
 }
 
 function printsit($fr, $dsep, $sim, $fr1) {
  $datas = "";
  $datas .= "{$fr}{$dsep}{$fr1}{$sim}\n";
  $datas .= "{$sim}{$fr}{$dsep}{$fr1}{$sim}\n";
  $datas .= "{$fr}{$dsep}{$fr1}{$dsep}{$sim}\n";
  $frl = leetspeek($fr);
  $fr1l = leetspeek($fr1);
  $datas .= "{$frl}{$dsep}{$fr1l}{$sim}\n";
  $datas .= "{$sim}{$fr}{$dsep}{$fr1}{$sim}\n";
  $datas .= "{$frl}{$dsep}{$fr1l}{$dsep}{$sim}\n";
  $fr = ucfirst($fr);
  $fr1 = ucfirst($fr1);
  $datas .= "{$fr}{$dsep}{$fr1}{$sim}\n";
  $datas .= "{$sim}{$fr}{$dsep}{$fr1}{$sim}\n";
  $datas .= "{$fr}{$dsep}{$fr1}{$dsep}{$sim}\n";
  $frl = leetspeek($fr);
  $fr1l = leetspeek($fr1);
  $datas .= "{$frl}{$dsep}{$fr1l}{$sim}\n";
  $datas .= "{$sim}{$fr}{$dsep}{$fr1}{$sim}\n";
  $datas .= "{$frl}{$dsep}{$fr1l}{$dsep}{$sim}\n";
  return $datas;
 }

 function generator($infile, $outfile) {
  global $sims, $dseps;
  $fdout = fopen($outfile, "w");
  $fd = fopen($infile, "r");
  while(($fr = fgets($fd, 254))) {
   print($fr);
   $fd1 = fopen($infile, "r");
   while(($fr1 = fgets($fd1, 254))) {
    $fr = trim($fr);
    $fr1 = trim($fr1);
    if($fr === $fr1) continue;
    for($a=0;$a<count($sims);$a++) {
     for($i=0;$i<count($dseps);$i++) {
      $datas = printsit($fr, $dseps[$i], $sims[$a], $fr1);
      echo($datas);
      fwrite($fdout, $datas);
     }
    }
   }
   fclose($fd1);
  }
  fclose($fd);
  fclose($fdout);
 }

 if($argc < 3) {
  print("<infile> <outfile>\n");
  die();
 }

 generator($argv[1], $argv[2]);
?>
