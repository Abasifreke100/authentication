<?php

namespace Glee\Modules;


use Ramsey\Uuid\Uuid;
use function preg_replace;
use function str_replace;
use function strtolower;
use function trim;

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

    /**
     * Generates unique referrals codes
     * It does this by generating and checking if it exists
     * in the users table
     * change $code to $uri
     * @return string
     */
//    public function generateReferralCode(){
//        $chars = str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789');
//        $totalChars = count($chars);
//
//        do {
//            $uri = '';
//            for($i = 0; $i< 5; $i++){
//                $index =  rand(0,$totalChars-1);
//                $uri.=$chars[$index];
//            }
//        }while(Referral::where('uri', $uri)->first());
//
//        return $uri;
//    }

    /**
     * Generates user account number
     * @return string
     */
//    public function generateWalletNo()
//    {
//        return date('ym') . rand(100000, 999999);
//    }


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
