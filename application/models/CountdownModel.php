<?php

class CountdownModel extends CI_Model
{
    // protected $table = 'countdown';
    // protected $primaryKey = 'id_kode_users';
    // protected $allowedFields = ['id_kode_users', 'remaining_duration'];

    public $id_kode_users;
    public $remaining_duration;

    public function getCountdown($id = false)
    {
        $this->load->database();
        if ($id == false) {
            return $this->db->get('countdown')->result();
        }
        $query = $this->db->select('remaining_duration')
            ->where('id_kode_users', $id)
            ->get('countdown');

        $result = $query->row_array();

        return empty($result) ? 0 : $result['remaining_duration'];
    }
    public function saveRemainingDuration($idKodeUsers, $remainingDuration)
    {
        $this->load->database();
        $this->db->where('id_kode_users', $idKodeUsers);
        $query = $this->db->get('countdown');
        $existingRow = $query->row();

        if ($existingRow) {
            $this->db->where('id_kode_users', $idKodeUsers);
            $this->db->update('countdown', [
                'remaining_duration' => $remainingDuration
            ]);
        } else {
            $this->db->insert('countdown', [
                'id_kode_users' => $idKodeUsers,
                'remaining_duration' => $remainingDuration
            ]);
        }
    }
}
