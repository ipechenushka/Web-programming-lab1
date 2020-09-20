<?php 
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Результат</title>
	<meta charset="utf-8">
	<style type="text/css">
		body {
			background-color: #2c2c2c;
			color: #fff;
		}

		table {
			border-collapse: collapse;
			border-color: #fff;
			margin: auto;

		}

		td {
			padding: 10px;
		}

		h1 {
			text-align: center;
		}

		a {
			text-decoration: none;
		}
	</style>
</head>
<body>
	<div id="res">
		<h1>Результат</h1>
		<table class="results" border="2">
			<tr>
				<td>
					Значение X
				</td>
				<td>
					Значение Y
				</td>
				<td>
					Значение R
				</td>
				<td>
					Результат попадания
				</td>
				<td>
					Текущее время
				</td>
				<td>
					Время выполнения скрипта
				</td>
			</tr>
			<?php
				$start = microtime(true);
				date_default_timezone_set('Europe/Moscow');

				$x = $_GET['X-value'];
				$r = $_GET['R-value'];
				$y = $_GET['Y-value'];
			
				if(!isset($_SESSION['result'])){
					$_SESSION['result'] = array();
				}


				for($i = 0; $i < count($x); $i++){
					for($j = 0; $j < count($r); $j++){
						
						if ($x[$i] > 5 || $x[$i] < -3 || $r[$j] < 0 || $r[$j] > 5 || $y < -3 || $y > 5) {
							$datas[0] = "ERROR";
							$datas[1] = "ERROR";
							$datas[2] = "ERROR";							
							$datas[3] = "ERROR";
							$datas[4] = "ERROR";
							$datas[5] = "ERROR";
							array_push($_SESSION['result'], $datas);
						} else {

							$datas[0] = $x[$i];
							$datas[1] = $y;
							$datas[2] = $r[$j];
								 
							if(($x[$i] == $y && $x[$i] >= -$r[$j] && $y <= 0) || ($x[$i] * $x[$i] + $y * $y <= ($r[$j] / 2) * ($r[$j] / 2)) || ($x[$i] >= 0 && $x[$i] <= $r[$j] && $y >= 0 && $y <= $r[$j])){
									 $datas[3] = "Попала";
							} else {
								$datas[3] = "НЕ попала";
							}
								
							$datas[4] = date('H:i:s');
							$datas[5] = microtime(true) - $start;

							array_push($_SESSION['result'], $datas);
						}

					}
				}

				foreach ($_SESSION['result'] as $anwer) {
						echo "<tr>";
					foreach ($anwer as $val) {
							echo "<td>";
							echo $val;
							echo "</td>";
						}	

						echo "</tr>";
				}
			?>
		</table>
	</div>
	<div class="return">
		<button><a href="javascript:history.back()">Вернуться назад</a></a></button>
	</div>
</body>
</html>


