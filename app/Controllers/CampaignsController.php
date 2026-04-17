<?php

namespace App\Controllers;

use App\Models\Campaign;
use Core\Http\Request;
use DateTime;

class CampaignsController
{
    private  $layout = 'application';

    public function index(Request $request): void
    {
        $campaigns = Campaign::all();

        $title = 'Campanhas';
        if ($request->acceptJson()) {
            $this->renderJson('index', compact('campaigns'));
        } else {
            $this->render('index', compact('campaigns', 'title'));
        }
    }

    public function show(Request $request): void
    {
        $params = $request->getParams();

        $campaign = Campaign::findById($params['id']);

        $title = 'Detalhes da Campanha';
        $this->render('show', compact('campaign', 'title'));
    }

    public function new(): void
    {
        $campaign = new Campaign(id: null, title: '');
        $title = 'Criar Nova Campanha';
        $this->render('new', compact('campaign', 'title'));
    }

    public function create(Request $request): void
    {
        $params = $request->getParams();
        $campaign = new Campaign(
            id : null,
            title : trim($params['campaign']['title']),
        );

        if ($campaign->save()) {
            $this->redirectTo(route('campaigns.index'));
        } else {
            // Recarrega o formulário com os erros
            $title = 'Criar Nova Campanha';
            $this->render('new', compact('campaign', 'title'));
        }
    }

    public function edit(Request $request): void
    {
        $params = $request->getParams();

        $campaign = Campaign::findById($params['id']);

        if (!$campaign) {
            $this->redirectTo(route('campaigns.index'));
        }

        $title = 'Editar Campanha';
        $this->render('edit', compact('campaign', 'title'));
    }

    public function update(Request $request): void
    {
        $params = $request->getParams();

        $campaign = Campaign::findById($params['id']);
        $campaign->setTitle(trim($params['campaign']['title']));

        if ($campaign->save()) {
            $this->redirectTo(route('campaigns.index'));
        } else {
            // Recarrega o formulário

            $title = $campaign['title'];
            $this->render('edit', compact('campaign', 'title'));
        }
    }

    public function delete(Request $request): void
    {

        $params = $request->getParams();
        $campaign = Campaign::findById($params['id']);

        if ($campaign) {
            $campaign->destroy();
        }

        $this->redirectTo(route('campaigns.index'));
    }

    /**
     * Summary of render
     * @param string $view
     * @param array $data<string, mixed>
     * @return void
     */
    private function render(string $view, array $data = []): void
    {
        extract($data);

        $view = '/var/www/app/views/campaign/' . $view . '.phtml';
        require '/var/www/app/views/layouts/' . $this->layout . '.phtml';
    }
    private function redirectTo(string $path): void
    {
        header('Location: ' . $path);
        exit();
    }

    /**
     * Summary of renderJson
     * @param string $view
     * @param array<string, mixed> $data
     * @return void
     */
    private function renderJson(string $view, array $data = []): void
    {
        extract($data);

        $view = '/var/www/app/views/campaign/' . $view . '.phtml';
        $json = [];

        header('Content-Type: application/json, charset=utf-8');
        require $view;
        echo json_encode($json);
        return;
    }
}
