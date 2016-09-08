<?php namespace Anomaly\StoreOverviewWidgetExtension\Command;

use Anomaly\DashboardModule\Widget\Contract\WidgetInterface;


/**
 * Class CalculateOrderTotal
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\StoreOverviewWidgetExtension\Command
 */
class CalculateOrderTotal
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
        $orders  = $this->widget->getData()['orders'];
        $revenue = $this->widget->getData()['revenue'];

        if ($revenue) {
            $this->widget->addData('order_total', $revenue / $orders);
        }
    }
}
