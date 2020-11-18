<?php namespace App\Controllers;

use App\Models\modeloUsuarios;

class ControladorPersonas extends BaseController
{
	public function index()
	{
		return view('vistaRegistro');
	}

	public function registrar()
	{
	//1. Recibir datos desde la vista
		$nombre=$this ->request->getPost("nombre");
		$edad=$this ->request->getPost("edad");
		$cedula=$this ->request->getPost("cedula");
		$poblacion=$this ->request->getPost("poblacion");
		$descripcion=$this ->request->getPost("descripcion");

	//2. Organizar los datos de envío a la base de datos (arreglo)


		$datosEnvio=array(
			"nombre"=>$nombre,
			"edad"=>$edad,
			"cedula"=>$cedula,
			"poblacion"=>$poblacion,
			"descripcion"=>$descripcion		
		);

		//print_r ($datosEnvio);
	
	//3.Sacar una copia de la clase (instanciar clase/crear objeto) de la clase modeloUsuario
	
	$modeloUsuarios = new modeloUsuarios();

	//4. Ejecuto el metodo insert () del objeto creado en el punto3

	try {

		$modeloUsuarios->insert($datosEnvio);
		echo ("Registro creado con éxito");
	}
	
	catch (\Exception $e) {
		echo ($e->getMessage());
	}
  }

  public function consultar (){

	  //1.crear un objeto del modelo
	  $modeloUsuarios = new modeloUsuarios();

	  //2.ejecutar la consulta

	  try {
		
		//3.utilizar el metodo findAll(); del objeto del modelo

		$usuariosconsultados = $modeloUsuarios ->findAll();

		//4. organizar le resultado en un arreglo asociativo 
		//Para poderlo enviar a la vista
		$datosParaVista=array ('usuarios'=>$usuariosconsultados);

		//Enviar datos a la vista

		return view('vistalistado', $datosParaVista);


	}
	
	catch (\Exception $e) {
		echo ($e->getMessage());
	}

  }

  public function eliminar ($idEliminar){

	  //1.crear un objeto del modelo
	  $modeloUsuarios = new modeloUsuarios();

	  //2.ejecutar la funsion delete del modelo
	  try {
		
		$modeloUsuarios ->where ('id',$idEliminar) ->delete();
		echo ("se ha eliminado el registro");
	}
	
	catch (\Exception $e) {
		echo ($e->getMessage());
	}

  }

  public function editar ($idEditar){

	//1. Recibir datos desde la vista
	$nombre=$this ->request->getPost("nombreEditar");
	$descripcion=$this ->request->getPost("descEditar");

	$datosEnvio=array(
		"nombre"=>$nombre,
		"descripcion"=>$descripcion		
	);

	$modeloUsuarios = new modeloUsuarios();

	try {

		$modeloUsuarios ->update($idEditar, $datosEnvio);
		echo ("Usuario editado con exito");
		
	}
	
	catch (\Exception $e) {
		echo ($e->getMessage());
	}
  } 
}