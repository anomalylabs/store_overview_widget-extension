<?php namespace Anomaly\StoreOverviewWidgetExtension\Command;

use Anomaly\DashboardModule\Widget\Contract\WidgetInterface;


/**
 * Class CalculateUnitPrice
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\StoreOverviewWidgetExtension\Command
 */
class CalculateUnitPrice
{

    /**
     * The widget instance.
     *
     * @var WidgetInterface
     */
    protected $widget;

    /**
     * Create a new LoadTopGrossing instance.
     *
     * @param WidgetInterface $widget
     */
    public function __construct(WidgetInterface $widget)
    {
        $this->widget = $widget;
    }

    /**
     * Handle the command.
     */
    public function handle()
    {
        $products = $this->widget->getData()['products'];
        $revenue  = $this->widget->getData()['revenue'];

        if ($revenue) {
            $this->widget->addData('unit_price', $revenue / $products);
        }
    }
}
