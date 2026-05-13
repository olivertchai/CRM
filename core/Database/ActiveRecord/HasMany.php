<?php

namespace Core\Database\ActiveRecord;

use Lib\Paginator;

class HasMany
{
    public function __construct(
        private Model $model,
        private string $related,
        private string $foreignKey
    ) {
    }

    /**
     * @return array<Model>
     */
    public function get(): array
    {
        return $this->related::where([$this->foreignKey => $this->model->id]);
    }

    /**
     * @param array<string, mixed> $params
     */
    public function new(array $params = []): Model
    {
        $params[$this->foreignKey] = $this->model->id;

        return new $this->related($params);
    }

    public function findById(int $id): ?Model
    {
        return $this->related::findBy(
            [
                $this->foreignKey => $this->model->id,
                'id' => $id,
            ]
        );
    }

    public function paginate(int $page = 1, int $per_page = 10, ?string $route = null): Paginator
    {
        return $this->related::paginate(
            $page,
            $per_page,
            $route,
            [$this->foreignKey => $this->model->id] // A condição vai aqui no final
        );
    }
}
