<?php
namespace App\Controllers;

use Firebase\JWT\JWT;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
/**
 * Controller de Exemplo
 */
class AuthController {
    /**
     * Container - Ele recebe uma instancia de um
     * container da rota no construtor
     * @var object s
     */
   protected $container;

   /**
    * Método Construtor
    * @param ContainerInterface $container
    */
   public function __construct($container) {
       $this->container = $container;
   }

     /**
     * Método de Exemplo
     *
     * @param [type] $request
     * @param [type] $response
     * @param [type] $args
     * @return void Response
     */
    public function Auth($request, $response, $args) {

    $key = $this->container->get("secretkey");

    $token = array(
        "user" => "@andreoufji",
        "github" => "https://github.com/aofuji"
    );

    $jwt = JWT::encode($token, $key);

    return $response->withJson(["auth-jwt" => $jwt], 200)
        ->withHeader('Content-type', 'application/json');
    }
}
