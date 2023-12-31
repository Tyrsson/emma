<?php

declare(strict_types=1);

namespace User;

use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'user' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '[/user[/:action[/:id]]]',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]*',
                    ],
                ],
            ],
        ],

    ],
    'service_manager' => [
        'factories' => [
            Db\UserModel::class    => InvokableFactory::class,
            Db\TableGateway::class => Db\Factory\TableGatewayFactory::class,
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => Controller\Factory\IndexControllerFactory::class,
        ],
    ],
    'form_elements'      => [
        'factories' => [
            Form\Fieldset\AcctDataFieldset::class    => Form\Fieldset\Factory\AcctDataFieldsetFactory::class,
            Form\Fieldset\LoginFieldset::class       => Form\Fieldset\Factory\LoginFieldsetFactory::class,
            Form\Fieldset\PasswordFieldset::class    => Form\Fieldset\Factory\PasswordFieldsetFactory::class,
            Form\UserForm::class                     => Form\Factory\UserFormFactory::class,
            Form\Grid::class                         => Form\Factory\GridFactory::class,
            Form\Fieldset\Grid::class                => Form\Fieldset\Factory\GridFactory::class,
            Form\EditUserForm::class                 => Form\Factory\EditUserFormFactory::class,
            Form\Fieldset\EditUserFieldset::class    => Form\Fieldset\Factory\EditUserFieldsetFactory::class,
        ],
    ],
    'navigation' => [
        'default' => [
            [
                'label' => 'User List',
                'uri' => '/user',
                'class' => 'nav-link',
                //'action' => 'index',
            ],
            [
                'label' => 'Create User',
                'uri' => '/user/create',
                'class' => 'nav-link',
                //'action' => 'create',
            ],
        ],
    ],
    'view_manager' => [
        'template_path_stack'      => [
            __DIR__ . '/../view',
        ],
    ],
];