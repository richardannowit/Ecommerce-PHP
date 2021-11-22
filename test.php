<?php
// $a = false;
// if ($a = true) {
// 	echo "True";
// } else {
// 	echo "false";
// }

$a = "hi,world";
$c = explode(",", $a);
// var_dump($c);
$b = array_map("strtoupper", $c);

foreach ($b as $value) {
	print "$value";
}


?>





















<!-- 

<head>
	<script>
		function myFunction() {
			window.open("https://www.w3schools.com", "Chao");
		}
	</script>
</head>

<body onload="myFunction()">

</body> -->