<?php

namespace App\Controllers;

use App\Models\Campaign;
use DateTime;

class CampaignsController
{
    private $layout = 'application';
    public function index()
    {
        $campaigns = Campaign::all();

        $title = 'Campanhas';
        if ($this->isJsonRequest()) {
            $this->renderJson('index', compact('campaigns'));
        } else {
            $this->render('index', compact('campaigns', 'title'));
        }
    }

    public function show():void
    {
        $id = (int)$_GET['id'];
        $campaign = Campaign::findById($id);

        if (!$campaign) {
            header('Location: /pages/campaign/index.php');
            exit;
        }

        // Adicione o título aqui
        $title = 'Detalhes da Campanha';
        // Inclua o 'title' no compact
        $this->render('show', compact('campaign', 'title'));
    }

    public function new():void
    {
        $campaign = new Campaign(id: null, title: '', description: '', startDate: new DateTime(), endDate: new DateTime());
        $title = 'Criar Nova Campanha';
        $this->render('new', compact('campaign', 'title'));
    }

    public function create():void
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            $this->redirectTo('/pages/campaign');
        }

        $params = $_POST['campaign'];
        $campaign = new Campaign(
            id : null,
            title : trim($params['title']),
            description : trim($params['description']),
            startDate : new DateTime($params['start_date']),
            endDate : new DateTime($params['end_date'])
        );

        if ($campaign->save()) {
            $this->redirectTo('/pages/campaign');
        } else {
            // Recarrega o formulário com os erros
            $title = 'Criar Nova Campanha';
            $this->render('create', compact('campaign', 'title'));
        }
    }

    public function edit():void
    {
        $id = (int)$_GET['id'];

        $campaign = Campaign::findById($id);

        if (!$campaign) {
            $this->redirectTo('/pages/campaign');
        }

        $title = 'Editar Campanha';
        $this->render('edit', compact('campaign', 'title'));
    }

    public function update():void
    {
        $method = $_REQUEST['_method'] ?? $_SERVER['REQUEST_METHOD'];

        // Redireciona para a página de listagem se o método não for POST
        if ($method != 'PUT') {
            $this->redirectTo('/pages/campaign');
        }

        $params = $_POST['campaign'];

        $campaign = Campaign::findById($params['id']);
        $campaign->setTitle(trim($params['title']));

        if ($campaign->save()) {
            $this->redirectTo('/pages/campaign');
        } else {
            // Recarrega o formulário

            $title = $campaign['title'];
            $this->render('update', compact('campaign', 'title'));
        }
    }

    public function delete():void
    {
        $method = $_REQUEST['_method'] ?? $_SERVER['REQUEST_METHOD'];

        // Redireciona para a página de listagem se o método não for DELETE
        if ($method != 'DELETE') {
            $this->redirectTo('/pages/campaign');
        }

        $params = $_POST['campaign'];
        $campaign = Campaign::findById($params['id']);

        if ($campaign) {
            $campaign->destroy();
        }

        $this->redirectTo('/pages/campaign');

        require '/var/www/app/models/Campaign.php';
    }

    /**
     * Summary of render
     * @param string $view
     * @param array $data
     * @return void
     */
    private function render(string $view, array $data = []):void
    {
        extract($data);

        $view = '/var/www/app/views/campaign/' . $view . '.phtml';
        require '/var/www/app/views/layouts/' . $this->layout . '.phtml';
    }
    private function redirectTo(string $path):void
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
    private function renderJson(string $view, array $data = []):void
    {
        extract($data);

        $view = '/var/www/app/views/campaign/' . $view . '.phtml';
        $json = [];

        header('Content-Type: application/json, charset=utf-8');
        require $view;
        echo json_encode($json);
        return;
    }

    private function isJsonRequest():bool
    {
        return isset($_SERVER['HTTP_ACCEPT']) && strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false;
    }
}
