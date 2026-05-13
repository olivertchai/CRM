<?php

namespace App\Controllers;

use App\Models\Campaign;
use Core\Http\Controllers\Controller;
use App\Models\User;
use Core\Http\Request;
use Lib\Authentication\Auth;
use Lib\FlashMessage;

class CampaignsController extends Controller
{
    protected string $layout = 'application';

    public function index(Request $request): void
    {
        $paginator = Campaign::paginate(page: $request->getParam('page', 1));
        $campaigns = $paginator->registers();

        $title = 'Campanhas';
        if ($request->acceptJson()) {
            $this->renderJson('campaign/index', compact('paginator', 'campaigns', 'title'));
        } else {
            $this->render('campaign/index', compact('paginator', 'campaigns', 'title'));
        }
    }

    public function show(Request $request): void
    {
        $params = $request->getParams();

        $campaign = Campaign::findById($params['id']);

        $title = 'Detalhes da Campanha';
        $this->render('campaign/show', compact('campaign', 'title'));
    }

    public function new(): void
    {
        $campaign = new Campaign(id: null, title: '');
        $title = 'Criar Nova Campanha';
        $this->render('campaign/new', compact('campaign', 'title'));
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
            $this->render('campaign/new', compact('campaign', 'title'));
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
        $this->render('campaign/edit', compact('campaign', 'title'));
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
            $this->render('campaign/edit', compact('campaign', 'title'));
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
}
