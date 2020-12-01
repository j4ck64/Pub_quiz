<?php
class Questions_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_questions()
    {
        $query = $this->db->get('question');
        // $query->order_by("publish_date", "DESC");
        return $query->result_array();
    }
    //this is used to verify if the next page should redirect to a question or the result page
    public function check_next_question($slug)
    {
        //remove the q- and return the number
        $current_slug = str_replace("q-", "", $slug);
        //validate
        $this->db->select('*');
        $this->db->from('question');
        $this->db->order_by("slug", "ASC");
        $this->db->order_by("publish_date", "DESC");

        $query = $this->db->get();
        $result = $query->result_array();

        $count = count($result);
        $i = 0;

        foreach ($result as $row) {
            //if the row id equals the slug number i.e. the row number continue
            if ($row['slug'] == $slug) {
                //if $i +1 is equal to the row count return "result" setting slug to result
                if ($i + 1 == $count) {
                    return "result";
                } else {
                    //return the next iteration of the question slug to proceed to the next question
                    return $result[$i + 1]['slug'];
                }
            }
            $i++;
        }
    }

    public function get_question($slug = FALSE)
    {
        //slug+1 maybe to increment through the questions in the database
        $this->db->select('*');
        $this->db->from('question');
        //if the slug has a value then the where clause is executed
        if ($slug != FALSE) {
            $this->db->where("slug='$slug'");
        }
        $this->db->order_by("slug", "ASC");
        $this->db->order_by("publish_date", "DESC");


        $query = $this->db->get();
        $result = $query->result_array();
        // print_r($result);
        // if (count($result) > 1) {
        //     print_r('loop and return the first row');
        // }

        //return the latest question
        return $result[0];
    }

    public function update_question()
    {
        $data = array(
            'question' => trim($this->input->post('question'), " ")
        );
        //If array is not empty then proceed to execute query.
        //Else return. 
        if (!empty(trim($this->input->post('question'), " "))) {
            $this->db->where('id', $this->input->post('id'));
            return $this->db->update('question', $data);
        } else {
            return;
        }
    }

    public function insert_anwsers($question_id)
    {
        $data = array(
            'anwser' => trim($this->input->post('anwser'), " "),
            'dummy_anwser' => trim($this->input->post('dummy-anwser'), " "),
            'dummy_anwser2' => trim($this->input->post('dummy-anwser2'), " "),
            'dummy_anwser3' => trim($this->input->post('dummy-anwser3'), " "),
            'question_id' => $question_id
        );
        return $this->db->insert('anwser', $data);
    }

    public function get_last_question_index()
    {
        $this->db->select('*');
        $this->db->from('question');
        $query = $this->db->get();
        $result = $query->result_array();
        return $index = count($result);
        // $index = intval($index)-1;
        // // print_r($result[count($result)]['question_id']);
        // return intval($result[$index]['id']);
    }

    public function insert_question($id)
    {
        $next_row = $id + 1;
        $slug = 'q-' . $next_row;
        $data = array(
            'id' => $next_row,
            'question' => trim($this->input->post('question'), " "),
            'slug' => $slug,
            'publish_date' => date('Y-m-d H:i:s')
        );
        $insert_id = $this->db->insert('question', $data);
        echo $this->db->last_query();
        return $next_row;
    }


    public function update_anwsers()
    {
        //check if any of the inputs are string.empty
        //if they are don't include them in the query


        $array = array(
            'anwser' => trim($this->input->post('anwser'), " "),
            'dummy_anwser' => trim($this->input->post('dummy-anwser'), " "),
            'dummy_anwser2' => trim($this->input->post('dummy-anwser2'), " "),
            'dummy_anwser3' => trim($this->input->post('dummy-anwser3'), " "),
            'question_id' => $this->input->post('id')
        );
        //remove empty elements from array
        $data = array_filter($array);
        if (!empty($data)) {
            $this->db->where('question_id', $this->input->post('id'));
            return $this->db->update('anwser', $data);
        } else {
            return;
        }
    }

    public function delete_question()
    {
        $id = $this->input->get("id");
        $this->db->delete('user_anwser', array('question_id' => $id));
        $this->db->delete('anwser', array('question_id' => $id));
        $this->db->delete('question', array('id' => $id));
        return;
    }

    public function get_anwsers($id = FALSE)
    {
        if ($id === FALSE) {
            return "get anwsers id = FALSE";
        }
        $query = $this->db->get_where('anwser', array('question_id' =>
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
    // saves the user anwser 
    public function save_anwser($userId)
    {
        if ($this->input->POST('id') == NULL) {
            return "id is null";
        } else {
            $data = array(
                'anwser' => $this->input->post('anwser'),
                'user_id' => $userId,
                'question_id' => $this->input->post('id')
            );
            if ($this->db->insert('user_anwser', $data)) {
                return "data inserted";
            } else {
                return "data not inserted";
            }
        }
    }

    // returns the users results based on the userid
    public function get_results($userId)
    {
        //get the question ,user anwser, question anwser
        $this->db->select("anwser.anwser, user_anwser.anwser as 'user_anwser', question.question, question.id");
        $this->db->from('user_anwser');
        $this->db->join('question', "user_anwser.question_id = question.id");
        $this->db->join('anwser', 'anwser.question_id = question.id');
        $this->db->where("user_anwser.user_id='$userId'");
        $query = $this->db->get();
        $arr = $query->result();

        $newArray = array();
        $index = 0;
        // loop the array
        for ($index2 = 1; $index2 <= count($arr); $index2++) {

            print_r('checking second loop is looping index : ' . count($arr) . $index . " index 2: " . $index2);
            echo '<br/>';
            echo '<br/>';

            $row = array(
                'id' => $arr[$index]->id,
                'question' =>  $arr[$index]->question,
                'user_anwser' => $arr[$index]->user_anwser,
                'anwser' => $arr[$index]->anwser,
            );
            if ($index2 == count($arr)) {
                print_r('adding to array: [id->' . $arr[$index]->id . ' question->' .  $arr[$index]->question . ' user_anwser->' . $arr[$index]->user_anwser . ' anwser->' . $arr[$index]->anwser . ']' . $index . " index 2: " . $index2);
                echo '<br/>';
                echo '<br/>';
                array_push($newArray, $row);
                break;
            }
            //ifquestion id  notequal to question id +1(the next question) and 
            else if ($arr[$index]->id != $arr[$index2]->id) {
                print_r("question id  notequal to question id +1");
                echo '<br/>';

                if ($arr[$index]->question !== $arr[$index2]->question) {
                    print_r('adding to array: [id->' . $arr[$index]->id . ' question->' .  $arr[$index]->question . ' user_anwser->' . $arr[$index]->user_anwser . ' anwser->' . $arr[$index]->anwser . ']' . $index . " index 2: " . $index2);
                    echo '<br/>';
                    echo '<br/>';
                    array_push($newArray, $row);
                }
            }
            $index++;
            print_r($index);
        }
        //the line below is taken from https://stackoverflow.com/a/1869147
        //this is converting the array into an object
        $object = json_decode(json_encode($newArray), FALSE);
        print_r($object);
        return $object;
    }
}
