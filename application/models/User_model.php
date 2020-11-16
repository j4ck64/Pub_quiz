<?php
class User_model extends CI_Model
{
    public function register($enc_password)
    {
        // $this->load->database();
        //get the email the user entered in the register page
        $data = array(
            'email' => $this->input->post('email'),
            'password' => $enc_password
        );

        return $this->db->insert('user', $data);
    }

    // log in user
    public function login($email,$password){
        //validate
        $this->db->where('email',$email);
        $this->db->where('password',$password);

        $result =$this->db->get('user');

        if($result->num_rows()==1){
            return $result->row(0)->id;
        }else {
            return false;
        }
    }

    public function check_email_exists($email)
    {
        $query = $this->db->get_where('user', array(
            'email' => $email
        ));
        if (empty($query->row_array())) {
            return true;
        } else {
            return false;
        }
    }

}
