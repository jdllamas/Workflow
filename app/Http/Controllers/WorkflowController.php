<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Validator;
use View;
use Session;

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
						order by bandejadoc0_.id"));
		
		//return $procesos;
		return View::make('workflow.proceso')->with('procesos', $procesos);
    }
	
	public function estadistica()
    {
        //
		if(!Session::has('username')){
			return redirect()->intended('/login');
		}
		return View::make('workflow.estadistica');
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
		return View::make('workflow.create');
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
		//return Input::all();
		/*
		
		insert into mocp0047 (archivo, campo0, campo1, campo2, campo3, campo4, campo5, campo6, campo7, campo8, campo9, campo10, campo11, seleccionado, archivado, fecha, tip_car, num_rev, pre_doc, con_doc, fec_rev, por_tmp, cod_est, archivador, usuario, id_wf2, id) 
		values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
		
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
		
		$seq_num = DB::table(DB::raw("nextval('documento_seq')"))->value('nextval');
		$sig_seq = (int)str_replace(' ', '', $seq_num);
		//return $sig_seq;
		DB::insert("insert into mocp0047 (id, cod_est, campo0,campo1,campo2,campo3, usuario, archivador)
					values (" . $sig_seq . ",'2','" . Input::get('identificacion') . "','" . Input::get('nombres') . "','" . Input::get('tipo_servicio')  . "','" . Input::get('id_servicio') . "','" .Session::get('username')."','102')");
		
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
			
			DB::insert("insert into mocp0048 (codigo, consecutivo, archivo, usuario) 
					values (". $sig_seq .",'001','". $file->getClientOriginalName() ."','". Session::get('username'). "')"); 
			
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
		-- *******************************************************************************************--
		*/
		$seq_num_2 = DB::table(DB::raw("nextval('log_accion_seq')"))->value('nextval');
		$sig_seq_2 = (int)str_replace(' ', '', $seq_num_2);
		DB::insert("insert into mocp0023 (cod_log, cod_acc, id_doc_bndj, username)
		values (". $sig_seq_2 .", 197, ". $sig_seq .",'".Session::get('username')."')"); 
		
		$seq_num_2 = DB::table(DB::raw("nextval('log_accion_seq')"))->value('nextval');
		$sig_seq_2 = (int)str_replace(' ', '', $seq_num_2);
		DB::insert("insert into mocp0023 (cod_log, cod_acc, id_doc_bndj, username)
		values (". $sig_seq_2 .", 198, ". $sig_seq .", 'USUARIO2')"); 
		
		return redirect()->intended('/workflow');

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
		//
		$seq_num = DB::table(DB::raw("select * from mocp0047 where "))->get();
		if(!Session::has('username')){
			return redirect()->intended('/login');
		}
		return View::make('workflow.create');
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
}
