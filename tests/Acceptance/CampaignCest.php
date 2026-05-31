<?php

namespace Tests\Acceptance;

use Tests\Support\AcceptanceTester;
// Importe o seu model de Usuário (ajuste o namespace se for diferente, ex: App\Models\User)
use App\Models\User;

class CampaignCest
{
    /**
     * Summary of _before
     * @param AcceptanceTester $I
     * @return void
     */
    // phpcs:ignore PSR2.Methods.MethodDeclaration.Underscore
    public function _before(AcceptanceTester $I): void
    {
        // 1. Limpa ou garante que o usuário de teste exista no banco
        // Se o e-mail já existir, nós o deletamos primeiro para não dar erro de duplicidade
        $existingUser = User::where(['email' => 'fulano@example.com'])->first();
        if ($existingUser) {
            $existingUser->delete();
        }

        // 2. Cria o usuário usando o seu Model real
        $user = new User([
            'name' => 'Fulano Acceptance',
            'email' => 'fulano@example.com',
            'password' => password_hash('123456', PASSWORD_DEFAULT), // ou o método de hash que seu app usa
            'role' => 'manager_marketing',
            'active' => 1
        ]);
        $user->save();

        // 3. Agora o robô faz o fluxo de login na tela
        $I->amOnPage('/login');
        $I->fillField('user[email]', 'fulano@example.com');
        $I->fillField('user[password]', '123456');
        $I->click('Entrar');
    }

    public function tryToCreateCampaignWithInvalidData(AcceptanceTester $I): void
    {
        // O robô agora deve conseguir entrar aqui sem ser redirecionado!
        $I->amOnPage('/campaigns/new');

        $I->click('Salvar Campanha');

        $I->see('Existem dados incorretos! Por verifique!');
        $I->seeCurrentUrlEquals('/campaigns/new');
    }

    public function tryToUploadImageOnCampaignCreation(AcceptanceTester $I): void
    {
        $I->amOnPage('/campaigns/new');
        $I->fillField('campaign[title]', 'Campanha com Foto');
        $I->fillField('campaign[description]', 'Descrição da campanha');
        $I->fillField('campaign[start_date]', '2024-01-01');
        $I->fillField('campaign[end_date]', '2024-01-31');

        // Anexa um arquivo de imagem real da pasta de fixtures
        $I->attachFile('campaign_image', 'avatar.png'); // arquivo em tests/Support/Data/

        $I->click('Criar Campanha');

        $I->see('Campanha registrada com sucesso!');
        $I->seeCurrentUrlEquals('/campaigns');
    }

    public function tryToSeeImageOnCampaignShow(AcceptanceTester $I): void
    {
        $campaigns = \App\Models\Campaign::where(['title' => 'Campanha com Foto']);
        $campaign = $campaigns[0] ?? null;

        if (!$campaign) {
            $this->tryToUploadImageOnCampaignCreation($I);
            $campaigns = \App\Models\Campaign::where(['title' => 'Campanha com Foto']);
            $campaign = $campaigns[0] ?? null;
        }

        $I->amOnPage("/campaigns/{$campaign->id}");
        $I->dontSeeElement('img[src="/assets/images/defaults/campaign-placeholder.png"]');
        $I->seeElement('img[src*="/assets/uploads/campaigns/"]');
    }

    public function tryToDeleteCampaignAlsoRemovesImage(AcceptanceTester $I): void
    {
        $campaigns = \App\Models\Campaign::where(['title' => 'Campanha com Foto']);
        $campaign = $campaigns[0] ?? null;

        if (!$campaign) {
            $this->tryToUploadImageOnCampaignCreation($I);
            $campaigns = \App\Models\Campaign::where(['title' => 'Campanha com Foto']);
            $campaign = $campaigns[0] ?? null;
        }

        $I->amOnPage("/campaigns/{$campaign->id}");
        $I->click('Excluir');

        $I->see('Campanha removida com sucesso!');
        $I->seeCurrentUrlEquals('/campaigns');
    }
}
