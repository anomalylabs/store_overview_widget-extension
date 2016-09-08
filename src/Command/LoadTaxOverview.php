<?php namespace Anomaly\StoreOverviewWidgetExtension\Command;

use Anomaly\DashboardModule\Widget\Contract\WidgetInterface;
use Anomaly\OrdersModule\Order\Contract\OrderRepositoryInterface;


/**
 * Class LoadTaxOverview
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\StoreOverviewWidgetExtension\Command
 */
class LoadTaxOverview
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
     *
     * @param OrderRepositoryInterface $orders
     */
    public function handle(OrderRepositoryInterface $orders)
    {
        $tax = $orders
            ->newQuery()
            ->where('created_at', '>=', date('Y-m-d H:i:s', strtotime('-30 days')))
            ->where('created_at', '<=', date('Y-m-d H:i:s'))
            ->where('orders_orders.status', 'complete')
            ->sum('tax');

        $this->widget->addData('tax', $tax);
    }
}
