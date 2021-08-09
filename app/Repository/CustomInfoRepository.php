<?php


namespace App\Repository;


use App\Models\CustomInfo;
use Illuminate\Support\Collection;

class CustomInfoRepository extends BaseRepository
{
    public function __construct(CustomInfo $customInfo)
    {
        $this->model = $customInfo;
    }

    public function getFormatSocialLinks($customable_type, $customable_id)
    {
       return $this->formatInformation($this->basicQuery($customable_type, $customable_id)
           ->where('type', 'social_links')
           ->get(['id', 'name', 'value']));
    }

    public function formatInformation(Collection $collection)
    {
       return $collection->reduce(function ($final, $links){
            $final[$links->name] = $links->value;
            return $final;
        }, []);
    }

    public function findSocialLinksWithName(string $name, $column = null, $customable_type, $customable_id)
    {
        $links = $this->basicQuery($customable_type, $customable_id)
            ->where('type', 'social_links')
             ->where('name', $name)
             ->first(['id', 'name', 'value']);

         if ($column) {
             return $links->$column;
         }

         return $links;
    }

    private function basicQuery($customable_type, $customable_id)
    {
        return $this->model::query()
            ->where('customable_type', $customable_type)
            ->where('customable_id', $customable_id);
    }

}
