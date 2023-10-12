<?php


//http://localhost/api/usuarios/api/ubicaciones/usuarios *******UBICACION DE LA API*******

//***************************RUTAS DETALLADAS*********************************
//api-> Nombre del proyecto dentro de htdocs.
//usuarios -> Nombre de la carpeta del controlador.
//api-> Nombre del archivo api.php.
//ubicaciones -> Nombre de los metodos post put delete.
//usuarios-> Nombre de la tabla donde se guardaran los datos.

defined('BASEPATH') OR exit('No direct script access allowed');

use RestServer\RestController;
require APPPATH . '/libraries/RestController.php';
require APPPATH . '/libraries/Format.php';

error_reporting(0);
class Api extends RestController {


    function __construct(){

        parent:: __construct();
        $this->load->model('DAO');


        
    }




    function nombre_post(){

            $data = array(

                "nombre" => $this->post('nombre'),
                "direccion" => $this->post('direccion')

            );


            $respuesta = $this->DAO->insertar_modificar_entidad('usuarios',$data);

            if ($respuesta['status'] == '1') {

            $response = array(
                "status" => 1,
                "message" => "info guardada correctamente1",
                "data" => array(),
                "errors" => array()
            );
            

          }else{

            $response = array(
                "status" => 0,
                "message" => "error al guardar",
                "data" => array(),
                "errors" => array(
                    "error" => $response['mensaje']
                )
            );

            }

            $this->response($response,200);

    }


    function nombre_get(){

        $status_validos = array('pendiente','entregado');


        if ($this->get('pStatus') && in_array($this->get('pStatus'), $status_validos)) {

            $filtro = array(
                "status" => $this->get('pStatus')
            );

            $categorias = $this->DAO->seleccionar_entidad('usuarios',$filtro);
           
        }else{
           $categorias = $this->DAO->seleccionar_entidad('usuarios');
        }

        $response = array(
            "status" => 1,
            "message" => "info cargada correctamente1",
            "data" => $categorias,
            "errors" => array()
        );

        $this->response($response,200);

    }


    function nombre_put(){

        if ($this->get('pId')) {

            $filtro = array(
              "id" => $this->get('pId')  
            );

            $tarea_existente = $this->DAO->seleccionar_entidad('usuarios',$filtro,true);

            if ($tarea_existente) {


                $data = array(
                    "nombre" => $this->put('nombre'),
                    "direccion" => $this->put('direccion') 
                );

                $respuesta = $this->DAO->insertar_modificar_entidad('usuarios',$data, $filtro);

                if ($respuesta['status'] == '1') {

                    $response = array(
                        "status" => 1,
                        "message" => "info actualizada correctamente1",
                        "data" => array(),
                        "errors" => array()
                    );
                  
                } else {

                    $response = array(
                        "status" => 0,
                        "message" => "error al actualizar",
                        "data" => array(),
                        "errors" => array(
                            "error" => $response['mensaje']
                        )
                    );
                  
                }
                
               
            } else {

                $response = array(
                    "status" => 0,
                    "message" => "identificador no encontrado",
                    "data" => array(),
                    "errors" => array(
                        "pId" => "el identificador no existe"
                        )
                );
            }
            
         
        } else {

            $response = array(
                "status" => 0,
                "message" => "identificador no encontrado",
                "data" => array(),
                "errors" => array(
                    "pId" => "parametro requerido"
                )
            );
        }

        $this->response($response,200);
        
    }

    function nombre_delete(){
        
        if ($this->get('pId')) {

            $filtro = array(
              "id" => $this->get('pId')  
            );

            $tarea_existente = $this->DAO->seleccionar_entidad('usuarios',$filtro,true);

            if ($tarea_existente) {


            

                $respuesta = $this->DAO->eliminar_entidad('usuarios',$filtro);

                if ($respuesta == true) {

                    $response = array(
                        "status" => 1,
                        "message" => "info actualizada correctamente1",
                        "data" => array(),
                        "errors" => array()
                    );
                  
                } else {

                    $response = array(
                        "status" => 0,
                        "message" => "error al actualizar",
                        "data" => array(),
                        "errors" => array(
                            "error" => $response['mensaje']
                        )
                    );
                  
                }
                
               
            } else {

                $response = array(
                    "status" => 0,
                    "message" => "identificador no encontrado",
                    "data" => array(),
                    "errors" => array(
                        "pId" => "el identificador no existe"
                        )
                );
            }
            
         
        } else {

            $response = array(
                "status" => 0,
                "message" => "identificador no encontrado",
                "data" => array(),
                "errors" => array(
                    "pId" => "parametro requerido"
                )
            );
        }

        $this->response($response,200);
        
    }



}