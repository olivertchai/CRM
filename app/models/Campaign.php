<?php

class Campaign
{
    private const DB_PATH = '/var/www/database/campaigns.txt';
    private array $errors = [];

    private $id;
    private $title;
    private $description;
    private DateTime $startDate;
    private DateTime $endDate;
    private $imagePath; // Novo atributo para o caminho da imagem

    public function __construct($id, $title, $description, DateTime $startDate, DateTime $endDate, $imagePath = null)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->imagePath = $imagePath;
    }

    public function getId(){return $this->id;}
    public function getTitle(){return $this->title;}
    public function getDescription(){return $this->description;}
    public function getStartDate(){return $this->startDate;}
    public function getEndDate(){return $this->endDate;}
    public function getImagePath(){return $this->imagePath;}

    public function setTitle($title){$this->title = $title;}
    public function setDescription($description){$this->description = $description;}
    public function setStartDate(DateTime $startDate){$this->startDate = $startDate;}
    public function setEndDate(DateTime $endDate){$this->endDate = $endDate;}
    public function setImagePath($imagePath){$this->imagePath = $imagePath;}

    // Validação básica: data final não pode ser antes da inicial
    public function validateDateInitialEnd()
    {
        if ($this->endDate < $this->startDate) {
            throw new InvalidArgumentException("A data final não pode ser antes da data inicial.");
        }
    }

    // Método para formatar a saída (ex: d/m/Y)
    public function getIntervalFormated(string $format = 'd/m/Y'): string {
        return $this->startDate->format($format) . ' até ' . $this->endDate->format($format);
    }

    public function save():bool{
        if($this->isValid()) {
            $this->id = uniqid(); // Gerar um ID único para a campanha
            // Aqui você pode implementar a lógica para salvar a campanha em um banco de dados real
            file_put_contents(self::DB_PATH, $this->title. PHP_EOL, FILE_APPEND);
            return true;
        } else {
            return false;
        }
    }
    public function isValid():bool{
        $this->errors = []; // Limpa erros anteriores

        if(empty($this->title)) {
            $this->errors[] = 'O título da campanha é obrigatório.';
        }return empty($this->errors);
    }

    public function hasErrors(): bool{
        return empty($this->errors);
    }

    public function getErrorsIndex($index): array{
        return $this->errors[$index] ?? [];
    }

    public static function all(): array{
        $campaigns = file(self::DB_PATH, FILE_IGNORE_NEW_LINES);

        return array_map(function($line,$title) {
            // Aqui você pode implementar a lógica para criar objetos Campaign a partir das linhas do arquivo
            return new Campaign($line, $title, null, new DateTime(), new DateTime());
        },array_keys($campaigns) , $campaigns);
    }

    public static function findById($id): ?Campaign{
        $campaigns = self::all();
        
        foreach ($campaigns as $campaign) {
            if ($campaign->getId() === $id) {
                return $campaign;
            }
        }
        return null; // Retorna null se a campanha não for encontrada
    }
}