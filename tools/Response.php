<?php
/**
 * This file contains Response class.
 *
 * Created by PhpStorm on 27/12/2021 at 15:44
 *
 * @author Sofiakb <contact.sofiak@gmail.com>
 * @package Sofiakb\Tools
 * @file Sofiakb\Tools\Response
 */

namespace Sofiakb\Tools;

use Sofiakb\Tools\Result\Error;
use Sofiakb\Tools\Result\Success;

class Response
{
    
    /**
     * @var array $statusTexts Tableau de message en cas de statut personnalisé
     */
    private static $statusTexts = array(
        "496" => "Request need HTTPS"
    );
    
    
    /**
     * Cette fonction permet d'envoyer une réponse
     * au client après une requête
     *
     * Return response to client
     *
     * @param int|mixed $status Statut de la réponse
     * @param mixed $data Données à envoyer avec la réponse
     * @return string|mixed
     */
    public static function main($status = 200, $data = null)
    {
        if (!is_int($status)) {
            $data = $status;
            $status = 200;
        }
        
        $data = array(
            'status' => $status, // success or not?
            'data'   => $data
        );
        
        if (function_exists('response'))
            return response()->json($data)->setStatusCode($status);
        
        http_response_code($status);
        header('Content-Type: application/json');
        return json_encode($data);
    }
    
    /**
     * Cette fonction permet d'envoyer une success réponse
     * au client après une requête
     *
     * Return response to client
     *
     * @param int|mixed $status Statut de la réponse
     * @param mixed $data Données à envoyer avec la réponse
     * @return string|mixed
     */
    public static function success($status = 200, $data = null)
    {
        return is_int($status) ? self::main($status, $data) : self::main(200, $data ?? $status);
    }
    
    
    /**
     * Cette fonction permet d'envoyer une success réponse
     * au client après une requête
     *
     * Return response to client
     *
     * @param int|mixed $status Statut de la réponse
     * @param mixed $data Données à envoyer avec la réponse
     * @return string|mixed
     */
    public static function error($status = 500, $data = null)
    {
        if (!is_int($status)) {
            $data = ['message' => $data, 'code' => $status];
            $status = 500;
        }
        
        if ($status === 400)
            return self::main($status, ["error" => $data ?: "La requête est mal formée"]);
        if ($status === 401)
            return self::main($status, ["error" => $data ?: "Vous devez être connecté"]);
        if ($status === 403)
            return self::main($status, ["error" => $data ?: "Vous n'avez pas les droits"]);
        if ($status === 404)
            return self::main($status, ["error" => $data ?: "La ressource demandée n'existe pas"]);
        if ($status === 405)
            return self::main($status, ["error" => $data ?: "La méthode utilisée n'est pas autorisée"]);
        return self::main($status, ["error" => $data ?: "Une erreur inconnue est survenue"]);
    }
    
    /**
     * @param $data
     * @param ?string $name
     * @return string|mixed
     */
    public static function unknown($data, ?string $name = null)
    {
        if (Success::is($data)) {
            $message = $name ? [$name => $data->message] : $data->message;
            return self::success($data->code, $message);
        } elseif (Error::is($data))
            return self::error($data->code ?? 500, $data->message ?? $data);
        else {
            return ($name === null ? self::success($data) : self::success([$name => $data]));
        }
    }
    
}