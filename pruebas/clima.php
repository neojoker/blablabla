<link rel="stylesheet" href="style.css" type="text/css" media="screen" /> 
<?php
include("class.google.weather.php");
$selectedCity = (isset($_POST["city"]) && $_POST["city"] != "")?$_POST["city"]:"Madrid";

$googleWeather = new googleweather($selectedCity);
?>


<form method="post" name="weather">
<select name="city" onChange="weather.submit();">
<?php
foreach($googleWeather->cities as $city){
?>
<option value="<?php echo $city;?>" <?php echo ($selectedCity == $city)?"selected":"";?>><?php echo $city;?></option>
<?php
}
?>
</select>
</form>

<?php
$googleWeather->getWeatherInfo();
$googleWeather->display_weather();
?>