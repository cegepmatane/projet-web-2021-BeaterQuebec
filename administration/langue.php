<?php
if(!isset($_GET['lang']))
{
  $locale = 'fr_CA.utf8';
  $urlLocale = 'fr';
}else if ($_GET['lang'] == 'en' ){
  $locale = 'en_US.utf8';
  $urlLocale = 'en';
}else{
  $locale = 'fr_CA.utf8';
  $urlLocale = 'fr';
}
$domain = 'messages';
setlocale(LC_ALL, $locale);
putenv("LC_ALL=$locale");

bindtextdomain($domain, "./locale");
bind_textdomain_codeset($domain, 'UTF-8');
textdomain($domain);

?>