<?php

namespace Rownosc\Api\Services;


use Rownosc\Api\ApiClient;

class BibliographyEntityApiService extends BaseEntityApiService {

    public function __construct(ApiClient $client)
    {
        parent::__construct($client, 'bibliography');
    }

    public function getArticle()
    {
        return new ArticleServiceEntity($this->client);
    }

    public function getDocument()
    {
        return new DocumentServiceEntity($this->client);
    }

    public function getJournal()
    {
        return new JournalServiceEntity($this->client);
    }

    public function getMultimedium()
    {
        return new MultimediumServiceEntity($this->client);
    }

    public function getPublication()
    {
        return new PublicationServiceEntity($this->client);
    }

    public function getResearch()
    {
        return new ResearchServiceEntity($this->client);
    }
}