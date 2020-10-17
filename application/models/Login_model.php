<?php
class Login_model extends CI_Model {

    public function edit_option_md5($action, $id, $table)
    {
        $this->db->where('md5(id)',$id);
        $this->db->update($table,$action);
        return;
    }

    //verify email with verification code
	public function verify_email($user_id, $code)
    {
        $this->db->select();
        $this->db->from('user');
        $this->db->where('md5(id)',$user_id);
        $this->db->where('email_verify_code',$code);
        $this->db->query('SET SQL_BIG_SELECTS=1'); 
        $query = $this->db->get();
        $query = $query->num_rows();  
        return $query;
    }

    //-- check post email
    public function check_email($email)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('email', $email); 
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() == 1) {                 
            return $query->result();
        }else{
            return false;
        }
    }

    //-- check post email
    public function check_admin_email($email)
    {
        $this->db->select('*');
        $this->db->from('admin');
        $this->db->where('email', $email); 
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() == 1) {                 
            return $query->result();
        }else{
            return false;
        }
    }

    // check valid user by id
    public function validate_id($id)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('md5(id)', $id); 
        $this->db->limit(1);
        $query = $this->db->get();
        if($query -> num_rows() == 1){                 
            return $query->result();
        }
        else{
            return false;
        }
    }

    // check valid user by id
    public function validate_admin_id($id)
    {
        $this->db->select('*');
        $this->db->from('admin');
        $this->db->where('md5(id)', $id); 
        $this->db->limit(1);
        $query = $this->db->get();
        if($query -> num_rows() == 1){                 
            return $query->result();
        }
        else{
            return false;
        }
    }

    //-- check valid user
    function validate_user()
    {            
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('email', $this->input->post('user_name')); 
        $this->db->where('password', md5($this->input->post('password')));
        $this->db->limit(1);
        $query = $this->db->get();   
        
        if($query->num_rows() == 1){                 
           return $query->result();
        }
        else{
            return false;
        }
    }

    function validate_admin(){            
        
        $this->db->select('*');
        $this->db->from('admin');
        $this->db->where('email', $this->input->post('email')); 
        $this->db->where('password', md5($this->input->post('password')));
        $this->db->limit(1);
        $query = $this->db->get();   
        
        if($query->num_rows() == 1){                 
           return $query->result();
        }
        else{
            return false;
        }
   }



}