<?php namespace Anomaly\StoreOverviewWidgetExtension;

use Anomaly\DashboardModule\Widget\Contract\WidgetInterface;
use Anomaly\DashboardModule\Widget\Extension\WidgetExtension;
use Anomaly\StoreOverviewWidgetExtension\Command\LoadStoreOverview;

/**
 * Class StoreOverviewWidgetExtension
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\StoreOverviewWidgetExtension
 */
class StoreOverviewWidgetExtension extends WidgetExtension
{

    /**
     * This extension provides the "Top Products"
     * products module widget for the dashboard module.
     *
     * @var null|string
     */
    protected $provides = 'anomaly.module.dashboard::widget.store_overview';

    /**
     * Load the widget data.
     *
     * @param WidgetInterface $widget
     */
    protected function load(WidgetInterface $widget)
    {
        $this->dispatch(new LoadStoreOverview($widget));
    }
}
