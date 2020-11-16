<?php
class Questions_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_questions($slug = FALSE)
    {
        if ($slug === FALSE) {
            $query = $this->db->get('question');
            return $query->result_array();
        }
        //slug+1 maybe to increment through the questions in the database
        $query = $this->db->get_where('question', array('slug' =>
        $slug));

        // return $query->row();
        return $query->row_array();
    }

    public function get_anwsers($id = FALSE)
    {
        if ($id === FALSE) {
            return "get anwsers id = FALSE";
        }
        $query = $this->db->get_where('answer', array('question_id' =>
        $id));

        // return $query->row();
        return $query->row_array();
    }

    public function get_url()
    {
        $uri = $_SERVER['REQUEST_URI'];
        echo $uri; // Outputs: URI

        $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

        return $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    }

    public function save_answer($answer, $userId, $questionId)
    {
        return $this->db->insert('user_answer', $answer, $userId, $questionId);
    }
    public function test($id)
    {
        // $this->db->set($id);
        if ($this->input->POST('id') == NULL) {
            echo "id is null";
        }
        else{
            $data = array(
                'id' => $id,
                'input' => $this->input->post('id')
    
            );
            return $this->db->insert('test', $data);
        }
        
    }

    public function register($enc_password)
    {
        // $this->load->database();
        //get the email the user entered in the register page
       
        $data = array(
            'email' => $this->input->post('id'),
            'password' => $enc_password
        );

        return $this->db->insert('user', $data);
    }
}
