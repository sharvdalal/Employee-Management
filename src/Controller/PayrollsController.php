<?php

namespace App\Controller;

use App\Controller\AppController;

class PayrollsController extends AppController
{

    public function initialize(): void
    {
        parent::initialize();
        $this->loadModel('Employees');
        $this->loadModel('Attendances');
        $this->loadModel('PayrollAdjustments');
    }

    public function index() {}


    public function add()
    {
        $departments = [
            'Leadership' => 'Leadership',
            'HR' => 'HR',
            'Marketing' => 'Marketing',
            'Sales' => 'Sales',
            'Finance' => 'Finance',
            'Support' => 'Support',
            'IT' => 'IT',
            'R&D' => 'R&D',
            'Operations' => 'Operations',
            'Legal' => 'Legal',
        ];

        $this->set(compact('departments'));

        if ($this->request->is(['post', 'put'])) {
            $data = $this->request->getData();
            $employee_id = (int) $data['employee_id'];
            $datetoFind = $data['year'] . '-' . $data['month'];
            $monthName = $this->getMonthName($data['month']);
            $payrollPresent = $this->Payrolls->find()
                ->where(['employee_id' => $employee_id, 'month' => $monthName, 'year' => $data['year'] ])->first();
                if ($payrollPresent) {
                    $payroll_id = $payrollPresent->id;
                    return $this->redirect(['action' => 'view', $employee_id, $payroll_id]);
                }
            $employeeData = $this->Employees->find()
                ->where(['Employees.id' => $employee_id])
                ->contain([
                    'Attendances' => function ($q) use ($datetoFind) {
                        return $q->where([
                            'Attendances.date LIKE' => $datetoFind . '%'
                        ]);
                    }
                ]);


            if (!$employeeData) {
                $this->Flash->error('No data found for the given employee.');
                return;
            }

            $employeeAttendanceArray = $employeeData->enableHydration(false)->toArray();

            if (empty($employeeAttendanceArray)) {
                $this->Flash->error('No attendance records found.');
                return;
            }

            $employeeAttendanceArray = $employeeAttendanceArray[0]["attendances"];


            $totWorkingDays = $this->getWorkingDays($datetoFind);
            $totPRE = 0;
            $totABS = 0;
            $totLEV = 0;

            foreach ($employeeAttendanceArray as $attenData) {
                if ($attenData["status"] == "present") $totPRE++;
                elseif ($attenData["status"] == "absent") $totABS++;
                elseif ($attenData["status"] == "leave") $totLEV++;
            }

            $employeeDataArray = $employeeData->enableHydration(false)->toArray();
            $this->set(compact('totPRE', 'totABS', 'totLEV', 'totWorkingDays', 'datetoFind', 'employeeData'));


            $this->render('add');
        }
    }






    public function fetchEmployees()
    {
        $this->autoRender = false;

        if ($this->request->is('ajax')) {
            $department = $this->request->getData('department');

            $employees = $this->Employees->find()
                ->where(['department' => $department,])
                ->toArray();

            return $this->response
                ->withStatus(200)
                ->withType('application/json')
                ->withStringBody(json_encode(['message' => 'Got Data Successfully', 'employees' => $employees]));
        }
    }


    public function calculateSalary()
    {
        $this->autoRender = false;
        if ($this->request->is('ajax')) {
            $adjustmentsJson = $this->request->getData('adjustments');
            $date = $this->request->getData('date');
            $employeeId = (int) $this->request->getData('id');
            $adjustments = json_decode($adjustmentsJson, true);

            list($year, $month) = explode('-', $date);
            $paymentDate = date('Y-m-d');

            $payroll = $this->Payrolls->newEntity();
            $payrollData = [
                'employee_id' => $employeeId,
                'month' => $this->getMonthName($month),
                'year' => $year,
                'payment_date' => $paymentDate
            ];
            $payroll = $this->Payrolls->patchEntity($payroll, $payrollData);


            if ($this->Payrolls->save($payroll)) {
                $payrollId = $payroll->id;

                $adjustmentsEntities = [];
                foreach ($adjustments as $adjustment) {
                    $adjustmentsEntities[] = $this->PayrollAdjustments->newEntity([
                        'payroll_id' => $payrollId,
                        'type' => $adjustment['type'],
                        'name' => $adjustment['description'],
                        'amount' => $adjustment['amount'],
                    ]);
                }

                if ($this->PayrollAdjustments->saveMany($adjustmentsEntities)) {
                    $this->response = $this->response->withStatus(200);
                    echo json_encode(['message' => 'Payroll and adjustments saved successfully.', 'payrollId' => $payrollId, 'employeeId' => $employeeId]);
                } else {
                    $this->response = $this->response->withStatus(500);
                    echo json_encode(['message' => 'Error saving adjustments.']);
                }
            } else {
                $this->response = $this->response->withStatus(500);
                echo json_encode(['message' => 'Error saving payroll.']);
            }
        }
    }


    public function view($employeeId, $payrollId)
    {
        
    }





    private function getWorkingDays($monthYear)
    {
        $this->autoRender = false;
        [$year, $month] = explode('-', $monthYear);
        $totalDays = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $workingDays = 0;
        for ($day = 1; $day <= $totalDays; $day++) {
            $dayOfWeek = date('w', strtotime("$year-$month-$day"));
            if ($dayOfWeek != 0) {
                $workingDays++;
            }
        }
        return $workingDays;
    }

    private function getMonthName($monthNumber)
    {
        $months = [
            "1" => "January",
            "2" => "February",
            "3" => "March",
            "4" => "April",
            "5" => "May",
            "6" => "June",
            "7" => "July",
            "8" => "August",
            "9" => "September",
            "10" => "October",
            "11" => "November",
            "12" => "December"
        ];

        return isset($months[$monthNumber]) ? $months[$monthNumber] : "Invalid month number";
    }
}
