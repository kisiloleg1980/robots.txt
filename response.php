<?php


require_once 'parse.php';

$nameUrl=$_REQUEST['nameUrl'];

$Example=new ClassFileName($nameUrl);

// $Example->create_report();

?>
<table class="table table-bordered">
	<caption>Результаты</caption>
	<thead>
	   <tr>
	        <th>Название проверки</th>
	        <th>Статус</th>
	   </tr>
	</thead>
	<tbody>
		<tr>
			<td>
				Проверка наличия файла robots.txt
			</td>
			<td>
				<?php 
					if ($Example->DataFile['Direct1']==true){
						echo "<div class='alert alert-success'>Ok</div>";
					} else {
						echo "<div class='alert alert-danger'>Ошибка</div>";
					}
				?>
			</td>
		</tr>
		<tr>
			<td>
				Проверка указания директивы Host
			</td>
			<td>
				<?php 
					if ($Example->DataFile['Direct6']==true){
						echo "<div class='alert alert-success'>Ok</div>";
					} else {
						echo "<div class='alert alert-danger'>Ошибка</div>";
					}
				?>
			</td>
		</tr>
		<tr>
			<td>
				Проверка количества директив Host, прописанных в файле
			</td>
			<td>
				<?php 
					if ($Example->DataFile['Direct8']==true){
						echo "<div class='alert alert-success'>Ok</div>";
					} else {
						echo "<div class='alert alert-danger'>Ошибка</div>";
					}
				?>
			</td>
		</tr>
		<tr>
			<td>
				Проверка размера файла robots.txt
			</td>
			<td>
				<?php 
					if ($Example->DataFile['Direct10']==true){
						echo "<div class='alert alert-success'>Ok</div>";
					} else {
						echo "<div class='alert alert-danger'>Ошибка</div>";
					}
				?>
			</td>
		</tr>
		<tr>
			<td>
				Проверка указания директивы Sitemap
			</td>
			<td>
				<?php 
					if ($Example->DataFile['Direct11']==true){
						echo "<div class='alert alert-success'>Ok</div>";
					} else {
						echo "<div class='alert alert-danger'>Ошибка</div>";
					}
				?>
			</td>
		</tr>
		<tr>
			<td>
				Проверка кода ответа сервера для файла robots.txt
			</td>
			<td>
				<?php 
					if ($Example->DataFile['Direct12']==true){
						echo "<div class='alert alert-success'>Ok</div>";
					} else {
						echo "<div class='alert alert-danger'>Ошибка</div>";
					}
				?>
			</td>
		</tr>

	</tbody>
 </table>
 <button type="button" class="btn btn-info" ><a href="example.xlsx">Загрузить результаты</a></button>

