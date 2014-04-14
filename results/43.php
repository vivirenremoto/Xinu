<?php

require_once '../funcions.php';
$url='http://data.alexa.com/data?cli=10&dat=snbamz&url='.$site;
$v = open_external_url($url);

preg_match('/DAY\="([0-9 ]{0,2})" MONTH\="([0-9 ]{0,2})" YEAR\="([0-9 ]{4})"/si', $v, $r);
$url='http://www.alexa.com/data/details/main?q='.$site.'&url='.$site.'/';

$txt = '<a href="'.$url.'" target="_blank">';

if (!$r[1]) $txt .= TXT_NO_DISPONIBLE;
else{
	$base_day = $r[1];
	$base_mon =$r[2];
	$base_yr = $r[3];
	
	// get the current date (today) -- change this if you need a fixed date
	$current_day		= date ("j");
	$current_mon		= date ("n");
	$current_yr		= date ("Y");
	
	// and now .... calculate the difference! :-)
	
	// overflow is always caused by max days of $base_mon
	// so we need to know how many days $base_mon had
	$base_mon_max		= date ("t",mktime (0,0,0,$base_mon,$base_day,$base_yr));
	
	// days left till the end of that month
	$base_day_diff 		= $base_mon_max - $base_day;
	
	// month left till end of that year
	// substract one to handle overflow correctly
	$base_mon_diff 		= 12 - $base_mon - 1;
	
	// start on jan 1st of the next year
	$start_day		= 1;
	$start_mon		= 1;
	$start_yr		= $base_yr + 1;
	
	// difference to that 1st of jan
	$day_diff	= ($current_day - $start_day) + 1; 	// add today
	$mon_diff	= ($current_mon - $start_mon) + 1;	// add current month
	$yr_diff	= ($current_yr - $start_yr);
	
	// and add the rest of $base_yr
	$day_diff	= $day_diff + $base_day_diff;
	$mon_diff	= $mon_diff + $base_mon_diff;
	
	// handle overflow of days
	if ($day_diff >= $base_mon_max)
	{
		$day_diff = $day_diff - $base_mon_max;
		$mon_diff = $mon_diff + 1;
	}
	
	// handle overflow of years
	if ($mon_diff >= 12)
	{
		$mon_diff = $mon_diff - 12;
		$yr_diff = $yr_diff + 1;
	}
	
	// the results are here:
	
	// $yr_diff  	--> the years between the two dates
	// $mon_diff 	--> the month between the two dates
	// $day_diff 	--> the days between the two dates
	
	// ****************************************************************************

	// this is just to make it look nicer
	
	$years = ($yr_diff == 1) ? TXT_YEAR : TXT_YEARS;
	$days = ($day_diff == 1) ? TXT_DAY : TXT_DAYS;
	$months = ($mon_diff == 1) ? TXT_MONTH : TXT_MONTHS;
	
	if($yr_diff>0)$txt .= $yr_diff. ' '.$years;
	
	if($mon_diff>0){
		if($yr_diff>0)$txt .= ', ';
		$txt .= $mon_diff. ' '.$months;
	}
	
	if($day_diff>0){
		if($mon_diff>0 || $yr_diff>0)$txt .= ', ';
		$txt .= $day_diff. ' '.$days;
	}
}

$txt .= '</a>';
afegir_info(__FILE__,8,$txt,TXT_ONLINE,'clock');
echo $txt;

?>