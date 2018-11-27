<?php

namespace Leet;

class Coconut
{
    protected $client;
    protected $source;
    protected $webhook;
    protected $outputs;

    public function __construct(HttpClient $client)
    {
        $this->client = $client;
    }

    public function setSource(string $source) : Coconut
    {
        $this->source = $source;

        return $this;
    }
    
    public function setWebhook(string $webhook) : Coconut
    {
        $this->webhook = $webhook;

        return $this;
    }
   
    public function setOutput(string $format, string $path) : Coconut
    {
        $this->outputs[$format] = $this->formatPath($path);

        return $this;
    }

    public function getConfig() : array
    {
        return [
            'source' => $this->source,
            'webhook' => $this->webhook,
            'outputs' => $this->outputs,
        ];
    }

    public function createJob()
    {
        return $this->client->post('job', $this->getConfig());
    }

    protected function formatPath(string $path) : string
    {
        $config = config('coconut.s3');

        return sprintf('s3://%s:%s@%s', $config['access_key'], $config['secret_key'], $config['bucket']);
    }
}
