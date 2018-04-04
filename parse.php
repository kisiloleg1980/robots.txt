<?php

require_once 'PHPExcel-1.8/Classes/PHPExcel.php';

class ClassFileName
{
	const NAME='robots.txt';
	
	private $path;

	public $DataFile = array ( 'Direct1' => false, 'Direct6' => false, 'Direct8' => false, 'Direct10' => false, 'Direct11' => false,  'Direct12' => false);

	public function getDirective1(){
		$handle = @fopen($this->path.'/'.self::NAME,"r");

		if ($handle<>false) {
			 $this->DataFile['Direct1']=true; 
		} 
	}


	public function getDirective_6_8_11(){
		$handle = @fopen($this->path.'/'.self::NAME,"r");

		if ($handle<>false) {
			$counter=0;
			while (!feof($handle)) {
				$str=fgets($handle);

				if (stristr($str, 'Host') == true){
					$this->DataFile['Direct6']=true;

					if ( $counter >= 1 ){
						$this->DataFile['Direct8']=false;
					} else {
						$counter++;
						$this->DataFile['Direct8']=true;
					}
				}

				if (stristr($str, 'Sitemap') == true) {
					$this->DataFile['Direct11']=true;
				}
			}
		}
	}


	public function getDirective_10(){
		$Headers = @get_headers($this->path.'/'.self::NAME);
		if ($Headers<>false) {
			foreach ($Headers as  $value) {
					if (stristr($value,"Content-Length")) {
						$value = explode(":",$value);
						
						if (trim($value[1]) < 32768) {
						 	$this->DataFile['Direct10']=true;
						} else {
							 $this->DataFile['Direct10']=false;
						}
					}
					 if (@strstr($value,"HTTP")) {
						 $Result=preg_match('/\s200\s/', $value);
						 if ($Result==true) {
						 	$this->DataFile['Direct12']=true;
						 }				
					 }
			}
		}
	}

	public function create_report(){
		$phpexcel = new PHPExcel(); 
		  $page = $phpexcel->setActiveSheetIndex(0); 
		  $page->setCellValue("A1", "Название проверки"); 
		  $page->setCellValue("B1", "Статус");

		  $page->setCellValue("A2", "Проверка наличия файла robots.txt"); 
		  if ($this->DataFile['Direct1']==true){
		  		$page->setCellValue("B2", "Ok");
				} else {
					$page->setCellValue("B2", "Ошибка");		
				}

		$page->setCellValue("A3", "Проверка указания директивы Host");
		if ($this->DataFile['Direct6']==true){
		  		$page->setCellValue("B3", "Ok");
				} else {
					$page->setCellValue("B3", "Ошибка");		
				} 	

		$page->setCellValue("A4", "Проверка количества директив Host, прописанных в файле");
		if ($this->DataFile['Direct8']==true){
		  		$page->setCellValue("B4", "Ok");
				} else {
					$page->setCellValue("B4", "Ошибка");		
				} 

		$page->setCellValue("A5", "Проверка размера файла robots.txt");
		if ($this->DataFile['Direct10']==true){
		  		$page->setCellValue("B5", "Ok");
				} else {
					$page->setCellValue("B5", "Ошибка");		
				} 

		$page->setCellValue("A6", "Проверка указания директивы Sitemap");
		if ($this->DataFile['Direct11']==true){
		  		$page->setCellValue("B6", "Ok");
				} else {
					$page->setCellValue("B6", "Ошибка");		
				}

		$page->setCellValue("A7", "Проверка кода ответа сервера для файла robots.txt");
		if ($this->DataFile['Direct12']==true){
		  		$page->setCellValue("B7", "Ok");
				} else {
					$page->setCellValue("B7", "Ошибка");		
				} 		 							

		  $page->setTitle("Example"); 
		  

		  $objWriter = PHPExcel_IOFactory::createWriter($phpexcel, 'Excel2007');
		  
		  $objWriter->save("example.xlsx");
	}

	function __construct($path)
	{
		$this->path=$path;

		$this->getDirective1();
		$this->getDirective_6_8_11();
		$this->getDirective_10();
	}
}







