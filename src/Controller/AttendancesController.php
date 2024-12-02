<?php

namespace App\Controller;

use App\Controller\AppController;


class AttendancesController extends AppController
{


    public function initialize(): void
    {
        parent::initialize();
        $this->loadModel('Employees');
    }

    public function add() {}

    public function index() {}


    // public function addattendance($date = null)
    // {
    //     if ($date) {
    //         $this->Flash->success(__($date));
    //     }

    //     if ($this->request->is(['patch', 'post', 'put'])) {
    //         $data = $this->request->getData();
    //         $status = $data['status'];
    //         $empId = null;
    //         $empStatus = null;
    //         foreach ($status as $employeeId => $employeeStatus) {
    //             $empId = $employeeId;
    //             $empStatus = $employeeStatus;
    //         }

    //         $existAttendance = $this->Attendances->find()
    //             ->where(['employee_id' => $empId, 'date' => $date])
    //             ->first();

    //         if ($existAttendance) {
    //             $existAttendance->status = $employeeStatus;
    //             if ($this->Attendances->save($existAttendance)) {
    //                 $this->Flash->success(__('Attendance updated for employee ' . $empId));
    //             } else {
    //                 $this->Flash->error(__('Not Able to update attendance for employee ' . $empId));
    //             }
    //         } else {
    //             $newAttendance = $this->Attendances->newEntity();
    //             $addAttendance = ['employee_id' => $empId, 'status' => $empStatus, 'date' => $date];
    //             $newAttendance = $this->Attendances->patchEntity($newAttendance, $addAttendance);
    //             if ($this->Attendances->save($newAttendance)) {
                     
    //             } else {
    //                 $this->Flash->error(__('Unable to add attendance for employee ' . $empId));
    //             }
    //         }
    //     }

    //     $employees = $this->paginate(
    //         $this->Employees->find()
    //             ->where(['Employees.joining_date <=' => $date])
    //             ->contain([
    //                 'Attendances' => function ($q) use ($date) {
    //                     return $q->select(['status', 'date', 'employee_id'])
    //                         ->where(['Attendances.date' => $date]);
    //                 }
    //             ])
    //     );


    //     $this->set(compact('employees'));
    //     $this->set('date', $date);
    // }

    

    public function showattendancedata($date = null)
    {
        $attendances = $this->Employees->find()
            ->where(['Employees.joining_date <=' => $date])
            ->contain([
                'Attendances' => function ($q) use ($date) {
                    return $q->select(['status', 'date', 'employee_id'])
                        ->where(['Attendances.date LIKE' => $date . '%'])
                        ->order(['Attendances.date' => 'ASC']);
                }
            ]);


        $attenData = $attendances->enableHydration(false)->toArray();


        $this->set(compact('attendances'));
        $this->set('date', $date);
    }
}
