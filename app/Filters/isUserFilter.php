<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class isUserFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Do something here
        $session = session();
         if($session->extracted_user_type !== "admin"){
            return redirect()->to(base_url());
         }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}