<?php

namespace Database\Populate;

use App\Models\Campaign;

class CampaignsPopulate
{
    public static function populate()
    {
        $numberOfCampaigns = 100;

        for ($i = 0; $i < $numberOfCampaigns; $i++) {
            $Campaign = new Campaign(title: 'Campaign ' . $i);
            $Campaign->save();
        }

        echo "Campaigns populated with $numberOfCampaigns registers\n";
    }
}