<?php
    $app->group('/api', function(){

        $this->get('/auth','\App\Controllers\AuthController:Auth');

        $this->get('', '\App\Controllers\PessoaController:get');
        $this->post('', '\App\Controllers\PessoaController:create');

        $this->get('/{cod:[0-9]+}', '\App\Controllers\PessoaController:getId');
        $this->put('/{cod:[0-9]+}', '\App\Controllers\PessoaController:update');
        $this->delete('/{cod:[0-9]+}', '\App\Controllers\PessoaController:delete');
    });
