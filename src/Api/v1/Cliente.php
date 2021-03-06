<?php

namespace PagueVeloz\Api\v1;

/*
 * Cliente.php
 *
 *
 * @author Cristian B. dos Santos <cristian.deveng@gmail.com>
 * @copyright 2015
 * @version 1.0v
*/

use PagueVeloz\Api\InterfaceApi;
use PagueVeloz\Api\v1\Dto\ClienteDTO;
use PagueVeloz\Service\Context\HttpRequest;
use PagueVeloz\ServiceProvider;

class Cliente extends ServiceProvider implements InterfaceApi
{
    public function __construct(ClienteDTO $dto)
    {
        $this->dto = $dto;
        $this->uri = '/v1/Cliente';

        parent::__construct();

        return $this;
    }

    public function Get()
    {
        $this->method = 'GET';
        $this->Authorization();

        return $this->init();
    }

    public function GetById($id)
    {
        return $this->NoContent();
    }

    public function GetStatus()
    {
        $this->method = 'GET';
        $this->Authorization();
        $this->url = sprintf('%s/Status', $this->url);

        return $this->init();
    }

    public function GetDocumentosPendentes()
    {
        $this->method = 'GET';
        $this->Authorization();
        $this->url = sprintf('/%s/DocumentosPendentes', $this->url);

        return $this->init();
    }

    public function GetDocumentosEnviados($id)
    {
        $this->method = 'GET';
        $this->Authorization();
        $this->url = sprintf('/%s/DocumentosEnviados/%s/Baixar', $this->url, $id);

        return $this->init();
    }

    public function Post()
    {
        return $this->NoContent();
    }

    public function Put($id = null)
    {
        if ($this->isEmpty($this->dto->getRequest())) {
            throw new \Exception('Erro ao montar request');
        }

        $this->Authorization();
        $request = new HttpRequest();

        $request->body = $this->dto->getRequest();
        $this->method = 'PUT';

        return $this->init($request);
    }

    public function Delete($id)
    {
        return $this->NoContent();
    }
}
