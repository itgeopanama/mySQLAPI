<?php
	
	namespace App\Http\Controllers;
	
	use Illuminate\Http\Request;
	use DB;
	use File;
	class ApiController extends Controller
	{
		
	    public $posttable;
		public $postfields;
		public $postvalues;
		
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
					if(count($data)>0 && ($table->Tables_in_fiverr_nfmovil != 'exportmaster')){
						$tot_record_found=1;
						$path = public_path().'/exportdata/'.$batch;
						if(!file_exists($path)){
							File::makeDirectory($path, $mode = 0777, true, true);
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
		
		public function getTableData(){
			$resp = [];
			$data	= [];
			if(isset($_REQUEST['table_name'])){
				
				$data[$_REQUEST['table_name']]=DB::table($_REQUEST['table_name'])->get();
				if(!empty($data[$_REQUEST['table_name']])){
					$resp['status'] = '200';
					$resp['msg'] = 'Success';
					$resp['data'] = $data;
					}else{
					$resp['status'] = '200';
					$resp['msg'] = 'No data found';
					$resp['data'] = '';
				}
				}else{
				$tableList = ['art_articulo','cli_cliente','ven_vendedor','trp_traspaso','trd_traspaso_detalle','rut_ruta','prc_precio','des_descuento','pro_promocion','bod_bodega'];
				
				foreach($tableList as $table)
				{
					$data[$table]=DB::table($table)->get();
				}
				$resp['status'] = '200';
				$resp['msg'] = 'Success';
				$resp['data'] = $data;
			}
			echo json_encode($resp);exit;
		}
		
		public function postTableData(){
			$tableData = json_decode($_REQUEST['data']);
			$this->fields = '';
			foreach($tableData as $key=>$value){
				
				if(!empty($value)){
					$this->posttable = $key;
					foreach($value as $insertData){
						$this->postfields = array_keys((array)$insertData);
						$this->postvalues = (array)$insertData;
						$this->insert();
					}
					
				}
			}
		}
		
		public function fields_to_string(){
			return "`".implode("`, `", $this->postfields)."`";
		}
		
		public function properties_to_string(){
			return "'".implode("', '", $this->postvalues)."'";
		}
		
		
		public function insert(){
			global $dbh;
			DB::statement('SET FOREIGN_KEY_CHECKS=0');
			$sql = "INSERT INTO `{$this->posttable}` (".$this->fields_to_string().") VALUES (".$this->properties_to_string().");";
			$resp = DB::insert($sql);
			if($resp == 1){
				$resp['status'] = '200';
				$resp['msg'] = 'Success';
			}else{
				$resp['status'] = '502';
				$resp['msg'] = 'Error';
			}
			DB::statement('SET FOREIGN_KEY_CHECKS=1');
			echo json_encode($resp);exit;
		}
	}
