<?php declare(strict_types=1);

namespace  DurakBackend\Api\Controllers;
class BaseController {
    private \Http\Request $request;
    private \Http\Response $response;
    public function __construct(\Http\Request $request, \Http\Response $response) {
        $this->request = $request;
        $this->response = $response;
    }

    public function fetchJSONBody() {
        return json_decode($this->request->getRawBody(), true);
    }

    public function returnJSONResponse(mixed $data) {
        echo json_encode($data);
    }
}