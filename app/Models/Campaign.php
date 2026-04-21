<?php

namespace App\Models;

use DateTime;
use InvalidArgumentException;
use Core\Database\Database;

class Campaign
{
    /**
     * Summary of errors
     * @var array<string,string>
     */
    private array $errors = [];

    private $id;
    private string $title;
    private ?string $description;
    private ?DateTime $startDate;
    private ?DateTime $endDate;
    private ?string $imagePath; // Novo atributo para o caminho da imagem

    public function __construct(
        string $title, 
        ?int $id = null, 
        ?string $description = null, 
        ?DateTime $startDate = null, 
        ?DateTime $endDate = null, 
        ?string $imagePath = null
    ) {
        $this->title = $title;
        $this->id = $id;
        $this->description = $description;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->imagePath = $imagePath;
    }

    public function getId(): int
    {
        return $this->id;
    }
    public function getTitle(): string
    {
        return $this->title;
    }
    public function getDescription(): ?string
    {
        return $this->description;
    }
    public function getStartDate(): ?DateTime
    {
        return $this->startDate;
    }
    public function getEndDate(): ?DateTime
    {
        return $this->endDate;
    }
    public function getImagePath(): ?string
    {
        return $this->imagePath;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }
    public function setStartDate(?DateTime $startDate): void
    {
        $this->startDate = $startDate;
    }
    public function setEndDate(?DateTime $endDate): void
    {
        $this->endDate = $endDate;
    }
    public function setImagePath(?string $imagePath): void
    {
        $this->imagePath = $imagePath;
    }

    // Validação básica: data final não pode ser antes da inicial
    public function validateDateInitialEnd(): void
    {
        if ($this->endDate < $this->startDate) {
            throw new InvalidArgumentException("A data final não pode ser antes da data inicial.");
        }
    }

    // Método para formatar a saída (ex: d/m/Y)
    public function getIntervalFormated(string $format = 'd/m/Y'): string
    {
        if (!$this->startDate || !$this->endDate) {
            return 'Período não definido';
        }

        return $this->startDate->format($format) . ' até ' . $this->endDate->format($format);
    }


    public function destroy(): bool
    {
        $pdo = Database::getDatabaseConn();
        
        $sql = 'DELETE FROM campaigns WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $this->id);

        $stmt->execute();

        return ($stmt->rowCount() !== 0);
    }

    public function save(): bool
    {
        if ($this->isValid()) {
            $pdo = Database::getDatabaseConn();
            if ($this->newRecord()) {
                $sql = "INSERT INTO campaigns (title) VALUES (:title);";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':title', $this->title);

                $stmt->execute();

                $this->id = (int) $pdo->lastInsertId();
            } else {
                $sql = "UPDATE campaigns SET title = :title WHERE id = :id;";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':title', $this->title);
                $stmt->bindParam(':id', $this->id);

                $stmt->execute();
            }
            return true;
        }
        return false;
    }

    public function newRecord(): bool
    {
        return $this->id === null || $this->id === '';
    }

    public function isValid(): bool
    {
        $this->errors = []; // Limpa erros anteriores

        if (empty($this->title)) {
            $this->errors[] = 'O título da campanha é obrigatório.';
        }return empty($this->errors);
    }

    public function hasErrors(): bool
    {
        return !empty($this->errors);
    }

    public function getErrorsIndex(string $index): string | null
    {
        return $this->errors[$index] ?? null;
    }

    /**
     * Summary of all
     * @return Campaign[]
     */
    public static function all(): array
    {
        $campaigns = [];

        $pdo = Database::getDatabaseConn();
        $resp = $pdo->query('SELECT id, title FROM campaigns');

        foreach($resp as $row){
            $campaigns[] = new Campaign(id: $row['id'], title: $row['title']); 
        }

        return $campaigns;
    }

    public static function findById(int $id): ?Campaign
    {
        $pdo = Database::getDatabaseConn();

        $sql = 'SELECT id, title FROM campaigns WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);

        $stmt->execute();

        if($stmt->rowCount() == 0) {
            return null;
        }

        $row = $stmt->fetch();

        return new Campaign(id: $row['id'], title: $row['title']);
    }
}
