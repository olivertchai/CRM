<?php

namespace Tests\Unit\Models;

use App\Models\Campaign;
use App\Services\CampaignImage;
use Tests\TestCase;

class CampaignImageTest extends TestCase
{
    private function makeCampaign(): Campaign
    {
        $campaign = new Campaign([
            'title'       => 'Campanha Teste',
            'description' => 'Descrição',
            'start_date'  => '2024-01-01',
            'end_date'    => '2024-01-31',
        ]);
        $campaign->id = 1;

        return $campaign;
    }

    public function test_path_returns_default_when_no_image(): void
    {
        $campaign = $this->makeCampaign();
        $campaign->image_url = null;

        $service = new CampaignImage($campaign);

        $this->assertEquals(
            '/assets/images/defaults/campaign-placeholder.png',
            $service->path()
        );
    }

    public function test_path_returns_correct_url_when_image_exists(): void
    {
        $campaign = $this->makeCampaign();
        $campaign->image_url = 'image.jpg';

        $service = new CampaignImage($campaign);

        $this->assertEquals(
            '/assets/uploads/campaigns/1/image.jpg',
            $service->path()
        );
    }

    public function test_update_does_nothing_when_no_file_sent(): void
    {
        $campaign = $this->makeCampaign();
        $campaign->image_url = null;

        $service = new CampaignImage($campaign);
        $service->update([]);

        $this->assertNull($campaign->image_url);
    }

    public function test_update_does_nothing_when_tmp_name_is_empty(): void
    {
        $campaign = $this->makeCampaign();
        $campaign->image_url = null;

        $service = new CampaignImage($campaign);
        $service->update([
            'name'     => 'foto.jpg',
            'tmp_name' => '',
            'size'     => 1024,
            'error'    => UPLOAD_ERR_NO_FILE
        ]);

        $this->assertNull($campaign->image_url);
    }
}
