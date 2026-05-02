<?php

namespace App\Controllers;

use App\Models\Campaign;
use App\Models\User;
use Core\Http\Request;
use DateTime;
use Lib\Authentication\Auth;
use Lib\FlashMessage;
use App\Middleware\Authenticate;

class CampaignsController
{
    private  $layout = 'application';
    private ?User $currentUser = null;

    public function currentUser(): ?User
    {
        if ($this->currentUser === null) {
            $this->currentUser = Auth::user();
        }

        return $this->currentUser;
    }

    public function index(Request $request): void
    {
        $paginator = Campaign::paginate(page: $request->getParam('page', 1));
        $campaigns = $paginator->registers();

        $title = 'Campanhas';
        if ($request->acceptJson()) {
            $this->renderJson('index', compact('paginator','campaigns', 'title'));
        } else {
            $this->render('index', compact('paginator','campaigns', 'title'));
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
            FlashMessage::success('Campanha registrada com sucesso!');
            $this->redirectTo(route('campaigns.index'));
        } else {
            FlashMessage::danger('Existe dados incorretor, por favor verifique!');
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
            FlashMessage::success('Campanha atualizada com sucesso!');
            $this->redirectTo(route('campaigns.index'));
        } else {
            FlashMessage::danger('Existe dados incorretor, por favor verifique!');
            // Recarrega o formulário
            //$title = $campaign['title'];
            $title = 'Editar Campanha';
            $this->render('edit', compact('campaign', 'title'));
        }
    }

    public function destroy(Request $request): void
    {

        $params = $request->getParams();
        $campaign = Campaign::findById($params['id']);

        if ($campaign) {
            $campaign->destroy();
        }
        FlashMessage::success('Campanha removida com sucesso!');
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

    private function redirectTo(string $location): void
    {
        header('Location: ' . $location);
        exit;
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
