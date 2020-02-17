<?php namespace Indikator\SellProducts\Models;

use Model;
use Cms\Classes\Page;
use Cms\Classes\Theme;
use System\Classes\PluginManager;

class Settings extends Model
{
    public $implement = ['System.Behaviors.SettingsModel'];

    public $settingsCode = 'indikator_sellproducts_settings';

    public $settingsFields = 'fields.yaml';

    public function getBarionRedirectOptions()
    {
        return $this->pageList();
    }

    public function getBarionCallbackOptions()
    {
        return $this->pageList();
    }

    public function getTransferRedirectOptions()
    {
        return $this->pageList();
    }

    public function getCashRedirectOptions()
    {
        return $this->pageList();
    }

    public function pageList()
    {
        $result = [];
        $pages  = Page::sortBy('baseFileName')->all();

        foreach ($pages as $page) {
            $result[$page->url] = $page->title;
        }

        $pluginManager = PluginManager::instance()->findByIdentifier('RainLab.Pages');
        if (!$pluginManager || $pluginManager->disabled) {
            return $result;
        }

        $pages = \RainLab\Pages\Classes\Page::listInTheme(Theme::getActiveTheme());

        foreach ($pages as $page) {
            if (array_key_exists('title', $page->viewBag)) {
                $result[$page->viewBag['url']] = $page->viewBag['title'];
            }
        }

        natsort($result);

        return $result;
    }
}
