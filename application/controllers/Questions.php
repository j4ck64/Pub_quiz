<?php
class Questions extends CI_Controller
{
    public function index()
    {
        //Check user is logged in 
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }
        $data['question'] = $this->Questions_model->get_questions('q-1');
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
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }
        print_r($this->session->userdata('user_id'));
        $data['questions'] = $this->Questions_model->get_results($this->session->userdata('user_id'));
        $this->load->view('templates/header');
        $this->load->view('questions/result', $data);
        // loads the corresponding posts view
        $this->load->view('templates/footer');
    }

    public function delete_question(){
        $id = $this->input->get("id");
        $slug= $this->input->get("slug");

        $this->Questions_model->delete_question($id);
        print_r('question deleted id:'.$id." slug: ".$slug);
        // redirect($_SERVER['HTTP_REFERER']);
    }

    public function browse(){
        $data['title']="Edit Questions";
        $data['questions'] = $this->Questions_model->get_questions();

        if($this->delete_question()){
            //  redirect($_SERVER['HTTP_REFERER']);  
        }
        
        
        $this->load->view('templates/header');
        $this->load->view('questions/browse', $data);
        // loads the corresponding posts view
        $this->load->view('templates/footer');
    }

    

    public function edit($slug=null){
        $data['title']="Edit Questions";
        $data['questions'] = $this->Questions_model->get_questions($slug);

        $id = $this->input->get('id');
        $this->Questions_model->delete_question($id);
        // redirect($_SERVER['HTTP_REFERER']);  

        $this->load->view('templates/header');
        $this->load->view('questions/edit', $data);
        // loads the corresponding posts view
        $this->load->view('templates/footer');
    }
}
