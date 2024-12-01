<?php 

class FilmController
{
    private $gateway;

    public function __construct(FilmGateway $gateway)
    {
        $this->gateway = $gateway;
    }

    public function processRequest(string $method, ?string $id): void
    {
        if ($id) {
            $this->processResourceRequest($method, $id);
        } else {
            $this->processCollectionRequest($method);
        }
    }

    private function processResourceRequest(string $method, string $id): void
    {
        $film = $this->gateway->get($id);

        if (!$film) {
            http_response_code(404);
            echo json_encode(["message" => "Film not found"]);
            return;
        }

        switch ($method) {
            case "GET":
                echo json_encode($film);
                break;
            case "PATCH":
                $data = (array) json_decode(file_get_contents("php://input"), true);

                $errors = $this->getValidationErrors($data, false);
                
                if (!empty($errors)) {
                    http_response_code(422);
                    echo json_encode(["errors" => $errors]);
                    break;
                }

                $rows = $this->gateway->update($film, $data);

                echo json_encode([
                    "message" => "Film $id updated",
                    "rows" => $rows
                ]);
                break;

            case "DELETE":
                $rows = $this->gateway->delete($id);

                echo json_encode([
                    "message" => "Film $id deleted",
                    "rows" => $rows
                ]);
            break;

            default:
                http_response_code(405);
                header("Allow: GET, PATCH, DELETE");
        }
        
    }

    private function processCollectionRequest(string $method): void
    {
        switch ($method) {
            case "GET":
                echo json_encode($this->gateway->getAll());
                break;
            case "POST":
                $data = (array) json_decode(file_get_contents("php://input"), true);
                
                $errors = $this->getValidationErrors($data);
                
                if (!empty($errors)) {
                    http_response_code(422);
                    echo json_encode(["errors" => $errors]);
                    break;
                }

                $id = $this->gateway->create($data);

                http_response_code(201);
                echo json_encode([
                    "message" => "Film created",
                    "id" => $id
                ]);
                break;
            
            default:
                http_response_code(405);
                header("Allow: GET, POST");
        }
    }

    private function getValidationErrors(array $data, bool $is_new = true): array
    {
        $errors = [];

        if ($is_new && empty($data["title"])) {
            $errors[] = "title is required";
        }

        if (array_key_exists("rating", $data)) {

            if (filter_var($data["rating"], FILTER_VALIDATE_INT) === false) {
                $errors[] = "rating must be an integer";
            }
        }

        if (array_key_exists("release_date", $data)) {

            if (!$this->validateDate($data["release_date"], "Y-m-d")) {
                $errors[] = "release_date must be in format Y-m-d";
            }
        }

        return $errors;
    }

    public function validateDate($date, $format = "Y-m-d") 
    { 
        $d = DateTime::createFromFormat($format, $date); 
        return $d && $d->format($format) === $date; 
    } 
}