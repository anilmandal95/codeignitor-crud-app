<?php
namespace App\Controllers;
use App\Models\UserModel;
class UserController extends BaseController
{
    // public function index(): string
    // {
    //     return view('welcome_message');
    // }
// User register start
    public function userRegistration(){
        if ($this->request->getMethod() == "get") {
            return view('register');
        }
        else if($this->request->getMethod() == "post"){
            
            $usermodel = new UserModel;
            // $rules =[
            //     "name" => "required",
            //     "email" => "required|valid_email|is_unique[user.email]",
            //     "password" => "required",
            //     "mobile" => "required",
            // ];
            // if(!$this->validate($rules)){
            //     //data not found block
            //     return view('register',[
            //         "validation" => $this->validator
            //     ]);
            // }else{
            $data = stripslashes(file_get_contents("php://input"));
            $mydata = json_decode($data, true);
            $name = $mydata['name'];
            $email = $mydata['email'];
            $password = $mydata['password'];
            $contact = $mydata['contact'];
            $data = [
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'contact' => $contact,
            ];
            $usermodel->save($data);
            $data = [
                "status_message" => "User inserted successfully",
                "status" => 200,
            ];
            return $this->response->setJSON($data);
        //}

        }
    }
// User register end

// User getListOfUser start
    public function getListOfUser(){
        if ($this->request->getMethod() == "get") {
            # code...
            return view('userData');
        }
        else if($this->request->getMethod() == "post"){
        $models = new userModel();
        $data['users'] = $models->findAll();
        return $this->response->setJSON($data);
        }
    }
// User getListOfUser end

// User delete start
    public function userDelete(){
        $models = new userModel();
        $data = stripslashes(file_get_contents("php://input"));
        $mydata = json_decode($data, true);
        $id = $mydata['sid'];
        $models->delete($id);
        $data = [
            "status_message" => "User deleted successfully",
            "status" => 200,
        ];
        return $this->response->setJSON($data);
    }
// User delete end

    // User edit start
    public function userEdit(){
        $models = new userModel();
        $data = stripslashes(file_get_contents("php://input"));
        $mydata = json_decode($data, true);
        $id = $mydata['sid'];
        $data =  $models->find($id);
        return $this->response->setJSON($data);

    }
 // User edit end
     // User update start
    public function userUpdate(){
        $models = new userModel();
        $data = stripslashes(file_get_contents("php://input"));
        $mydata = json_decode($data, true);
        $name = $mydata['name'];
        $email = $mydata['email'];
        $password = $mydata['password'];
        $contact = $mydata['contact'];

        // $name = $this->request->getPost('name');
        // echo $name;
        // print_r($name);
        $data = [
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'contact' => $contact,
        ];
        $id = $mydata['id'];
        $data =  $models->update($id, $data);
        $message = [
            "status_message" => "User updated successfully",
            "status" => 200,
        ];
        return $this->response->setJSON($message);

    }
    // User update end 
}
