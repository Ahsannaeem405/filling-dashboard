<?php

namespace App\Imports;

use App\Models\Account;
use Maatwebsite\Excel\Concerns\ToModel;

class AccountImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $description = $row[0];
        $refreshToken = $this->extractRefreshToken($description);
        $account_id = $this->extractAccountId($description);

        return new Account([
            'description' => $description,
            'refreshToken' => $refreshToken,
            'account_id' => $account_id,
        ]);
    }

    private function extractRefreshToken($description)
    {
        $refreshToken = null;
        $jsonString = substr($description, strpos($description, '['));
        $jsonArray = json_decode($jsonString, true);
        
        if ($jsonArray) {
            foreach ($jsonArray as $item) {
                if (isset($item['name']) && $item['name'] === 'refresh_token') {
                    $refreshToken = $item['value'];
                    break;
                }
            }
        }

        return $refreshToken;
    }

    private function extractAccountId($description)
    {
        $account_id = null;
        $userIdPattern = '/:(\d+):/';

        if (preg_match($userIdPattern, $description, $userIdMatches)) {
            $account_id = $userIdMatches[1];
        }

        return $account_id;
    }
}
