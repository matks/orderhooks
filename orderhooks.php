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
            $this->registerHook('displayAdminOrderTabOrder') &&

            $this->registerHook('displayAdminOrderTabShip') &&
            $this->registerHook('displayAdminOrderContentShip') &&

            $this->registerHook('displayAdminOrderRight') &&
            $this->registerHook('displayAdminOrderLeft') &&
            $this->registerHook('displayAdminOrder') &&
            $this->registerHook('displayAdminOrderTop') &&
            $this->registerHook('actionGetBackOfficeOrderButtons');
    }

    public function hookDisplayBackOfficeOrderActions(array $params)
    {
        $this->context->smarty->assign([
            'order_id' => $params['id_order'],
        ]);

        return $this->context->smarty->fetch($this->getLocalPath() . 'views/templates/displayBackOfficeOrderActions.tpl');
    }

    public function hookActionGetBackOfficeOrderButtons(array $params)
    {
        /** @var \PrestaShopBundle\Controller\Admin\Sell\Order\ActionsBarButtonsCollection $bar */
        $bar = $params['actions_bar_buttons_collection'];

        $bar->addButton(
            new \PrestaShopBundle\Controller\Admin\Sell\Order\ActionsBarButton(
                'btn-warning', ['href' => '/a/b'], 'Link button'
            )
        );

        $bar->addButton(
            new \PrestaShopBundle\Controller\Admin\Sell\Order\ActionsBarButton(
                'btn-primary', ['href' => '/a/b'], 'Export to my ERP'
            )
        );
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

    public function hookDisplayAdminOrderLeft(array $params)
    {
        $this->context->smarty->assign([
            'order_id' => $params['id_order'],
        ]);

        return $this->context->smarty->fetch($this->getLocalPath() . 'views/templates/displayAdminOrderLeft.tpl');
    }

    public function hookDisplayAdminOrderRight(array $params)
    {
        $this->context->smarty->assign([
            'order_id' => $params['id_order'],
        ]);

        return $this->context->smarty->fetch($this->getLocalPath() . 'views/templates/displayAdminOrderRight.tpl');
    }

    public function hookDisplayAdminOrderTabShip(array $params)
    {
        return $this->context->smarty->fetch($this->getLocalPath() . 'views/templates/displayAdminOrderTabShip.tpl');
    }

    public function hookDisplayAdminOrderContentShip(array $params)
    {
        return $this->context->smarty->fetch($this->getLocalPath() . 'views/templates/displayAdminOrderContentShip.tpl');
    }

    public function hookDisplayAdminOrderTabOrder(array $params)
    {
        return $this->context->smarty->fetch($this->getLocalPath() . 'views/templates/displayAdminOrderTabOrder.tpl');
    }

    public function hookDisplayAdminOrderContentOrder(array $params)
    {
        return $this->context->smarty->fetch($this->getLocalPath() . 'views/templates/displayAdminOrderContentOrder.tpl');
    }
}
