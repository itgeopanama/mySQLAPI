<?php
	
	namespace App\Http\Controllers;
	
	use Illuminate\Http\Request;
	use DB;
	use File;
	class ApiController extends Controller
	{
		/**
			* Display a listing of the resource.
			*
			* @return \Illuminate\Http\Response
		*/
		public function index()
		{
			//
		}
		
		/**
			* Show the form for creating a new resource.
			*
			* @return \Illuminate\Http\Response
		*/
		public function create()
		{
			//
		}
		
		/**
			* Store a newly created resource in storage.
			*
			* @param  \Illuminate\Http\Request  $request
			* @return \Illuminate\Http\Response
		*/
		public function store(Request $request)
		{
			//
		}
		
		/**
			* Display the specified resource.
			*
			* @param  int  $id
			* @return \Illuminate\Http\Response
		*/
		public function show($id)
		{
			//
		}
		
		/**
			* Show the form for editing the specified resource.
			*
			* @param  int  $id
			* @return \Illuminate\Http\Response
		*/
		public function edit($id)
		{
			//
		}
		
		/**
			* Update the specified resource in storage.
			*
			* @param  \Illuminate\Http\Request  $request
			* @param  int  $id
			* @return \Illuminate\Http\Response
		*/
		public function update(Request $request, $id)
		{
			//
		}
		
		/**
			* Remove the specified resource from storage.
			*
			* @param  int  $id
			* @return \Illuminate\Http\Response
		*/
		public function destroy($id)
		{
			//
		}
		
		/**
			* Export data to csv.
			*
			* @param  int  $id
			* @return \Illuminate\Http\Response
		*/
		
		public function exporMysqlCsv($table = ''){
			if(empty($table)){
				$tables = DB::select('SHOW TABLES');
				$batch = time();
				$tot_record_found=0;
				foreach($tables as $table)
				{
					$data=DB::table($table->Tables_in_fiverr_nfmovil)->get();
					if(count($data)>0 && ($table->Tables_in_fiverr_nfmovil != 'exportmaster'){
						$tot_record_found=1;
						$path = public_path().'/exportdata/'.$batch;
						//$path = public_path().'/exportdata/test2/';
						if(!file_exists($path)){
							File::makeDirectory($path, $mode = 0777, true, true);
							}else{
							//echo time();
						}
						$CsvData[] = DB::getSchemaBuilder()->getColumnListing($table->		Tables_in_fiverr_nfmovil);
						foreach($data as $value){
							$CsvData[]=(array)$value;
						}
						
						$filename= $batch."-".$table->Tables_in_fiverr_nfmovil.".csv";
						$file_path=$path.'/'.$filename;   
						$file = fopen($file_path,"w+");
						foreach ($CsvData as $exp_data){
							fputcsv($file,$exp_data);
						}   
						fclose($file);          
						
					}
					
				}
				if($tot_record_found==1){
						DB::table('exportmaster')->insert(
						['tables' => 'all', 'from' => 'mysql','batchName'=>$batch]
						);
					
					}
			}
		}
	}
