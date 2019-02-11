<?php
namespace App\Controllers;

use App\BD;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
/**
 * Controller de Exemplo
 */
class PessoaController {
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

    public function get($request, $response, $args) {

        $arquivo = file_get_contents('pessoa.json');
        $data = json_decode($arquivo);
        $return = $response->withJson($data, 200)
            ->withHeader('Content-type', 'application/json');
        return $return;
    }

    public function getId($request, $response, $args){
        $codigo =  $args['cod'];
        $arquivo = file_get_contents('pessoa.json');
        $arr = json_decode($arquivo);

        foreach ($arr as $key => $value) {
            if($value->codigo == $codigo){
                $data = $value;
            }
        }

        if(!$data){
            $return = $response->withJson(['message' => $codigo .'Não encontrado'], 404)
                ->withHeader('Content-type', 'application/json');
                return $return;
        }

        $return = $response->withJson($data, 200)
            ->withHeader('Content-type', 'application/json');
            return $return;

    }

    public function create($request, $response, $args){

        $data = $request->getParsedBody();

        $arquivo = file_get_contents('pessoa.json');
        $arr = json_decode($arquivo, true);

        $arr[] = $data;

        $fp = fopen('pessoa.json', 'w');

        fwrite($fp, json_encode($arr));
        fclose($fp);

        $data = $response->withJson($data, 201)
        ->withHeader('Content-type', 'application/json');

        return $data;
    }

    public function update($request, $response, $args){
        $codigo =  $args['cod'];
        $data = $request->getParsedBody();


        $arquivo = file_get_contents('pessoa.json');
        $arr = json_decode($arquivo, true);


        foreach ($arr as $key => $value) {
            if($value['codigo'] == $codigo){
                unset($arr [$key]);
            }
        }

        $arr[] = $data;

        $fp = fopen('pessoa.json', 'w');

        fwrite($fp, json_encode($arr));
        fclose($fp);


        $return = $response->withJson('Atualizado', 200)
        ->withHeader('Content-type', 'application/json');

        return $return;
    }

    public function delete($request, $response, $args){
        $codigo =  $args['cod'];

        $arquivo = file_get_contents('pessoa.json');
        $arr = json_decode($arquivo, true);


        foreach ($arr as $key => $value) {
            if($value['codigo'] == $codigo){
                unset($arr [$key]);
            }
        }

        $fp = fopen('pessoa.json', 'w');

        fwrite($fp, json_encode($arr));
        fclose($fp);

        $data = $response->withJson('delete', 204)
        ->withHeader('Content-type', 'application/json');

        return $data;
    }
}
