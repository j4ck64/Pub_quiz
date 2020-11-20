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
    // saves the user answer 
    public function save_answer($userId)
    {
        if ($this->input->POST('id') == NULL) {
            return "id is null";
        } else {
            $data = array(
                'answer' => $this->input->post('anwser'),
                'user_id' => $userId,
                'question_id' => $this->input->post('id')
            );
            if ($this->db->insert('user_answer', $data)) {
                return "data inserted";
            } else {
                return "data not inserted";
            }
        }
    }
    // returns the users results based on the userid
    public function get_results($userId)
    {
        //$userId = $this->session->userdata('user_id');
        $this->db->select("answer.answer, user_answer.answer as 'user_answer', question.question, question.id");
        $this->db->from('user_answer');
        $this->db->join('question', "user_answer.question_id = question.id");
        $this->db->join('answer', 'answer.question_id = question.id');
        $this->db->where("user_answer.user_id='$userId'");
        $query = $this->db->get();
        $arr = $query->result();

        $newArray = array();
        $index = 0;
        for ($index2 = 1; $index2 <= count($arr); $index2++) {

            print_r('checking second loop is looping index : ' . count($arr) . $index . " index 2: " . $index2);
            echo '<br/>';
            echo '<br/>';

            $row = array(
                'id' => $arr[$index]->id,
                'question' =>  $arr[$index]->question,
                'user_answer' => $arr[$index]->user_answer,
                'answer' => $arr[$index]->answer,
            );
            if ($index2 == count($arr)) {
                print_r('adding to array: [id->' . $arr[$index]->id . ' question->' .  $arr[$index]->question . ' user_anwser->' . $arr[$index]->user_answer . ' anwser->' . $arr[$index]->answer . ']' . $index . " index 2: " . $index2);
                echo '<br/>';
                echo '<br/>';
                array_push($newArray, $row);
                break;
            }
            //ifquestion id  notequal to question id +1 and 
            else if ($arr[$index]->id != $arr[$index2]->id) {
                print_r("question id  notequal to question id +1");
                echo '<br/>';

                if ($arr[$index]->question !== $arr[$index2]->question) {
                    print_r('adding to array: [id->' . $arr[$index]->id . ' question->' .  $arr[$index]->question . ' user_anwser->' . $arr[$index]->user_answer . ' anwser->' . $arr[$index]->answer . ']' . $index . " index 2: " . $index2);
                    echo '<br/>';
                    echo '<br/>';
                    array_push($newArray, $row);
                }
            }
            $index++;
            print_r($index);
        }
        //print_r($newArray);
        // $object = (object) $newArray;

        
        //the line below is taken from https://stackoverflow.com/a/1869147
        //this is converting the array into an object
        $object = json_decode(json_encode($newArray), FALSE);
        print_r($object);
        return $object;
        // SQL statement  
        //    "SELECT
        //     a.answer,
        //     u.answer as 'user_answer',
        //     q.question
        // FROM
        //     `user_answer` u
        // JOIN `question` q ON
        //     u.question_id = q.id
        // JOIN `answer` a ON
        //     a.question_id = q.id
        // WHERE
        //     u.user_id ='?'
    }
}
