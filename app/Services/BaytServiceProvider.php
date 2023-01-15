<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use SimpleXMLElement;

class BaytServiceProvider
{
    public function requestData(string $path): array
    {
        $data = Cache::get('jobs');

        if (!$data) {
            try {
                $xml = new SimpleXMLElement($path, 0, true);
            } catch (\Throwable$th) {
                return [];
            }
            $data = $this->parseXML($xml->channel);
            Cache::put('jobs', $data, 60 * 60);
        }

        return $data;
    }

    /**
     * xml to array
     *
     * @return array
     */
    public function parseXML(SimpleXMLElement $xml): array
    {
        $data = [];
        foreach ($xml->item as $item) {
            $data[] = [
                'title' => (string) $item->title,
                'link' => (string) $item->link,
                'description' => (string) $item->description,
                'posted_date' => (string) $item->posted_date,
                'country' => (string) $item->country,
                'city' => (string) $item->city,
                'division' => (string) $item->division,
                'profile' => (string) $item->profile,
                'category' => (string) $item->category,
                'id' => $this->getItemIdFromLink($item->link),
            ];
        }
        return $data;
    }

    private function getItemIdFromLink(string $link): string
    {
        //Supose the last item in the link is the id of item
        $link = rtrim($link, '/');
        $words = explode('/', $link);
        return end($words);
    }

    public function getItemById(string $id): array
    {
        $job = Cache::get($id);
        if ($job) {
            return $job;
        }
        
        $data = $this->requestData(config('xmlPaths.rotana_careers'));
        $job = array_filter($data, function ($item) use ($id) {
            return $item['id'] == $id;
        });

        if(empty($job)){
            return [];
        }
        $job = reset($job);
        Cache::put($id, $job, 60 * 60);
        return $job;
    }

}
