<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contact';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'services',
        'other_info',
        'qualification',
        'description',
        'url',
        'ref_url',
        'source_url',
        'source',
        'medium',
        'ip_data',
        'section',
        'cv',
        'country',
        'ip',
    ];

    protected function gadCampaignId(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getUrlQueryValue('gad_campaignid')
        );
    }

    protected function gclid(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getUrlQueryValue('gclid')
        );
    }

    public function getUrlQueryValue(string $key): ?string
    {
        if (trim((string) $this->medium) !== 'Google Ads (GA)') {
            return null;
        }

        $url = trim((string) $this->url);

        if ($url === '') {
            return null;
        }

        $query = parse_url($url, PHP_URL_QUERY);

        if (! is_string($query) || $query === '') {
            return null;
        }

        parse_str($query, $parameters);

        $value = $parameters[$key] ?? null;

        return is_scalar($value) && trim((string) $value) !== ''
            ? trim((string) $value)
            : null;
    }
}
