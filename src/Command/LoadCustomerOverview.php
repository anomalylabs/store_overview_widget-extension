<?php namespace Anomaly\StoreOverviewWidgetExtension\Command;

use Anomaly\CustomersModule\Customer\Contract\CustomerRepositoryInterface;
use Anomaly\DashboardModule\Widget\Contract\WidgetInterface;


/**
 * Class LoadCustomerOverview
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\StoreOverviewWidgetExtension\Command
 */
class LoadCustomerOverview
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
     * @param CustomerRepositoryInterface $customers
     */
    public function handle(CustomerRepositoryInterface $customers)
    {
        $customers = $customers
            ->newQuery()
            ->where('created_at', '>=', date('Y-m-d H:i:s', strtotime('-30 days')))
            ->where('created_at', '<=', date('Y-m-d H:i:s'))
            ->count();

        $this->widget->addData('customers', $customers);
    }
}
