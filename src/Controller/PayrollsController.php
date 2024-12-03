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
    
    
            $this->set(compact('totPRE', 'totABS', 'totLEV'));
            
//Send employee data
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
}
