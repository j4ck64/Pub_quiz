<?php
class Questions extends CI_Controller
{
    public function index()
    {
        //Check user is logged in 
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        // $month = $this->input->post('question_id');
        // if (is_null($month)) {
        //     echo 'This is ' . $month;
        // } else {
        //     echo 'Nothing';
        // }
        // $test_var = $this->input->get('question_id');
        // print_r($test_var);



        $name = $this->input->get('anwser-a');
        print_r('testing' . $name);



        $data['title'] = 'testing';

        $data['question'] = $this->Questions_model->get_questions('q-1');
        // print_r($data['question']['id']);     
        //    echo '<br/>';

        // print('count'.count($data['question']));

        //check if their is  more than 1 question
        if (count($data['question']) > 1) {

            $data['slug'] = 'q-2';
        } else {
            $data['slug'] = 'result';
        }

        // print_r($this->Questions_model->get_url());
        $data['anwsers'] = $this->Questions_model->get_anwsers($data['question']['id']);
        // print_r($data['anwsers']);

        $this->load->view('questions/index', $data);
        $this->load->view('templates/header');
        // loads the corresponding posts view
        $this->load->view('templates/footer');
    }

    public function save()
    {
        $data = $this->input->post('data');
        $id = $this->input->post('data');
        // if (is_numeric($question_id)) {
        //     echo $question_id;
        // }
        echo $id;
        print_r('question_id' . $id);
        $user_Id = $this->session->userdata('id');

        $answer = $this->input->post('answer');
        print_r($id . $user_Id . $answer);
        $this->Questions_model->test($id);
       // $this->Questions_model->save_answer($answer, $user_Id, $question_id);
        $this->load->view('templates/header');
        $this->load->view('questions/save', $data);
        // loads the corresponding posts view
        $this->load->view('templates/footer');
    }

    public function view($slug = NULL)
    {
        //Check user is logged in 
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        if ($slug != null) {
            $data['question'] = $this->Questions_model->get_questions($slug);
            //remove 'q-'
            $slug = str_replace("q-", "", $slug);
            // check if there's another question if not set the slug to next page
            if ($slug + 1 > count($data['question'])) {
                $data['slug'] = $slug + 1;
            } else {
                $data['slug'] = 'result';
            }
            $data['anwsers'] = $this->Questions_model->get_anwsers($data['question']['id']);


            $this->load->view('questions/index', $data);
            $this->load->view('templates/header');
            // loads the corresponding posts view
            $this->load->view('templates/footer');
        }
    }

    public function result()
    {
        $this->load->view('templates/header');
        // loads the corresponding posts view
        $this->load->view('templates/footer');
    }
}
