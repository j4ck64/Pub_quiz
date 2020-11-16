<?php
class Pages extends CI_Controller
{
    public function View($page = 'home')
    {
        if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
            show_404();
        }

        $data['title'] = ucfirst($page);

        $this->load->view('pages/' . $page, $data);
        // save page inside the header
        $this->load->view('templates/header');
        // loads the corresponding posts view
        $this->load->view('templates/footer');
    }
}
