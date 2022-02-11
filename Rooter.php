<?php

class Rooter extends CI_Controller{

    public function index($page = 'default'){

        //load session library
        //$this->load->library('session');

        //init instance and load different function for security
        $Rooter =  new Rooter();
        $newUrl = $Rooter->cutUrl($page);
        $checkLogin = $Rooter->checkLogin("token");
        $checkLicence = $Rooter->checkLicence("token", $newUrl['licence']);

        //Check if the user are loged
        if($checkLogin){

            //check if the page request exist and if the user have a licence for
            if(file_exists(APPPATH.'controllers/licence/'.$newUrl['licence'].'/'.ucfirst($newUrl['page']).'.php') AND $checkLicence){

                //define default var for title and other
                $data['title'] = ucfirst($newUrl['licence']).' | '.ucfirst($newUrl['page']);
                
                $newPage = $newUrl['page'];

                //show page if exist
                require_once (dirname(__FILE__) . '/licence/'.$newUrl['licence'].'/'.ucfirst($newUrl['page']).'.php');
                $newPage =  new $newPage();
                $newPage->index($data);

            }else{

                //define default var for title and other
                $data['title'] = 'Default | Home';

                //show default page because the arguments doesn't exist
                require_once (dirname(__FILE__) . '/licence/default/Home.php');
                $newPage =  new Home();
                $newPage->index($data);

            }

        }else{

            //define default var for title and other
            $data['title'] = 'Entreprise | Login';

            //return on Login page
            $this->load->view('pages/login', $data);

        }

    }


    /*
        Function for cut the URL.
        Format URL are [HTTPS]://[DOMAIN].fr/index.php/[licenceName].[page]
        This function cut the [licenceName] and the [page].
        $data = Array()
        $data[0] = [licenceName]
        $data[1] = [page]
    */
    public function cutUrl($page){

        $newPage = explode('.', $page);

        if(isset($newPage[1]) AND !empty($newPage[1])){

            $data['licence'] = $newPage[0];
            $data['page'] = $newPage[1];

        }else{

            if(isset($newPage[0]) AND !empty($newPage[0])){

                $data['licence'] = $newPage[0];

            }else{

                $data['licence'] = 'default';

            }

                $data['page'] = 'home';

        }

        return $data;

    }

    public function checkLogin($token){

        //check if the token exist

        return true;

    }

    public function checkLicence($token, $licence){

        //check if the token exist

        return true;

    }

}

?>
