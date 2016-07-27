<?php namespace Anomaly\StoreOverviewWidgetExtension\Command;

use Anomaly\DashboardModule\Widget\Contract\WidgetInterface;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class LoadStoreOverview
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\StoreOverviewWidgetExtension\Command
 */
class LoadStoreOverview implements SelfHandling
{

    use DispatchesJobs;

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

        $this->dispatch(new LoadTaxOverview($this->widget));
        $this->dispatch(new LoadOrdersOverview($this->widget));
        $this->dispatch(new LoadRevenueOverview($this->widget));
        $this->dispatch(new LoadShippingOverview($this->widget));
        $this->dispatch(new LoadProductsOverview($this->widget));
        $this->dispatch(new LoadCustomerOverview($this->widget));

        $this->dispatch(new CalculateUnitPrice($this->widget));
        $this->dispatch(new CalculateOrderTotal($this->widget));
    }
}
