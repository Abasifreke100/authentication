<?php


namespace LoanHistory\Modules;


use Ramsey\Uuid\Uuid;

class BaseRepository
{

    /**
     * Generates UuId
     * @return mixed
     * @throws \Exception
     */
    public function generateUuid()
    {
        return Uuid::uuid4()->toString();
    }


    public function slugIt($text)
    {
        return str_replace('--', '-', strtolower(preg_replace('/[^a-zA-Z0-9]/', '-', trim($text))));
    }


    public function failResponse($message, $code = 500): array
    {
        return [
            'status' => 'fail',
            'message' => $message,
            'status_code' => $code
        ];
    }


    public function successResponse($data = null, $message = null): array
    {
        return [
            'status' => 'success',
            'data' => $data,
            'message' => $message
        ];
    }


}
