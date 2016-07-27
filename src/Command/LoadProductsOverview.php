<?php namespace Anomaly\StoreOverviewWidgetExtension\Command;

use Anomaly\DashboardModule\Widget\Contract\WidgetInterface;
use Anomaly\OrdersModule\Order\Contract\OrderRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;

/**
 * Class LoadProductsOverview
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\StoreOverviewWidgetExtension\Command
 */
class LoadProductsOverview implements SelfHandling
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
        $products = $orders
            ->newQuery()
            ->join('orders_items', 'orders_items.order_id', '=', 'orders_orders.id')
            ->where('orders_orders.created_at', '>=', date('Y-m-d H:i:s', strtotime('-30 days')))
            ->where('orders_orders.created_at', '<=', date('Y-m-d H:i:s'))
            ->where('orders_orders.status', 'complete')
            ->sum('orders_items.quantity');

        $this->widget->addData('products', $products);
    }
}
