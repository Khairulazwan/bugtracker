<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bugmodel extends CI_Model
{
    public function getUserInfo($data)
    {
        $this->db->from('user');
        $this->db->where(['fullname' => $data['fullname']]);
        return $this->db->get()->row_array();
    }

    public function addForm($bug_no)
    {
        $bugForm = [
            'bug_no' => $bug_no,
            'fullname' => $this->input->post('reporter'),
            'bug_description' => strtoupper($this->input->post('bug_desc')),
            'create_date' => $this->input->post('rep_date'),
            'status' => '0',
            'progress' => '0',
        ];
        $this->db->insert('report', $bugForm);
    }

    public function getBugUser($data)
    {
        $this->db->from('report');
        $this->db->join('user', 'user.fullname = report.fullname');
        $this->db->where(['report.fullname' => $data['fullname']]);
        $this->db->order_by('b_id', "DESC");
        return $this->db->get()->result_array();
    }

    public function getBugAdmin()
    {
        $this->db->from('report');
        $this->db->join('user', 'user.fullname = report.fullname');
        $this->db->order_by('b_id', "DESC");
        return $this->db->get()->result_array();
    }

    public function assignExpert($b_id, $as_date)
    {
        $assignUpdate = [
            'status' => '1',
            'progress' => '1',
            'bug_type' => $this->input->post('severity'),
            'expertist' => $this->input->post('expertist'),
            'date_assign' => $as_date,
        ];
        $this->db->where('b_id', $b_id);
        $this->db->update('report', $assignUpdate);
    }

    public function getBugExpert($data)
    {
        $this->db->from('report');
        $this->db->join('user', 'user.fullname = report.fullname');
        $this->db->where(['report.expertist' => $data['fullname']]);
        $this->db->order_by('b_id', "DESC");
        return $this->db->get()->result_array();
    }

    public function statusUpdate($b_id, $com_date)
    {
        $statUpdate = [
            'progress' => $this->input->post('progress'),
            'date_complete' => $com_date,
        ];
        $this->db->where('b_id', $b_id);
        $this->db->update('report', $statUpdate);
    }
}
