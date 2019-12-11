<?php

class OrderHooks extends Module
{
    public function __construct()
    {
        $this->name = 'orderhooks';
        $this->version = '1.0.0';
        $this->need_instance = 0;

        parent::__construct();

        $this->displayName = 'Demo for new hooks in Edit an Order page usage';
        $this->description = 'This module hooks itself in all available hooks of migrated Order page to display how they can be used';
        $this->ps_versions_compliancy = [
            'min' => '1.7.7.0',
            'max' => _PS_VERSION_,
        ];
    }

    public function install()
    {
        return parent::install() &&
            $this->registerHook('displayBackOfficeOrderActions') &&

            $this->registerHook('displayAdminOrderContentOrder') &&
            $this->registerHook('displayAdminOrderTabContent') &&

            $this->registerHook('displayAdminOrderTabLink') &&

            $this->registerHook('displayAdminOrderMain') &&
            $this->registerHook('displayAdminOrderSide') &&

            $this->registerHook('displayAdminOrder') &&
            $this->registerHook('displayAdminOrderTop') &&

            $this->registerHook('actionGetAdminOrderButtons');
    }

    public function hookDisplayBackOfficeOrderActions(array $params)
    {
        $this->context->smarty->assign([
            'order_id' => $params['id_order'],
        ]);

        return $this->context->smarty->fetch($this->getLocalPath() . 'views/templates/displayBackOfficeOrderActions.tpl');
    }

    public function hookActionGetAdminOrderButtons(array $params)
    {
        /** @var \PrestaShopBundle\Controller\Admin\Sell\Order\ActionsBarButtonsCollection $bar */
        $bar = $params['actions_bar_buttons_collection'];

        $bar->add(
            new \PrestaShopBundle\Controller\Admin\Sell\Order\ActionsBarButton(
                'btn-warning', ['href' => '/a/b'], 'Link button'
            )
        );

        $bar->add(
            new \PrestaShopBundle\Controller\Admin\Sell\Order\ActionsBarButton(
                'btn-primary', ['href' => '/a/b'], 'Export to my ERP'
            )
        );

        if (rand(1, 2) === 1) {

            $bar->add(
                new \PrestaShopBundle\Controller\Admin\Sell\Order\ActionsBarButton(
                    'btn-secondary', ['href' => '/a/b'], 'Do something else'
                )
            );
            $bar->add(
                new \PrestaShopBundle\Controller\Admin\Sell\Order\ActionsBarButton(
                    'btn-action', ['href' => '/a/b'],
                    '<i class="material-icons form-error-icon">more_horiz</i> More'
                )
            );
        }
    }

    public function hookDisplayAdminOrderTop(array $params)
    {
        $this->context->smarty->assign([
            'order_id' => $params['id_order'],
        ]);

        return $this->context->smarty->fetch($this->getLocalPath() . 'views/templates/displayAdminOrderTop.tpl');
    }


    public function hookDisplayAdminOrder(array $params)
    {
        $this->context->smarty->assign([
            'order_id' => $params['id_order'],
        ]);

        return $this->context->smarty->fetch($this->getLocalPath() . 'views/templates/displayAdminOrder.tpl');
    }

    public function hookDisplayAdminOrderMain(array $params)
    {
        $this->context->smarty->assign([
            'order_id' => $params['id_order'],
        ]);

        return $this->context->smarty->fetch($this->getLocalPath() . 'views/templates/displayAdminOrderLeft.tpl');
    }

    public function hookDisplayAdminOrderSide(array $params)
    {
        $this->context->smarty->assign([
            'order_id' => $params['id_order'],
        ]);

        return $this->context->smarty->fetch($this->getLocalPath() . 'views/templates/displayAdminOrderRight.tpl');
    }

    public function hookDisplayAdminOrderTabLink(array $params)
    {
        return $this->context->smarty->fetch($this->getLocalPath() . 'views/templates/displayAdminOrderTabLink.tpl');
    }

    public function hookDisplayAdminOrderTabContent(array $params)
    {
        return $this->context->smarty->fetch($this->getLocalPath() . 'views/templates/displayAdminOrderTabContent.tpl');
    }
}
