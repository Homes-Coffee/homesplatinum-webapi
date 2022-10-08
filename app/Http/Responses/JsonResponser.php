<?php

namespace App\Http\Responses;

use Throwable;

/**
 * This class used to avoid errorss structure of response
 */
class JsonResponser extends \Illuminate\Http\JsonResponse
{
    /**
     * @var array<string, mixed>
     */
    protected array $response = [
        'message' => null,
        'alert'   => null,
        'notif'   => null,
        'data'    => null,
        'errors'  => null,
    ];

    public function success(string $message, $data = null, int $status = 200) : JsonResponser
    {
        $this->response['message']  = $message;
        $this->response['data']     = $data;

        $this->setData($this->response)->setStatusCode($status);
        return $this;
    }

    public function failure(string $message, $errors, int $status = 422) : JsonResponser
    {
        $this->response['message']  = $message;
        $this->response['errors']   = $errors;

        $this->setData($this->response)->setStatusCode($status);
        return $this;
    }

    public function exception(Throwable $throwable) : JsonResponser
    {
        $code = $throwable->getCode();

        if ($code < $this::HTTP_CONTINUE || $code >= $this::HTTP_NETWORK_AUTHENTICATION_REQUIRED) {
            $code = $this::HTTP_INTERNAL_SERVER_ERROR;
        }

        $this->response['message']  = 'server error';
        $this->response['errors']    = $throwable->getMessage();

        $this->setData($this->response)->setStatusCode($code);
        return $this;
    }

}
