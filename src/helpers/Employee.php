<?php

namespace percipiolondon\companymanagement\helpers;

use craft\helpers\DateTimeHelper;
use craft\helpers\Db;
use percipiolondon\companymanagement\CompanyManagement;
use percipiolondon\companymanagement\elements\Company as CompanyModel;
use percipiolondon\companymanagement\elements\Employee as EmployeeModel;
use percipiolondon\companymanagement\records\Employee as EmployeeRecord;
use yii\web\NotFoundHttpException;
use yii\web\Request;
use Craft;

class Employee
{
    public static function employeeFromPost(Request $request = null): EmployeeModel
    {
        if ($request === null) {
            $request = Craft::$app->getRequest();
        }

        $employeeId = $request->getBodyParam('employeeId');

        if($employeeId) {
            $employee = EmployeeModel::findOne($employeeId);

            if (!$employee) {
                throw new NotFoundHttpException(Craft::t('company-management', 'No employee with the ID “{id}”', ['id' => $employeeId]));
            }
        }else {
            $employee = new EmployeeModel();
        }

        return $employee;
    }

    public static function populateEmployeeFromPost(EmployeeModel $employee = null, Request $request = null): EmployeeModel
    {
        if ($request === null) {
            $request = Craft::$app->getRequest();
        }

        if ($employee === null) {
            $employee = static::employeeFromPost($request);
        }

//        $employee->userId = $request->getBodyParam('userId') ?? $userId;
//        $employee->companyId = $request->getBodyParam('companyId') ?? $companyId;
        $employee->title = $request->getBodyParam('firstName'). ' ' .$request->getBodyParam('middleName').' '.$request->getBodyParam('lastName');
        $employee->slug = str_replace(" ", "_", strtolower($request->getBodyParam('firstName')).'-'.strtolower($request->getBodyParam('middleName')).'-'.strtolower($request->getBodyParam('lastName')));
        $employee->firstName = $request->getBodyParam('firstName');
        $employee->lastName = $request->getBodyParam('lastName');
        $employee->middleName = $request->getBodyParam('middleName');
        $employee->knownAs = $request->getBodyParam('knownAs');
        $employee->nameTitle = $request->getBodyParam('nameTitle');
        $employee->nationalInsuranceNumber = strtoupper(str_replace(' ', '', $request->getBodyParam('nationalInsuranceNumber') ?? $request->getBodyParam('contactRegistrationNumber') ?? ""));
        $employee->ethnicity = $request->getBodyParam('ethnicity');
        $employee->maritalStatus = $request->getBodyParam('maritalStatus');
        $employee->drivingLicense = $request->getBodyParam('drivingLicense');
        $employee->address = $request->getBodyParam('address');
        $employee->gender = $request->getBodyParam('gender');
        $employee->nationality = $request->getBodyParam('nationality');
        $employee->dateOfBirth = $request->getBodyParam('dateOfBirth') ? Db::prepareDateForDb($request->getBodyParam('dateOfBirth')) : false;
        $employee->joinDate = $request->getBodyParam('joinDate') ? Db::prepareDateForDb($request->getBodyParam('joinDate')) : false;
        $employee->endDate = $request->getBodyParam('endDate') ? Db::prepareDateForDb($request->getBodyParam('endDate')) : false;
        $employee->probationPeriod = $request->getBodyParam('probationPeriod');
        $employee->noticePeriod = $request->getBodyParam('noticePeriod');
        $employee->reference = $request->getBodyParam('reference');
        $employee->departmentId = $request->getBodyParam('departmentId');
        $employee->jobTitle = $request->getBodyParam('jobTitle');
        $employee->companyEmail = $request->getBodyParam('companyEmail');
        $employee->contractType = $request->getBodyParam('contractType');
        $employee->personalEmail = $request->getBodyParam('personalEmail');
        $employee->personalMobile = $request->getBodyParam('personalMobile');
        $employee->personalPhone = $request->getBodyParam('personalPhone');
        $employee->directDialingIn = $request->getBodyParam('directDialingIn');
        $employee->workMobile = $request->getBodyParam('workMobile');
        $employee->workExtension = $request->getBodyParam('workExtension');

        return $employee;
    }

    public static function populateEmployeeFromRecord(EmployeeRecord $employeeRecord, int $userId = null, int $companyId = null): EmployeeModel
    {
        $employee = new EmployeeModel();

//        $employee->userId = $employeeRecord->userId;
        $employee->companyId = $employeeRecord->companyId;
        $employee->title = $employeeRecord->title;
        $employee->slug = $employeeRecord->slug;
        $employee->firstName = $employeeRecord->firstName;
        $employee->lastName = $employeeRecord->lastName;
        $employee->middleName = $employeeRecord->middleName;
        $employee->knownAs = $employeeRecord->knownAs;
        $employee->nameTitle = $employeeRecord->nameTitle;
        $employee->nationalInsuranceNumber = $employeeRecord->nationalInsuranceNumber;
        $employee->ethnicity = $employeeRecord->ethnicity;
        $employee->maritalStatus = $employeeRecord->maritalStatus;
        $employee->drivingLicense = $employeeRecord->drivingLicense;
        $employee->address = $employeeRecord->address;
        $employee->gender = $employeeRecord->gender;
        $employee->nationality = $employeeRecord->nationality;
        $employee->dateOfBirth = $employeeRecord->dateOfBirth;
        $employee->joinDate = $employeeRecord->joinDate;
        $employee->endDate = $employeeRecord->endDate;
        $employee->probationPeriod = $employeeRecord->probationPeriod;
        $employee->noticePeriod = $employeeRecord->noticePeriod;
        $employee->reference = $employeeRecord->reference;
        $employee->departmentId = $employeeRecord->departmentId;
        $employee->jobTitle = $employeeRecord->jobTitle;
        $employee->companyEmail = $employeeRecord->companyEmail;
        $employee->contractType = $employeeRecord->contractType;
        $employee->personalEmail = $employeeRecord->personalEmail;
        $employee->personalMobile = $employeeRecord->personalMobile;
        $employee->personalPhone = $employeeRecord->personalPhone;
        $employee->directDialingIn = $employeeRecord->directDialingIn;
        $employee->workMobile = $employeeRecord->workMobile;
        $employee->workExtension = $employeeRecord->workExtension;

        return $employee;
    }
}
