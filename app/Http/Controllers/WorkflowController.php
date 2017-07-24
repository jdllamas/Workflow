<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Validator;
use View;
use Session;
use Storage;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;

class WorkflowController extends Controller
{
    //
	
	public function __construct(){
		
	}
	
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		if(!Session::has('username')){
			return redirect()->intended('/login');
		}
		return View::make('workflow.index');
    }

	public function proceso()
    {
        //
		if(!Session::has('username')){
			return redirect()->intended('/login');
		}
		$archivador = DB::select(DB::raw("
			select 	archivador0_.codigo as codigo11_0_,
					archivador0_.descripcion as descripc2_11_0_,
					archivador0_.se_muestra as se3_11_0_,
					archivador0_.fecha as fecha11_0_,
					archivador0_.ruta as ruta11_0_,
					archivador0_.cerrado as cerrado11_0_,
					archivador0_.esc_grp as esc7_11_0_, 
					archivador0_.num_pgxd as num8_11_0_,
					archivador0_.mnj_sbc as mnj9_11_0_,
					archivador0_.mnj_wfl as mnj10_11_0_,
					archivador0_.mnj_cnt as mnj11_11_0_,
					archivador0_.rut_ser as rut12_11_0_,
					archivador0_.rut_src as rut13_11_0_,
					archivador0_.ord_dsc as ord14_11_0_,
					archivador0_.sbc_vrt as sbc15_11_0_,
					archivador0_.dsc_sbc_vrt as dsc16_11_0_,
					archivador0_.mnj_tdc as mnj17_11_0_,
					archivador0_.sub_dir as sub18_11_0_,
					archivador0_.nom_pre as nom19_11_0_,
					archivador0_.cod_emp as cod20_11_0_ 
					from mocp0001 archivador0_ where archivador0_.codigo='102'"));
		
		$campos = DB::select(DB::raw("select 
					campo0_.codigo as codigo1_,
					campo0_.consecutivo as consecut2_1_,
					campo0_.codigo as codigo12_0_,
					campo0_.consecutivo as consecut2_12_0_, 
					campo0_.descripcion as descripc3_12_0_,
					campo0_.tipo as tipo12_0_, 
					campo0_.obligatorio as obligato5_12_0_,
					campo0_.limite as limite12_0_,
					campo0_.ocr as ocr12_0_,
					campo0_.x as x12_0_,
					campo0_.y as y12_0_, 
					campo0_.w as w12_0_,
					campo0_.h as h12_0_,
					campo0_.cod_bar as cod12_12_0_,
					campo0_.cmp_pk as cmp13_12_0_,
					campo0_.ncs_ayd as ncs14_12_0_, 
					campo0_.inc_val as inc15_12_0_, 
					campo0_.val_inc as val16_12_0_,
					campo0_.val_dfl as val17_12_0_--,
					--campo0_.cod_nvl as cod18_12_0_ 
					from mocp0002 campo0_ where campo0_.codigo='102'"));
		//return $archivador;
		
		$query ="
		select 	bandejadoc0_.id as id19_,
				bandejadoc0_.archivo as archivo19_,
				bandejadoc0_.campo0 as campo3_19_,
				bandejadoc0_.campo1 as campo4_19_,
				bandejadoc0_.campo2 as campo5_19_,
				bandejadoc0_.campo3 as campo6_19_, 
				bandejadoc0_.campo4 as campo7_19_, 
				bandejadoc0_.campo5 as campo8_19_, 
				bandejadoc0_.campo6 as campo9_19_, 
				bandejadoc0_.campo7 as campo10_19_,
				bandejadoc0_.campo8 as campo11_19_, 
				bandejadoc0_.campo9 as campo12_19_,
				bandejadoc0_.campo10 as campo13_19_,
				bandejadoc0_.campo11 as campo14_19_,
				bandejadoc0_.seleccionado as selecci15_19_,
				bandejadoc0_.archivado as archivado19_,
				bandejadoc0_.fecha as fecha19_,
				bandejadoc0_.tip_car as tip18_19_,
				bandejadoc0_.num_rev as num19_19_,
				bandejadoc0_.pre_doc as pre20_19_,
				bandejadoc0_.con_doc as con21_19_,
				bandejadoc0_.fec_rev as fec22_19_,
				bandejadoc0_.por_tmp as por23_19_,
				--bandejadoc0_.cod_nvl as cod24_19_,
				bandejadoc0_.cod_est as cod25_19_,
				bandejadoc0_.archivador as archivador19_,
				bandejadoc0_.usuario as usuario19_--,
				--bandejadoc0_.id_wf2 as id28_19_ 
				from	mocp0047 bandejadoc0_, 
						mocp0023 logaccion1_ 
				where	bandejadoc0_.id = logaccion1_.id_doc_bndj
				and		logaccion1_.username= '" . Session::get('username') . "'
				and		bandejadoc0_.archivador='102' 
				and		bandejadoc0_.cod_est < 3
				and   (	(bandejadoc0_.id , logaccion1_.cod_log) in
						(select logaccion2_.id_doc_bndj, max(logaccion2_.cod_log)
						from	mocp0023 logaccion2_,
								mocp0047 bandejadoc3_ 
						where logaccion2_.id_doc_bndj=bandejadoc3_.id 
						group by logaccion2_.id_doc_bndj)) 
						order by bandejadoc0_.id";
		//return $query;
		$procesos = DB::select(DB::raw($query));
		//return $procesos;
		$puede_agendar = $this->puede_ejecutar(99);
		return View::make('workflow.proceso')
		->with('procesos', $procesos)
		->with('puede_agendar', $puede_agendar);
    }
	
	public function estadistica()
    {
        //
		if(!Session::has('username')){
			return redirect()->intended('/login');
		}
		
		$procesos_por_usuario = DB::select("
			select count(logaccion1_.username) as count_username,
			logaccion1_.username as usuario19_actual
			from	mocp0047 bandejadoc0_, 
					mocp0023 logaccion1_ 
			where	bandejadoc0_.id = logaccion1_.id_doc_bndj
			and		bandejadoc0_.archivador='102' 
			and		bandejadoc0_.cod_est < 3
			and   (	(bandejadoc0_.id , logaccion1_.cod_log) in
					(select logaccion2_.id_doc_bndj, max(logaccion2_.cod_log)
					from	mocp0023 logaccion2_,
							mocp0047 bandejadoc3_ 
					where logaccion2_.id_doc_bndj=bandejadoc3_.id 
					group by logaccion2_.id_doc_bndj)) 
					group by logaccion1_.username
					order by logaccion1_.username
		");
		$usuarios = array();
		$count_proc = array();
		foreach($procesos_por_usuario as $proceso_por_usuario){
			array_push($usuarios, $proceso_por_usuario->usuario19_actual);
			array_push($count_proc, $proceso_por_usuario->count_username);
		}
		
		return View::make('workflow.estadistica')
		->with('usuarios',json_encode($usuarios))
		->with('count_proc',json_encode($count_proc,JSON_NUMERIC_CHECK));
    }
	
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		if(!Session::has('username')){
			return redirect()->intended('/login');
		}
		$campos = $this->get_campos(102);
		$acciones_disponibles = $this->get_acciones(true,99);
		/*
		DB::select("SELECT
		a.cod_acc, c.username, d.des_act, d.des_act||' / ' || e.nombre as usr_act
		FROM mocp0022 a, mocp0027 c, mocp0026 d, users e
		WHERE a.cod_act = d.cod_act
		AND a.cod_act = c.cod_act 
		AND a.cod_act_anterior = 99
		AND c.username = e.username
		AND a.apr_acc = true
		AND a.rec_acc = false
		ORDER BY a.cod_acc, c.username");
		*/
		//return $campos;
		return View::make('workflow.create')
		->with('acciones_disponibles',$acciones_disponibles)
		->with('campos',$campos);
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
		if(!Session::has('username')){
			return redirect()->intended('/login');
		}
		/*
		return Input::all();
		$rules= array(
				'identificacion'=> 'required',
				'nombres'=> 'required',
				'id_servicio'=> 'required',
				'tipo_servicio'=> 'required',
	        );
		
		$validate = Validator::make(Input::all(), $rules);
		if ($validate->fails()) {

		   return redirect()->back()->withErrors($validate)->withInput();
		}
		*/
		/*
		
		-- *******************************************************************************************--
		-- Crear un proceso o workflow.
		-- id: El campo 1235, es un numero que se toma de la secuencia - documento_seq
		se obtiene asi desde postgres: select nextval('documento_seq');
		-- campo0 hasta campo4 es la información que identifica el proceso.
		-- usuario SUPERVISOR o USUARIO1, es el usuario que crea el proceso.
		-- archivador: en este caso 92  para tu caso siempre sera el "102" 
		-- *******************************************************************************************--
		
		*/
		//campo0 id
		//campo1 nombre
		//campo2 tipo servicio
		//campo3 numero solicitud
		
		//cod_est -> Estado del requerimiento
		//1. Inicio
		//2. En proceso
		//3. Finalizado
		
		$existen = true;
		while($existen){
			$seq_num = DB::table(DB::raw("nextval('documento_seq')"))->value('nextval');
			$sig_seq = (int)str_replace(' ', '', $seq_num);
			$registros = DB::table(DB::raw("mocp0047 where id = " . $sig_seq))->value('id');
			$existen = (empty($registros) ? false : true);
		}
		//return $sig_seq;
		
		$campos = $this->get_campos(102);
		$campos_string = "";
		$campos_data = "";
		$i = 0;
		foreach($campos as $campo){
			$campos_string .= ", campo" . $i; 
			$campos_data .= ",'" . Input::get('campo'.$i)."'";
			$i +=1;
		}
		//return $campos_data;
		DB::insert("insert into mocp0047 (id, cod_est" . $campos_string .", usuario, archivador, fec_rev, num_rev)
					values (" . $sig_seq . ",'2'". $campos_data .",'" .Session::get('username')."','102',timestamp '" . Input::get('fecha_servicio')  . "','" . Input::get('hora_servicio') ."')");
		
		/*
		-- *******************************************************************************************--
		-- Insertar un documento asociado al proceso.
		-- codigo: 1235, la llave foranea a la mocp0047
		-- consecutivo: es caracter, 001, 002, 003.
		-- archivo: nombre del archivo 
		-- usuario: usuario logueado que sube/carga el archivo 
		-- *******************************************************************************************--
		*/
		$file = $request->file('archivo');
		if($request->hasFile('archivo'))
		{
			//$procesos = DB::select(DB::raw("SELECT consecutivo from mocp0048 where codigo = " . $sig_seq);
			
			DB::insert("insert into mocp0048 (codigo, consecutivo, archivo, arc_org, usuario) 
					values (". $sig_seq .",'001','". $file->getClientOriginalName() ."','". $file->getClientOriginalName() ."','".Session::get('username'). "')"); 
			
			$file->storeAs('seguros/' , $file->getClientOriginalName());
		}
		
		/*
		-- *******************************************************************************************--
		-- Insertar un registro en el historico o log del proceso
		-- El primer campo 7778 es un consecutivo que viene de la secuencia "log_accion_seq"
		-- se obtiene desde postgres asi: select nextval('log_accion_seq');
		-- cod_acc=123, este es uno de las "acciones" o codigos de inicio de mi workflow que tengo, 
		esos codigos te los tendras aprender de memoria, de acuerdo con la parametrizacion de tu worflow
		-- id_doc_bndj = 1235, es la llave foranea que relaciona a que proceso (mocp0047) pertenece.
		
		-- ** Workflow 25: Seguros ** --
		
		-- Actividad 99: Registro de Clientes
		-- Actividad 100: Asignacion de Servicio
		-- Actividad 101: Recoleccion de Firmas
		-- Actividad 102: Revision de Firmas
		-- Actividad 103: Archivo Final
		
		Accion 197;"REGISTRO";"APROBACION"
		Accion 202;"REGISTRO";"RECHAZO"
		Accion 198;"ASIGNACION";"APROBACION"
		Accion 203;"ASIGNACION";"RECHAZO"
		Accion 199;"RECOLECCION";"APROBACION"
		Accion 204;"RECOLECCION";"RECHAZO"
		Accion 200;"REVISION";"APROBACION"
		Accion 205;"REVISION";"RECHAZO"
		Accion 201;"ARCHIVO";"APROBACION"
		Accion 206;"ARCHIVO";"RECHAZO"
		
		SELECT a.cod_acc, c.username, d.des_act||' / ' || e.nombre
		FROM mocp0022 a, mocp0027 c, mocp0026 d, users e
		WHERE a.cod_act = d.cod_act
		AND c.username = d.username
		AND a.apr_acc = true
		AND a.rec_acc = false
		
		-- *******************************************************************************************--
		*/
		list($usuario, $cod_acc) = explode("-",Input::get('usuario_accion'));
		$seq_num_2 = DB::table(DB::raw("nextval('log_accion_seq')"))->value('nextval');
		$sig_seq_2 = (int)str_replace(' ', '', $seq_num_2);
		DB::insert("insert into mocp0023 (cod_log, cod_acc, id_doc_bndj, username, obs_log)
		values (". $sig_seq_2 .",".$cod_acc .",".$sig_seq .",'".$usuario."','". Input::get('observaciones') ."')"); 
		
		return redirect()->intended('/workflow/proceso');

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
		if(!Session::has('username')){
			return redirect()->intended('/login');
		}
		$registros = DB::table(DB::raw("mocp0047 where id = " . $id))->first();
		$logs = DB::table(DB::raw("mocp0023 logs, mocp0022 acc, mocp0026 act where acc.cod_act = act.cod_act and logs.cod_acc = acc.cod_acc and logs.id_doc_bndj = " . $id))->orderBy('cod_log')->get();
		$documentos = DB::table(DB::raw("mocp0048 a left join mocp0032 b on a.cod_tp_doc = b.cod_tp_doc where a.codigo = " . $id))->get();
		$campos = $this->get_campos(102);
		return View::make('workflow.show')
		->with('registros', $registros)
		->with('logs', $logs)
		->with('documentos', $documentos)
		->with('campos', $campos);
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
		if(!Session::has('username')){
			return redirect()->intended('/login');
		}
		$registro = DB::table(DB::raw("mocp0047 where id = " . $id))->first();
		$logs = DB::table(DB::raw("mocp0023 logs, mocp0022 acc, mocp0026 act where acc.cod_act = act.cod_act and logs.cod_acc = acc.cod_acc and logs.id_doc_bndj = " . $id))->get();
		$documentos = DB::table(DB::raw("mocp0048 where codigo = " . $id))->get();
		$campos = $this->get_campos(102);
		$ultimolog = DB::table(DB::raw("mocp0023 logs, mocp0022 acc, mocp0026 act where acc.cod_act = act.cod_act and logs.cod_acc = acc.cod_acc and logs.id_doc_bndj = " . $id. " order by cod_log desc"))->first();
		$acciones_disponibles = DB::select("
			SELECT
			a.cod_acc, c.username, d.des_act,
			case
				when (a.apr_acc = false and a.rec_acc = true) then 'RECHAZADO / ' || d.des_act||' / ' || e.nombre
				when (a.apr_acc = true and a.rec_acc = false) then 'APROBADO / ' || d.des_act||' / ' || e.nombre 
			end as usr_act
			FROM mocp0022 a, mocp0027 c, mocp0026 d, users e
			WHERE a.cod_act = d.cod_act
			AND a.cod_act = c.cod_act 
			AND a.cod_act_anterior = ". $ultimolog->cod_act ."
			AND c.username = e.username
			ORDER BY a.cod_acc, c.username");
	/*
		$acciones_disponibles = DB::select("SELECT
		a.cod_acc, c.username, d.des_act, d.des_act||' / ' || e.nombre as usr_act
		FROM mocp0022 a, mocp0027 c, mocp0026 d, users e
		WHERE a.cod_act = d.cod_act
		AND a.cod_act = c.cod_act 
		AND a.cod_act_anterior = ". $ultimolog->cod_act ."
		AND c.username = e.username
		AND a.apr_acc = true
		AND a.rec_acc = false
		ORDER BY a.cod_acc, c.username");
	*/
		
		return View::make('workflow.edit')
		->with('registro', $registro)
		->with('logs', $logs)
		->with('documentos', $documentos)
		->with('acciones_disponibles',$acciones_disponibles)
		->with('campos', $campos);
		//return array($registro,$log,$documentos);
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
		if(!Session::has('username')){
			return redirect()->intended('/login');
		}
		
		$existen = true;
		while($existen){
			$seq_num_2 = DB::table(DB::raw("nextval('log_accion_seq')"))->value('nextval');
			$sig_seq_2 = (int)str_replace(' ', '', $seq_num_2);
			$registros = DB::table(DB::raw("mocp0023 where cod_log = " . $sig_seq_2))->value('cod_log');
			$existen = (empty($registros) ? false : true);
		}
		list($usuario, $cod_acc) = explode("-",Input::get('usuario_accion'));
		$cod = (int)str_replace(' ', '', $cod_acc);
		if($cod == 0){
			DB::statement("UPDATE mocp0047 SET cod_est = 3 where id = " . $id);
			//return redirect()->intended('/workflow/proceso');
		}
		else{
			$query = (string)"insert into mocp0023 (cod_log, cod_acc, id_doc_bndj, username, obs_log) values (". $sig_seq_2 .",".$cod .",".$id.",'".$usuario."','". Input::get('observaciones') ."')";
			try{
				DB::statement($query);
			}
			catch(Exception $ex){
				return "Insert No Ok";
			}
		}
		
		
		$file = $request->file('archivo');
		if($request->hasFile('archivo'))
		{
			//$procesos = DB::select(DB::raw("SELECT consecutivo from mocp0048 where codigo = " . $sig_seq);
			//return $sig_seq;
			//DB::insert("insert into mocp0047 (id, cod_est, campo0,campo1,campo2,campo3, usuario, archivador)
			//		values (" . $sig_seq . ",'2','" . Input::get('identificacion') . "','" . Input::get('nombres') . "','" . Input::get('tipo_servicio')  . "','" . Input::get('id_servicio') . "','" .Session::get('username')."','102')");
					
			$ultimo_documento = DB::select("
			select codigo, max(cast(consecutivo as integer)) as consecutivo
			from mocp0048
			where codigo =". $id ."
			group by codigo
			order by codigo");
			
			if(count(collect($ultimo_documento))){
				$ultimo_doc = $ultimo_documento[0];
				$sig_consecutivo = str_pad(($ultimo_doc->consecutivo) + 1, 5, '0', STR_PAD_LEFT);
			}
			else{
				$sig_consecutivo = str_pad(1, 5, '0', STR_PAD_LEFT);
			}
			
			DB::insert("insert into mocp0048 (codigo, consecutivo, archivo, arc_org, usuario) 
					values (". $id .",'".$sig_consecutivo."','". $file->getClientOriginalName() ."','". $file->getClientOriginalName() ."','".Session::get('username'). "')"); 
			
			$file->storeAs('seguros/' , $file->getClientOriginalName());
		}
		
		return redirect()->intended('/workflow/proceso');
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
	public function consulta(){
		
		$procesos = DB::select(DB::raw("
		select 	bandejadoc0_.id as id19_,
				bandejadoc0_.archivo as archivo19_,
				bandejadoc0_.campo0 as campo3_19_,
				bandejadoc0_.campo1 as campo4_19_,
				bandejadoc0_.campo2 as campo5_19_,
				bandejadoc0_.campo3 as campo6_19_, 
				bandejadoc0_.campo4 as campo7_19_, 
				bandejadoc0_.campo5 as campo8_19_, 
				bandejadoc0_.campo6 as campo9_19_, 
				bandejadoc0_.campo7 as campo10_19_,
				bandejadoc0_.campo8 as campo11_19_, 
				bandejadoc0_.campo9 as campo12_19_,
				bandejadoc0_.campo10 as campo13_19_,
				bandejadoc0_.campo11 as campo14_19_,
				bandejadoc0_.campo12 as campo15_19_,
				bandejadoc0_.campo13 as campo16_19_,
				bandejadoc0_.campo14 as campo17_19_,
				bandejadoc0_.campo15 as campo18_19_,
				bandejadoc0_.campo16 as campo19_19_,
				bandejadoc0_.campo17 as campo20_19_,
				bandejadoc0_.campo18 as campo21_19_,
				bandejadoc0_.campo19 as campo22_19_,
				bandejadoc0_.seleccionado as selecci15_19_,
				bandejadoc0_.archivado as archivado19_,
				bandejadoc0_.fecha as fecha19_,
				bandejadoc0_.tip_car as tip18_19_,
				bandejadoc0_.num_rev as num19_19_,
				bandejadoc0_.pre_doc as pre20_19_,
				bandejadoc0_.con_doc as con21_19_,
				bandejadoc0_.fec_rev as fec22_19_,
				bandejadoc0_.por_tmp as por23_19_,
				--bandejadoc0_.cod_nvl as cod24_19_,
				bandejadoc0_.cod_est as cod25_19_,
				bandejadoc0_.archivador as archivador19_,
				bandejadoc0_.usuario as usuario19_--,
				--bandejadoc0_.id_wf2 as id28_19_ 
				from	mocp0047 bandejadoc0_, 
						mocp0023 logaccion1_ 
				where	bandejadoc0_.id = logaccion1_.id_doc_bndj
				and		bandejadoc0_.archivador='102' 
				and   (	(bandejadoc0_.id , logaccion1_.cod_log) in
						(select logaccion2_.id_doc_bndj, max(logaccion2_.cod_log)
						from	mocp0023 logaccion2_,
								mocp0047 bandejadoc3_ 
						where logaccion2_.id_doc_bndj=bandejadoc3_.id 
						group by logaccion2_.id_doc_bndj)) 
						order by bandejadoc0_.id"));
		
		//return $procesos;
		return View::make('workflow.consulta')->with('procesos', $procesos);
		
	}
	
	public function disponibilidad(Request $request){
		
		if(!Session::has('username')){
			return redirect()->intended('/login');
		}
		$procesos = $this->get_procesos();
		$acciones_disponibles = $this->get_acciones(true,99);
		
		$puede_importar_agenda = $this->puede_ejecutar(100);
		$puede_agendar = $this->puede_ejecutar(99);
		return View::make('workflow.disponibilidad')
		->with('procesos',$procesos)
		->with('acciones_disponibles',$acciones_disponibles)
		->with('puede_agendar',$puede_agendar)
		->with('puede_importar_agenda',$puede_importar_agenda);
	}
	
	public function create_agenda(Request $request){
		
		if(!Session::has('username')){
			return redirect()->intended('/login');
		}
		$acciones_disponibles = $this->get_acciones(true,100);
		return View::make('workflow.create_agenda')
		->with('acciones_disponibles',$acciones_disponibles);
	}
	
	public function nuevo_turno(Request $request){
		
		
		if(!Session::has('username')){
			return redirect()->intended('/login');
		}
		
		$procesos_count = DB::select(DB::raw("SELECT count(*) from mocp0047 a
			WHERE a.num_rev = ". Input::get('hora_servicio') . " and a.fec_rev::date = '". Input::get('fecha_servicio') . "'"));
		
		$acciones_disponibles = $this->get_acciones(true,99);
		$procesos_count_int = (int)str_replace(' ', '', $procesos_count);
		if($procesos_count_int > 8){
			$procesos = $this->get_procesos();
			return redirect()->intended('/workflow/disponibilidad')
			->with('message','Ha alcanzado el limite de agendamientos para este rango.')
			->with('procesos',$procesos)
			->with('acciones_disponibles',$acciones_disponibles);
		}
		
		$existen = true;
		while($existen){
			$seq_num = DB::table(DB::raw("nextval('documento_seq')"))->value('nextval');
			$sig_seq = (int)str_replace(' ', '', $seq_num);
			$registros = DB::table(DB::raw("mocp0047 where id = " . $sig_seq))->value('id');
			$existen = (empty($registros) ? false : true);
		}
		
		DB::insert("insert into mocp0047 (id, cod_est, fec_rev, num_rev, usuario, archivador)
				values (" . $sig_seq . ",'2',timestamp '" . Input::get('fecha_servicio')  . "','" . Input::get('hora_servicio') . "','" .Session::get('username')."','102')");
		
		list($usuario, $cod_acc) = explode("-",Input::get('usuario_accion'));
		$seq_num_2 = DB::table(DB::raw("nextval('log_accion_seq')"))->value('nextval');
		$sig_seq_2 = (int)str_replace(' ', '', $seq_num_2);
		DB::insert("insert into mocp0023 (cod_log, cod_acc, id_doc_bndj, username, obs_log)
		values (". $sig_seq_2 .",".$cod_acc .",".$sig_seq .",'".$usuario."','". Input::get('observaciones') ."')");
		
		$procesos = $this->get_procesos();
		$codigo_asignacion = str_pad($sig_seq, 4, '0', STR_PAD_LEFT);
		return redirect()->intended('/workflow/disponibilidad')
		->with('message','Codigo de asignacion: ' . $codigo_asignacion . '. Recuerde que este código debe ser insertado en el turno de agendamiento del archivo de backoffice.')
		->with('procesos',$procesos)
		->with('acciones_disponibles',$acciones_disponibles);
		
	}
	
	public function create_cargamasiva(Request $request){
		
		if(!Session::has('username')){
			return redirect()->intended('/login');
		}
		$acciones_disponibles = $this->get_acciones(true,100);
		return View::make('workflow.create_cargamasiva')
		->with('acciones_disponibles',$acciones_disponibles);
	}
	
	public function import_cargamasiva(Request $request){
		
		if(!Session::has('username')){
			return redirect()->intended('/login');
		}
		$file = $request->file('archivo');
		if($request->hasFile('archivo'))
		{
			$datos = (Excel::load($file, function ($reader) {
            })->get());
			//return $datos;
		}
		
		foreach($datos as $agendamiento){
			if(!is_null($agendamiento->codigo_agendamiento)){
				
				$cod_proc = (int)str_replace(' ', '', $agendamiento->codigo_agendamiento);
				$data = DB::table(DB::raw("mocp0047 where id = " . $cod_proc))->get();
				DB::statement("
				UPDATE mocp0047
				SET 
				campo0 = '". $agendamiento->nombre_del_cliente . "',
				campo1 = '". $agendamiento->rut . "',
				campo2 = '". $agendamiento->telefonos . "',
				campo3 = '". $agendamiento->e_mail . "',
				campo4 = '". $agendamiento->direccion . "',
				campo5 = '". $agendamiento->comuna . "',
				campo6 = '". $agendamiento->fecha_venta . "',
				campo7 = '". $agendamiento->n0_poliza_primer_medio_pago . "',
				campo8 = '". $agendamiento->n0_poliza_segundo_medio_pago . "',
				campo9 = '". $agendamiento->emisor_1 . "',
				campo10 = '". $agendamiento->emisor_2 . "',
				campo11 = '". $agendamiento->cantidad_credenciales_cruz_verde . "',
				campo12 = '". $agendamiento->gestion . "',
				campo13 = '". $agendamiento->polizas_muerte_accidental_hospitalizacion . "'				
				where id = " . $cod_proc);
				
				$existen = true;
				while($existen){
					$seq_num_2 = DB::table(DB::raw("nextval('log_accion_seq')"))->value('nextval');
					$sig_seq_2 = (int)str_replace(' ', '', $seq_num_2);
					$registros = DB::table(DB::raw("mocp0023 where cod_log = " . $sig_seq_2))->value('cod_log');
					$existen = (empty($registros) ? false : true);
				}
				list($usuario, $cod_acc) = explode("-",Input::get('usuario_accion'));
				$cod = $sig_seq = (int)str_replace(' ', '', $cod_acc);
				if($cod == 0){
					DB::statement("UPDATE mocp0047 SET cod_est = 3 where id = " . $id);
				}
				else{
					DB::insert("insert into mocp0023 (cod_log, cod_acc, id_doc_bndj, username, obs_log)
					values (". $sig_seq_2 .",".$cod_acc .",".$cod_proc.",'".$usuario."','". $agendamiento->observacion ."')"); 
				}
			}
		}
		
		$acciones_disponibles = $this->get_acciones(true,99);
		return View::make('workflow.create_cargamasiva')
		->with('acciones_disponibles',$acciones_disponibles);
	}
	
	public function downloadfile($id, $consecutivo)
    {
		if(!Session::has('username')){
			return redirect()->intended('/login');
		}
		
        //
		$documento = DB::select("SELECT archivo
			from	mocp0048
			where	codigo = ". $id ."
			and		consecutivo = '". $consecutivo ."'")[0];
		return response()->download(Storage::disk('kronos')->getDriver()->getAdapter()->getPathPrefix().'seguros/'.$documento->archivo);
		
	}
	
	public function get_acciones($tipo_accion, $act_ant){
		//tipo accion -> aprov / rechazo
		if($tipo_accion){
			//aprov
			$acciones_disponibles = DB::select("SELECT
			a.cod_acc, c.username, d.des_act, d.des_act||' / ' || e.nombre as usr_act
			FROM mocp0022 a, mocp0027 c, mocp0026 d, users e
			WHERE a.cod_act = d.cod_act
			AND a.cod_act = c.cod_act 
			AND a.cod_act_anterior = ".$act_ant."
			AND c.username = e.username
			AND a.apr_acc = true
			AND a.rec_acc = false
			ORDER BY a.cod_acc, c.username");
		}
		else{
			//rechazo
			$acciones_disponibles = DB::select("SELECT
			a.cod_acc, c.username, d.des_act, d.des_act||' / ' || e.nombre as usr_act
			FROM mocp0022 a, mocp0027 c, mocp0026 d, users e
			WHERE a.cod_act = d.cod_act
			AND a.cod_act = c.cod_act 
			AND a.cod_act_anterior = ".$act_ant."
			AND c.username = e.username
			AND a.apr_acc = false
			AND a.rec_acc = true
			ORDER BY a.cod_acc, c.username");
		}
		
		return $acciones_disponibles;
	}
	
	public function get_campos($archivador){
		$campos = DB::select(DB::raw("
		select * from mocp0002
		where codigo = '". $archivador ."'
		order by codigo, consecutivo::int
		"));
						
		return $campos;
	}
	
	public function get_procesos(){
		$procesos = DB::select(DB::raw("
			select 	bandejadoc0_.id as id19_,
				bandejadoc0_.archivo as archivo19_,
				bandejadoc0_.campo0 as campo3_19_,
				bandejadoc0_.campo1 as campo4_19_,
				bandejadoc0_.campo2 as campo5_19_,
				bandejadoc0_.campo3 as campo6_19_, 
				bandejadoc0_.campo4 as campo7_19_, 
				bandejadoc0_.campo5 as campo8_19_, 
				bandejadoc0_.campo6 as campo9_19_, 
				bandejadoc0_.campo7 as campo10_19_,
				bandejadoc0_.campo8 as campo11_19_, 
				bandejadoc0_.campo9 as campo12_19_,
				bandejadoc0_.campo10 as campo13_19_,
				bandejadoc0_.campo11 as campo14_19_,
				--bandejadoc0_.campo12 as campo15_19_,
				--bandejadoc0_.campo13 as campo16_19_,
				--bandejadoc0_.campo14 as campo17_19_,
				--bandejadoc0_.campo15 as campo18_19_,
				--bandejadoc0_.campo16 as campo19_19_,
				--bandejadoc0_.campo17 as campo20_19_,
				--bandejadoc0_.campo18 as campo21_19_,
				--bandejadoc0_.campo19 as campo22_19_,
				bandejadoc0_.seleccionado as selecci15_19_,
				bandejadoc0_.archivado as archivado19_,
				bandejadoc0_.fecha as fecha19_,
				bandejadoc0_.tip_car as tip18_19_,
				bandejadoc0_.pre_doc as pre20_19_,
				bandejadoc0_.con_doc as con21_19_,
				case
					when (bandejadoc0_.num_rev = 1) then (bandejadoc0_.fec_rev::date + '09:00'::time)
					when (bandejadoc0_.num_rev = 2) then (bandejadoc0_.fec_rev::date + '12:00'::time) 
					when (bandejadoc0_.num_rev = 3) then (bandejadoc0_.fec_rev::date + '15:00'::time) 
					else (bandejadoc0_.fec_rev::date + '09:00'::time)
				end as startDate,
				case
					when (bandejadoc0_.num_rev = 1) then (bandejadoc0_.fec_rev::date + '12:00'::time)
					when (bandejadoc0_.num_rev = 2) then (bandejadoc0_.fec_rev::date + '15:00'::time)
					when (bandejadoc0_.num_rev = 3) then (bandejadoc0_.fec_rev::date + '18:00'::time)
					else (bandejadoc0_.fec_rev::date + '12:00'::time)
				end as endDate,
				bandejadoc0_.fec_rev::date as fec22_19_,
				bandejadoc0_.num_rev as fec23_19_,
				bandejadoc0_.por_tmp as por23_19_,
				--bandejadoc0_.cod_nvl as cod24_19_,
				bandejadoc0_.cod_est as cod25_19_,
				bandejadoc0_.archivador as archivador19_,
				bandejadoc0_.usuario as usuario19_--,
				--bandejadoc0_.id_wf2 as id28_19_ 
				from	mocp0047 bandejadoc0_, 
						mocp0023 logaccion1_ 
				where	bandejadoc0_.id = logaccion1_.id_doc_bndj
				and		bandejadoc0_.archivador='102' 
				and   (	(bandejadoc0_.id , logaccion1_.cod_log) in
						(select logaccion2_.id_doc_bndj, max(logaccion2_.cod_log)
						from	mocp0023 logaccion2_,
								mocp0047 bandejadoc3_ 
						where logaccion2_.id_doc_bndj=bandejadoc3_.id 
						group by logaccion2_.id_doc_bndj)) 
						order by bandejadoc0_.id"));
						
		return $procesos;
	}
	public function puede_ejecutar($cod_accion){
		return DB::select(DB::raw("select * from mocp0027 where cod_act = ". $cod_accion ." and username ='".Session::get('username')."'"));
		
	}
}
