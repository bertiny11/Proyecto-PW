<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RolFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $rolUsuario = session()->get('rol');

        if (! $rolUsuario) {
            return redirect()->to('/login');
        }

        if ($arguments && ! in_array($rolUsuario, $arguments, true)) {
            return redirect()->to('/');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}