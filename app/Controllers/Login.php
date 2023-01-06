<?php

namespace App\Controllers;

use App\Models\SerwisantModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;


class Login extends BaseController
{
    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);
    }

    public function index()
    {
        $request = \Config\Services::request();
        $session = session();
        if($session->get('loggedUserId') != 0) return $this->response->redirect(site_url('Home'));
        if($request->getPost("login"))//rozpoczęto proces logowania
        {
            $sM = new SerwisantModel();
            $login = $request->getPost("login");
            $password = $request->getPost("password");
            $user = $sM->where('mail',$login)->find();
            if(empty($user))
                $session->setFlashdata('err', '1');
            else
            {
                $user = $user[0];
                if(password_verify($password, $user['haslo']))
                {
                    $session->set('loggedUserId', $user['id']);
                    return $this->response->redirect(site_url('Home'));
                }
                else $session->setFlashdata('err', 1);
            }
            return view('logowanie.php', $user);
        }
        else return view('logowanie.php');
    }

    public function userExist($email)
    {
        $user = $sM->where('mail',$login)->findAll();
        return $user;
    }

    public function getLoggedUserId()
    {
        $session = session();
        return $session->get('loggedUserId');
    }

    public function End()
    {
        $session = session();
        $session->set('loggedUserId', 0);
        $session->stop();
        $session->destroy();
        return $this->response->redirect(site_url('Login'));
    }
}
