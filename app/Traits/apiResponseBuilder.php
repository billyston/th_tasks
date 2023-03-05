<?php
    namespace App\Traits;

    use Illuminate\Http\JsonResponse;

    trait apiResponseBuilder
    {
        /**
         * @param $data
         * @param bool $status_message
         * @param string $message
         * @param int $status_code
         * @return JsonResponse
         */
        public function successResponse( $data, bool $status_message, string $message, int $status_code ) : JsonResponse
        {
            return response() -> json([ 'status' => $status_message, 'code' => $status_code, 'message' => $message, 'data' => $data ]);
        }

        /**
         * @param $data
         * @param bool $status_message
         * @param string $message
         * @param int $status_code
         * @return JsonResponse
         */
        public function errorResponse( $data, bool $status_message, string $message, int $status_code ) : JsonResponse
        {
            return response() -> json([ 'status' => $status_message, 'code' => $status_code, 'message' => $message, 'data' => $data, ]);
        }
    }
