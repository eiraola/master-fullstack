<?php

namespace App\Http\Controllers;

 use\App\User;
use Illuminate\Http\Request;

class UserController extends Controller {

    public function pruebas(Request $request) {
        return "Accion de pruebas de USERCONTROLLER";
    }

    public function register(Request $request) {

        $name = $request->input('name');
        $surname = $request->input('surname');

        //Recoger datos del usuario
        $json = $request->input('json', null);
        var_dump($json);

        $params = json_decode($json); //objeto
        $params_array = json_decode($json, true);
        var_dump($params_array['name']);

        if (!empty($params_array)) {
            //clean data
            $params_array = array_map('trim', $params_array);

            //validate

            $validate = \Validator::make($params_array, ['name' => 'required|alpha',
                        'surname' => 'required|alpha',
                        'email' => 'required|email|unique:users',
                        'password' => 'required']);

            if ($validate->fails()) {
                return response()->json($validate->errors(), 400);
                $data = array(
                    'status' => 'Success',
                    'code' => 400,
                    'message' => 'El usuario se ha creado correctamente',
                    'errors' => $validate->errors()
                );
            } else {

                //Cofrar la contraseña
                $pwd = password_hash($params->password, PASSWORD_BCRYPT, ['cost' => 4]);
                $pwd = hash('sha256', $params->password);



                //Comprobar si el usuario esta duplicado
                //Crear el usuario

                $user = new User();
                $user->name = $params_array['name'];
                $user->surname = $params_array['surname'];
                $user->email = $params_array['email'];
                $user->password = $pwd;
                $user->role = 'Usuario';


                //Guardar el usuario

                $user->save();


                $data = array(
                    'status' => 'Success',
                    'code' => 200,
                    'message' => 'El usuario se ha creado correctamente'
                );
            }
        } else {
            $data = array(
                'status' => 'Success',
                'code' => 400,
                'message' => 'Los datos enviados no son correctos');
        }
        return response()->json($data, $data['code']);
        die();
    }

    public function login(Request $request) {
        $jwtAuth = new \JwtAuth();

        //Recibir datos por Post

        $json = $request->input('json', null);
        $email = 'YoMeLoGuiso@palomo.com';
       
        $params = json_decode($json);
        $params_array = json_decode($json, true);

        //Validar datos

        $validate = \Validator::make($params_array, [
                    'email' => 'required|email',
                    'password' => 'required']);

        if ($validate->fails()) {
            return response()->json($validate->errors(), 400);
            $data = array(
                'status' => 'error',
                'code' => 400,
                'message' => 'El usuario sno se ha podido lograr',
                'errors' => $validate->errors()
            );
        } else{
            
            //Cifrar password
             $pwd = hash('sha256', $params->password);
             
             //devolver token o datos
             $signup = $jwtAuth->signup($params->email, $pwd);
             if(!empty($params->gettoken)){
                 $signup=$jwtAuth->signup($params->email, $pwd, true);
             }
            
        }
        return $jwtAuth->signup($email, $pwd);
    }

}
