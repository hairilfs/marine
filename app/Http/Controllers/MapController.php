<?php namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Harbour_Master;
use App\Model\Mapping_Map_Harbour_Master;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;

use \View;

class MapController extends BaseController {

    public function __construct()
    {
        $this->middleware('auth');
    }

	/**
	* Display a listing of the resource.
	*
	* @return Response
	*/
	public function index()	{ 

		// $data = Map::orderBy('id')->get();		
        // $data = DB::select('select * from vw_faculty ');    
		return View::make('map.index');
	}

	public function map_user(){
		return View::make('map.map_user');		
	}

	/**
	* Display a listing of the resource.
	*
	* @return Response
	*/
	public function manage() { 
        $list_harbour_master = Harbour_Master::orderBy('name')->lists('name', 'Id')->all();
		return View::make('map.manage')->with('list_harbour_master', $list_harbour_master);
	}

	public function view()
	{
		// $data = Map::orderBy('id')->get();		
        // $data = DB::select('select * from vw_faculty ');    
		return View::make('faculty.view');
	}

	public function save_location(){
		try{

			$rules = array(
				'id_harbour_master' => 'required',
				'locationX' => 'required',
				'locationY' => 'required'				
				);

			$validator = Validator::make(Input::all(), $rules);
			//custom validation
			
			if($validator->fails()){

				$input = Input::all();
			} else {
				//custom validation
				
				//delete previous existing harbour_master
				$data = Mapping_Map_Harbour_Master::where('id_harbour_master', Input::get('id_harbour_master'))->first();
				if(!empty($data)){
					// $data = Mapping_Map_Harbour_Master::find($data->id);
					$data->destroy($data->id);
				}
				
				$mapping_map_harbour_master = new Mapping_Map_Harbour_Master();
				$mapping_map_harbour_master->id_harbour_master = Input::get('id_harbour_master');
				$mapping_map_harbour_master->x = Input::get('locationX');
				$mapping_map_harbour_master->y = Input::get('locationY');
				$mapping_map_harbour_master->created_date = date('Y-m-d H:i:s');
				$mapping_map_harbour_master->created_by = 'System';
				$mapping_map_harbour_master->save();			
								
				return json_encode(true, JSON_NUMERIC_CHECK);
			}

		} catch(QueryException $e){
			Log::error('Found Exceptions. '.$e);
			$message = new MessageBag;
			$message->add('Error', $e->getMessage());
			return json_encode(false, JSON_NUMERIC_CHECK);			
		}

	}

	public 	function list_marker()
	{
        $data = DB::select('select * from mapping_map_harbour_master a INNER JOIN harbour_master b ON a.id_harbour_master = b.id');
        if(!empty( $data)){
            $result = $data;
            return  json_encode( $result, JSON_NUMERIC_CHECK);
        }
        return json_encode(null, JSON_NUMERIC_CHECK );
	}


}