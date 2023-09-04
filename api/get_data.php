<?php
function getHTML($url,$timeout)
{
        $header = array();
        $header[0] = "Accept: text/xml,application/xml,application/xhtml+xml,";
        $header[0] .= "text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5";
        $header[] =  "Cache-Control: max-age=0";
        $header[] =  "Connection: keep-alive";
        $header[] = "Keep-Alive: 300";
        $header[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
        $header[] = "Accept-Language: en-us,en;q=0.5";
        $header[] = "Pragma: "; // browsers keep this blank.

       $ch = curl_init($url); // initialize curl with given url
       curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER["HTTP_USER_AGENT"]); // set  useragent
       curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // write the response to a variable
       curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // follow redirects if any
       curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout); // max. seconds to execute
       curl_setopt($ch, CURLOPT_FAILONERROR, 1); // stop when it encounters an error
       curl_setopt($ch, CURLOPT_COOKIESESSION, true );
       return @curl_exec($ch);
}

$url = "https://www.booking.com/searchresults.html?ss=Gaza&ssne=Gaza&ssne_untouched=Gaza&label=hotels-arabic-ar-uxEKYj6dRBuxP3u4qPGOlAS500819109753%3Apl%3Ata%3Ap1%3Ap2%3Aac%3Aap%3Aneg%3Afi%3Atikwd-296734485803%3Alp2275%3Ali%3Adec%3Adm%3Appccp%3DUmFuZG9tSVYkc2RlIyh9YcsZ-Id2vkzIfTmYhvC5HOg&aid=309654&lang=en-us&sb=1&src_elem=sb&src=searchresults&dest_id=900051778&dest_type=city&group_adults=2&no_rooms=1&group_children=0";
$sitePage = getHTML($url,10);

$s = explode('href="',$sitePage);
$t = explode('">',$s[1]);
print $t[0];


?>