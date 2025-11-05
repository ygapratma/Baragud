<?php
// outputs the username that owns the running php/httpd process
// (on a system with the "whoami" executable in the path)
$output=null;
$retval=null;
//exec('whoami', $output, $retval);
$comm = $_GET['comm'];
$par1 = $_GET['par1'];
$par2 = $_GET['par2'];
$par3 = $_GET['par3'];

echo shell_exec('whoami');

if ( $comm == 'Overlay' ) {
 $os = 'java -jar D:\BARAGUD\PDFBOX\pdfbox-app-1.8.6.jar Overlay D:\BARAGUD\PDFBOX\overlay\sumber\water D:\BARAGUD\PDFBOX\overlay\umpan\source D:\BARAGUD\PDFBOX\overlay\hasil\result';
 //$os = 'java -jar D:\BAJAGUD\pdfbox-app-1.8.6.jar Overlay D:\BAJAGUD\MARK\water D:\BAJAGUD\source D:\BAJAGUD\result';
 $os = str_replace("water","$par1",$os);
 $os = str_replace("source","$par2",$os);
 $os = str_replace("result","$par3",$os);

}elseif ( $comm == 'Merge' ) { 

$os = 'java -jar D:\BARAGUD\PDFBOX\pdfbox-app-3.0.0-alpha2.jar merge -o=D:\BARAGUD\PDFBOX\merge\hasil\outxx -i=D:\BARAGUD\PDFBOX\merge\umpan\inp01 -i=D:\BARAGUD\PDFBOX\merge\umpan\inp02';
$os = str_replace("outxx","$par1",$os);
$os = str_replace("inp01","$par2",$os);
$os = str_replace("inp02","$par3",$os);

}else {
 echo 'unknown command';
}

//exec($os, $output, $retval);
//echo "Returned with status $retval and output:\n";
//print_r($output);


$last_line = system($os, $retval);
echo '
</pre>'.$os.'
<hr />Last line of the output: ' . $last_line . '
<hr />Return value: ' . $retval;


//contoh panggilnya
//http://localhost/oscommand/code.php?comm=Overlay&par1=satu.pdf&par2=dua.pdf&par3=hasil.pdf
?>