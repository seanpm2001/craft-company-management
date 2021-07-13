<?php

namespace percipiolondon\companymanagement\gql\queries;

use jamesedmonston\graphqlauthentication\GraphqlAuthentication;
use percipiolondon\companymanagement\CompanyManagement;
use percipiolondon\companymanagement\gql\arguments\elements\Company as CompanyArguments;
use percipiolondon\companymanagement\gql\interfaces\elements\Company as CompanyInterface;
use percipiolondon\companymanagement\gql\resolvers\elements\Company as CompanyResolver;
use percipiolondon\companymanagement\gql\arguments\Employee as EmployeeArguments;
use percipiolondon\companymanagement\gql\interfaces\Employee as EmployeeInterface;
use percipiolondon\companymanagement\gql\resolvers\Employee as EmployeeResolver;
use percipiolondon\companymanagement\helpers\Gql as GqlHelper;

use Craft;
use craft\gql\base\Query;
use GraphQL\Type\Definition\Type;

/**
 * Class Company
 *
 * @author Percipio Global Ltd. <support@percipio.london>
 * @since 1.0.0
 */
class Company extends Query {

    /**
     * @inheritdoc
     */
    public static function getQueries($checkToken = true): array
    {

        if ($checkToken && !GqlHelper::canQueryCompanies()) {
            return [];
        }

        return [
            'companies' => [
                'type' => Type::listOf(CompanyInterface::getType()),
                'args' => CompanyArguments::getArguments(),
                'resolve' => CompanyResolver::class . '::resolve',
                'description' => 'This query is used to query for companies.'
            ],
            'company' => [
                'type' => CompanyInterface::getType(),
                'args' => CompanyArguments::getArguments(),
                'resolve' => CompanyResolver::class . '::resolveOne',
                'description' => 'This query is used to query for a company.'
            ],
            'employee' => [
                'type' => EmployeeInterface::getType(),
                'args' => EmployeeArguments::getArguments(),
                'resolve' => EmployeeResolver::class . '::resolveOne',
                'description' => 'This query is used to query for a company user.'
            ],
        ];

    }

}
