<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Route extends CI_Controller{

    public function index($domaine = 'Home', $page = 'home'){

        //load session library
        $this->load->library('session');

        //$Rooter =  new Roote();
        $checkLogin = $this->checkLogin("token");
        $checkLicence = $this->checkLicence("token", $domaine);

        //Check if the user are loged
        if($checkLogin){

            //if the domaine exist and page
            if(file_exists(APPPATH.'controllers/'.ucfirst($domaine).'.php')){

                if($checkLicence){

                    //Show the page in the domaines
                    $this->showPage($domaine);

                }else{

                    //Show default page for domaine = default
                    $this->showPage('home');

                }

            }else{

                //Show error page 404
                show_404();

            }

        }else{


            //Check for the page $pageAuthor = [login.php, register.php, password.php...]
            //Show page on $pageAuthor

        }

    }

    public function showPage($domaine){

        //define default var for title and other
        $data['title'] = ucfirst($domaine);

        $this->load->helper('url');
        redirect('https://new.tb-it.fr/index.php/'.ucfirst($domaine).'/Home');

    }

    public function checkLogin($token){

        //check if the token exist

        return true;

    }

    public function checkLicence($token, $licence){

        //check if the user has the rights

        return false;

    }

}

?>
