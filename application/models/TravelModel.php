<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TravelModel extends CI_Model
{
    public function getUserInfo($data)
    {
        $this->db->from('user');
        $this->db->where(['fullname' => $data['fullname']]);
        return $this->db->get()->row_array();
    }

    public function addForm($tra_no)
    {
        if ($this->input->post('transport') == "air") {
            $transAir = $this->input->post('air_trans');
        } elseif ($this->input->post('transport') == "road") {
            $transRoad = $this->input->post('road_trans');
        } elseif ($this->input->post('transport') == "rail") {
            $transRail = $this->input->post('rail_trans');
        } elseif ($this->input->post('transport') == "sea") {
            $transSea = $this->input->post('sea_trans');
        } else {
            echo "Error!";
        }

        $travelForm = [
            'tra_no' => $tra_no,
            'staff_id' => $this->input->post('staffid'),
            'fullname' => $this->input->post('fullname'),
            'approver' => $this->input->post('approveHOD'),
            'purpose' => strtoupper($this->input->post('purpose')),
            'depart_route' => strtoupper($this->input->post('dep_route')),
            'return_route' => strtoupper($this->input->post('ret_route')),
            'trans_type' => strtoupper($this->input->post('transport')),
            'air' => $transAir,
            'road' => $transRoad,
            'rail' => $transRail,
            'sea' => $transSea,
            'depart_date' => strtotime(str_replace('/', '-', $this->input->post('dep_date'))),
            'return_date' => strtotime(str_replace('/', '-', $this->input->post('ret_date'))),
            'depart_time' => strtotime(str_replace('/', '-', $this->input->post('dep_time'))),
            'return_time' => strtotime(str_replace('/', '-', $this->input->post('ret_time'))),
            'accomodation' => $this->input->post('accomodation'),
            'remark' => $this->input->post('accom_rem'),
            'date_created' => time(),
        ];
        $this->db->insert('travel', $travelForm);
    }

    public function editForm($t_id)
    {
        if ($this->input->post('transport') == "air") {
            $transAir = $this->input->post('air_trans');
        } elseif ($this->input->post('transport') == "road") {
            $transRoad = $this->input->post('road_trans');
        } elseif ($this->input->post('transport') == "rail") {
            $transRail = $this->input->post('rail_trans');
        } elseif ($this->input->post('transport') == "sea") {
            $transSea = $this->input->post('sea_trans');
        } else {
            echo "Error!";
        }

        $travelEdit = [
            'purpose' => strtoupper($this->input->post('purpose')),
            'depart_route' => strtoupper($this->input->post('dep_route')),
            'return_route' => strtoupper($this->input->post('ret_route')),
            'trans_type' => strtoupper($this->input->post('transport')),
            'air' => $transAir,
            'road' => $transRoad,
            'rail' => $transRail,
            'sea' => $transSea,
            'depart_date' => strtotime(str_replace('/', '-', $this->input->post('dep_date'))),
            'return_date' => strtotime(str_replace('/', '-', $this->input->post('ret_date'))),
            'depart_time' => strtotime(str_replace('/', '-', $this->input->post('dep_time'))),
            'return_time' => strtotime(str_replace('/', '-', $this->input->post('ret_time'))),
            'accomodation' => $this->input->post('accomodation'),
            'remark' => $this->input->post('accom_rem'),
        ];
        $this->db->where('t_id', $t_id);
        $this->db->update('travel', $travelEdit);
    }

    public function getTravelData($t_id)
    {
        $this->db->from('travel');
        $this->db->where(['t_id' => $t_id]);
        return $this->db->get()->row_array();
    }

    // public function getTravelAdmin()
    // {
    //     $this->db->from('travel');
    //     $this->db->join('user', 'user.username = travel.fullname');
    //     $this->db->order_by('t_id', "DESC");
    //     return $this->db->get()->result_array();
    // } 

    // public function getTravelUser($data)
    // {
    //     $this->db->from('travel');
    //     $this->db->join('user', 'user.username = travel.fullname');
    //     $this->db->where(['fullname' => $data['fullname']]);
    //     $this->db->order_by('t_id', "DESC");
    //     return $this->db->get()->result_array();
    // }

    public function approveTravelHOD($t_id)
    {
        $statusUpdate = [
            'status' => '1',
            'remark_hod' => $this->input->post('feedback'),
            'date_hod_appr' => time(),
        ];
        $this->db->where('t_id', $t_id);
        $this->db->update('travel', $statusUpdate);
    }

    public function approveTravelED($t_id)
    {
        $statusUpdate = [
            'status' => '2',
            'remark_ed' => $this->input->post('feedback'),
            'date_ed_appr' => time(),
        ];
        $this->db->where('t_id', $t_id);
        $this->db->update('travel', $statusUpdate);
    }

    public function submitItinerary($travelID)
    {
        $travelUpdate = [
            'totalcost' => $this->input->post('cost'),
            'supp_status' => '1',
            'supp_date' => time(),
        ];

        $this->db->where('t_id', $travelID);
        $this->db->update('travel', $travelUpdate);
    }
}
