<?php
namespace boryshaiduchuk\seo\service;

use Yii;
use yii\web\UrlManager;

/**
 * Class to generate a site map
 */
class Sitemap
{
    const ALWAYS = 'always';
    const HOURLY = 'hourly';
    const DAILY = 'daily';
    const WEEKLY = 'weekly';
    const MONTHLY = 'monthly';
    const YEARLY = 'yearly';
    const NEVER = 'never';

    protected $items = array();
    protected $urlManager;

    /**
     * Sitemap constructor.
     * @param UrlManager $urlManager
     */
    public function __construct(UrlManager $urlManager)
    {
        $this->urlManager = $urlManager;
    }

    /**
     * @param $url
     * @param string $changeFreq
     * @param float $priority
     * @param int $lastMod
     */
    public function addUrl($url, $changeFreq = self::DAILY, $priority = 0.7, $lastMod = 0)
    {
        $host = Yii::$app->request->getHostInfo();
        $item = [
            'loc' => $host . $url,
            'changefreq' => $changeFreq,
            'priority' => $priority
        ];
        if ($lastMod)
            $item['lastmod'] = $this->dateToW3C($lastMod);

        $this->items[] = $item;
    }


    /**
     * @param $models
     * @param string $changeFreq
     * @param float $priority
     */
    public function addModels($models, $changeFreq=self::DAILY, $priority = 0.7)
    {
        $host = Yii::$app->request->getHostInfo();

        foreach ($models as $model) {
            $url = $this->urlManager->createUrl($model->getUrl());
            $item = [
                'loc' => $host . $url,
                'changefreq' => $changeFreq,
                'priority' => $priority
            ];

            if ($model->hasAttribute('updated_at'))
                $item['lastmod'] = $this->dateToW3C($model->updated_at);

            $this->items[] = $item;
        }
    }

    /**
     * Render xml
     * @return string
     */
    public function render()
    {
        $dom = new \DOMDocument('1.0', 'utf-8');
        $urlset = $dom->createElement('urlset');
        $urlset->setAttribute('xmlns','http://www.sitemaps.org/schemas/sitemap/0.9');
        foreach($this->items as $item) {
            $url = $dom->createElement('url');

            foreach ($item as $key => $value) {
                $elem = $dom->createElement($key);
                $elem->appendChild($dom->createTextNode($value));
                $url->appendChild($elem);
            }

            $urlset->appendChild($url);
        }
        $dom->appendChild($urlset);

        return $dom->saveXML();
    }

    /**
     * @param $date
     * @return false|string
     */
    protected function dateToW3C($date)
    {
        if (is_int($date))
            return date('Y-m-d', $date);
        else
            return date(DATE_W3C, strtotime($date));
    }

}