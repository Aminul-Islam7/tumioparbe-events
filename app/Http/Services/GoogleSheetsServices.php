<?php

namespace App\Http\Services;

use Google\Client;
use Google\Service\Sheets;
use Google\Service\Sheets\ValueRange;


class GoogleSheetsServices
{
  public $client, $service, $documentId, $range;

  public function __construct()
  {
    $this->client = $this->getClient();
    $this->service = new Sheets($this->client);
    $this->documentId = '1-4vJEsrCl4S9GLY0P5mrDBBj0pdkgN1l4m7mnjGQMSg';
    $this->range = 'A:Z';
  }

  public function getClient()
  {
    $client = new Client();
    $client->setApplicationName('Tumio Parbe Events - Sheets');
    $client->setRedirectUri('https://events.tumioparbe.com/');
    $client->setScopes(Sheets::SPREADSHEETS);
    $client->setAuthConfig(storage_path('tumio-parbe-events-sheets-b7be9936447f.json'));
    $client->setAccessType('offline');
    return $client;
  }

  public function readSheet()
  {
    $doc = $this->service->spreadsheets_values->get($this->documentId, $this->range);
    return $doc;
  }

  public function writeSheet($values)
  {
    $body = new ValueRange([
      'values' => $values
    ]);

    $params = [
      'valueInputOption' => 'RAW'
    ];

    $result = $this->service->spreadsheets_values->update($this->documentId, $this->range, $body, $params);
  }

  public function appendSheet($values)
  {
    $body = new ValueRange([
      'values' => $values
    ]);

    $params = [
      'valueInputOption' => 'RAW'
    ];

    $result = $this->service->spreadsheets_values->append($this->documentId, $this->range, $body, $params);
  }
}
