<?php namespace Anomaly\StoreOverviewWidgetExtension\Command;

use Anomaly\DashboardModule\Widget\Contract\WidgetInterface;
use Anomaly\OrdersModule\Order\Contract\OrderRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;

/**
 * Class LoadRevenueOverview
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\StoreOverviewWidgetExtension\Command
 */
class LoadRevenueOverview implements SelfHandling
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
        $revenue = $orders
            ->newQuery()
            ->where('created_at', '>=', date('Y-m-d H:i:s', strtotime('-30 days')))
            ->where('created_at', '<=', date('Y-m-d H:i:s'))
            ->where('status', 'complete')
            ->sum('total');

        $this->widget->addData('revenue', $revenue);
    }
}
