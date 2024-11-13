<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

/**
 * @author : Tri Cahya Wibawa
 * @version : 1.0
 * @since : 11 Februari 2024
 */

class User extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('crud_model');
        $this->load->model('perizinan_model');
        $this->load->model('Izin_model');
        $this->load->model('izinHarian_model');
        $this->load->model('master_model');
        $this->load->model('pegawai_model');
        $this->isLoggedIn();   
    }
    
    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {
        $this->global['pageTitle'] = 'Admin Panel : Dashboard';

        $id = $this->global ['pegawai_id'];
        $role = $this->global ['role'];
        $loginType = $this->global ['loginType'];

        if ($role == ROLE_HRGA || $role == ROLE_POOL){
          $CountCuti = COUNT($this->perizinan_model->getData());
          $CountIzin = COUNT($this->Izin_model->getData());
          $CountIzinHarian = COUNT($this->izinHarian_model->getData());
          $CountTugas = COUNT($this->perizinan_model->getTugas());
        }else{
          $CountCuti = COUNT($this->perizinan_model->getDatabyApproval($id));
          $CountIzin = COUNT($this->Izin_model->getDatabyApproval($id));
          $CountIzinHarian = COUNT($this->izinHarian_model->getDatabyApproval($id));
          $CountTugas = COUNT($this->perizinan_model->getTugasbyApproval($id));
        }

        if($role == ROLE_MANAGER){
        $divisi = $this->crud_model->GetDataByWhere(['id_divisi !=' => '1','manager_id =' => $id],'tbl_divisi');
        $PegawaiAktif = $this->pegawai_model->showDataWhere('*',['manager_id' => $id,'status' => 'aktif'],NULL,NULL,NULL);
        $PegawaiNonAktif = $this->pegawai_model->showDataWhere('*',['manager_id' => $id,'status' => 'tidak'],NULL,NULL,NULL);
        $PenambahanKaryawan = $this->pegawai_model->showDataWhere('*',['manager_id' => $id,'year(tgl_masuk)' => DATE('Y')],NULL,NULL,NULL);
        $PenguranganKaryawan = $this->pegawai_model->showDataWhere('*', ['manager_id' => $id,'year(tgl_keluar)' => DATE('Y')],NULL,NULL,NULL);
        $penambahanKaryawanByDepartement = $this->pegawai_model->showDataWhere('*',['manager_id' => $id,'year(tgl_masuk)' => DATE('Y'),'status' => 'aktif'],NULL,NULL,'departement_id');
        $penguranganKaryawanByDepartement = $this->pegawai_model->showDataWhere('*',['manager_id' => $id,'year(tgl_keluar)' => DATE('Y'),'status' => 'tidak'],NULL,NULL,'departement_id');
        $penambahanKaryawanByDivisi = $this->pegawai_model->showDataWhere('*',['manager_id' => $id,'year(tgl_masuk)' => DATE('Y'),'status' => 'aktif'],NULL,NULL,'divisi_id');
        $penguranganKaryawanByDivisi = $this->pegawai_model->showDataWhere('*',['manager_id' => $id,'year(tgl_keluar)' => DATE('Y'),'status' => 'tidak'],NULL,NULL,'divisi_id');
        }else{
        $divisi = $this->crud_model->GetDataByWhere(['id_divisi !=' => '1'],'tbl_divisi');
        $PegawaiAktif = $this->crud_model->GetDataByWhere(['status' => 'aktif'],'tbl_pegawai');
        $PegawaiNonAktif = $this->crud_model->GetDataByWhere(['status' => 'tidak'],'tbl_pegawai');
        $PenambahanKaryawan = $this->crud_model->GetDataByWhere(['year(tgl_masuk)' => DATE('Y')],'tbl_pegawai');
        $PenguranganKaryawan = $this->crud_model->GetDataByWhere(['year(tgl_keluar)' => DATE('Y')],'tbl_pegawai');
        $penambahanKaryawanByDepartement = $this->pegawai_model->showDataWhere('*',['year(tgl_masuk)' => DATE('Y'),'status' => 'aktif'],NULL,NULL,'departement_id');
        $penguranganKaryawanByDepartement = $this->pegawai_model->showDataWhere('*',['year(tgl_keluar)' => DATE('Y'),'status' => 'tidak'],NULL,NULL,'departement_id');
        $penambahanKaryawanByDivisi = $this->pegawai_model->showDataWhere('*',['year(tgl_masuk)' => DATE('Y'),'status' => 'aktif'],NULL,NULL,'divisi_id');
        $penguranganKaryawanByDivisi = $this->pegawai_model->showDataWhere('*',['year(tgl_keluar)' => DATE('Y'),'status' => 'tidak'],NULL,NULL,'divisi_id');
        }


        $data = array(
            'CountDepartement' => COUNT($this->crud_model->lihatdata('tbl_departement')),
            'CountDivisi' => COUNT($divisi),
            'CountPegawaiAktif' => COUNT($PegawaiAktif),
            'CountPegawaiNonAktif' => COUNT($PegawaiNonAktif),
            'penambahanKaryawan' => COUNT($PenambahanKaryawan),
            'penguranganKaryawan'  => COUNT($PenguranganKaryawan),
            'penambahanKaryawanByDepartement'  => COUNT($penambahanKaryawanByDepartement),
            'penguranganKaryawanByDepartement'  => COUNT($penguranganKaryawanByDepartement),
            'penambahanKaryawanByDivisi'  => COUNT($penambahanKaryawanByDivisi),
            'penguranganKaryawanByDivisi'  => COUNT($penguranganKaryawanByDivisi),
            'ChartpenambahanKaryawan'  => $this->pegawai_model->getPegawaiBaru(['year(tgl_masuk)' => DATE('Y')],'tbl_pegawai'),
            'CountCuti' => $CountCuti,
            'CountIzin' => $CountIzin,
            'CountIzinHarian' => $CountIzinHarian,
            'CountTugas' => $CountTugas,
            'ruangan' => $this->master_model->getDataRuanganLimit(),
            'barang' => $this->master_model->getDataBarangLimit($this->divisi_id)
        );
        $this->loadViews("adminpanel/dashboard", $this->global, $data, NULL);
    }

    public function getChart(){
        $penambahanKaryawan  = $this->pegawai_model->getPegawaiBaru(['year(tgl_masuk)' => DATE('Y')],'tbl_pegawai');
        $penguranganKaryawan  = $this->pegawai_model->getPegawainonAktif();


        $data = array(
            'penambahanKaryawan' => $penambahanKaryawan,
            'penguranganKaryawan' => $penguranganKaryawan
        );
    
        echo json_encode($data);
    }

    public function dashboardUser(){
        $this->global['pageTitle'] = 'Employee Panel';
        $this->global['pageHeader'] = 'Employee Panel';
        $loginType = $this->global ['loginType'];

        $pegawai_id = $this->pegawai_id;
        $data['pegawai'] = $this->pegawai_model->getPegawaibyId($pegawai_id);
        $data['event'] = $this->crud_model->getdataRowbyWhere('*', ['event_id' => 1,'pegawai_id' => $pegawai_id], 'tbl_daftar_hadir');
 
        $this->loadViewsUser("dashboardUser", $this->global, $data, NULL);
    }

    public function peminjaman(){
        $this->global['pageTitle'] = 'Employee Panel';
        $this->global['pageHeader'] = 'Peminjaman';

        $this->loadViewsUser("peminjaman", $this->global, NULL);
    }
    
    /**
     * This function is used to load the user list
     */
    function userListing()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->model('user_model');
            
            $data['userRecords'] = $this->user_model->userListing();
            $data['roles'] = $this->user_model->getUserRoles();
            $data['pegawai'] = $this->crud_model->lihatdata('tbl_pegawai');
            $data['departement'] = $this->crud_model->lihatdata('tbl_departement');
            
            $this->global['pageTitle'] = 'Mirota KSM : User';
            
            $this->loadViews("adminpanel/user/List_user", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to load the add new form
     */
    function addNew()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->model('user_model');
            $data['roles'] = $this->user_model->getUserRoles();
            $data['pegawai'] = $this->crud_model->lihat_data('tbl_pegawai');
            
            $this->global['pageTitle'] = 'Mirota KSM : Add New User';

            $this->loadViews("adminpanel/user/addNew", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to check whether username already exist or not
     */
    function checkusernameExists()
    {
        $userId = $this->input->post("userId");
        $username = $this->input->post("username");

        if(empty($userId)){
            $result = $this->user_model->checkusernameExists($username);
        } else {
            $result = $this->user_model->checkusernameExists($username, $userId);
        }

        if(empty($result)){ 
            echo("true"); 
        } else { 
            echo("false"); 
            }
    }
    
    /**
     * This function is used to add new user to the system
     */
    function addNewUser()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('nip','No. Karyawan','trim|required|max_length[128]|xss_clean');
            $this->form_validation->set_rules('username','username','trim|required|xss_clean|max_length[128]');
            $this->form_validation->set_rules('password','Password','required|max_length[20]');
            $this->form_validation->set_rules('cpassword','Confirm Password','trim|required|matches[password]|max_length[20]');
            $this->form_validation->set_rules('role','Role','trim|required|numeric');
            if($this->form_validation->run() == FALSE)
            {
                redirect('userListing');
                $this->set_notifikasi_swal('error','Gagal','Data Gagal Disimpan');
            }
            else
            {
                $nip = $this->input->post('nip');
                $username = $this->input->post('username');
                $password = $this->input->post('password');
                $roleId = $this->input->post('role');
                
                $data = array(
                    'username'=>$username, 
                    'password'=>getHashedPassword($password), 
                    'roleId'=>$roleId, 
                    'nip'=> $nip,
                    'createdBy'=>$this->vendorId, 
                    'createdDtm'=>date('Y-m-d H:i:s'));
                
                $this->load->model('user_model');
                $result = $this->user_model->addNewUser($data);
                
                if($result > 0){
                $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
                }else{
                $this->set_notifikasi_swal('error','Gagal','Data Gagal Disimpan');
                }
                
                redirect('userListing');
            }
        }
    }

    /**
     * This function is used load user edit information
     * @param number $userId : Optional : This is user id
     */
    function editOld($userId = NULL)
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            if($userId == null)
            {
                redirect('userListing');
            }
            
            $data['roles'] = $this->user_model->getUserRoles();
            $data['divisi'] = $this->user_model->getDivisi();
            $data['userInfo'] = $this->user_model->getUserInfo($userId);
            
            $this->global['pageTitle'] = 'Mirota KSM : Edit User';
            
            $this->loadViews("adminpanel/user/editOld", $this->global, $data, NULL);
        }
    }
    
    
    /**
     * This function is used to edit the user information
     */
    function editUser()
    {
        $this->load->library('form_validation');
        
        $userId = $this->input->post('userId');
        $page = $this->uri->segment(1);
        
        $this->form_validation->set_rules('username','username','trim|required|xss_clean|max_length[128]');
        $this->form_validation->set_rules('password','Password','max_length[20]');
        $this->form_validation->set_rules('role','Role','trim|required|numeric');     
        if($this->form_validation->run() == FALSE)
        {
            if($page == 'editUser'){
                redirect('userListing');
            }else{
                redirect('Datapegawai'); 
            }
        }
        else
        {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $roleId = $this->input->post('role');
            
            $userInfo = array();
            
            if(empty($password))
            {
                $userInfo = array(
                    'username'=>$username,
                    'roleId'=>$roleId,
                    'updatedBy'=>$this->vendorId, 
                    'updatedDtm'=>date('Y-m-d H:i:s'));
            }
            else
            {
                $userInfo = array(
                    'username'=>$username, 
                    'password'=>getHashedPassword($password), 
                    'roleId'=>$roleId,
                    'updatedBy'=>$this->vendorId, 
                    'updatedDtm'=>date('Y-m-d H:i:s'));
            }
            
            $result = $this->user_model->editUser($userInfo, $userId);
            
            if($result == true)
            {
                $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
            }
            else
            {
                $this->set_notifikasi_swal('error','Gagal','Data Gagal Disimpan');
            }

            if($page == 'editUser'){
                redirect('userListing');
            }else{
                redirect('Datapegawai'); 
            }
        }
    }


    /**
     * This function is used to delete the user using userId
     * @return boolean $result : TRUE / FALSE
     */

    public function delete($id)
    {
        $where = array('userId' => $id);
        $result = $this->crud_model->delete($where, 'tbl_users');
        
        if ($result == 0){
            $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
        }else{
            $this->set_notifikasi_swal('error','Gagal','Data Gagal Disimpan');
        }

        redirect('userListing');
    }
    
    /**
     * This function is used to load the change password screen
     */
    function loadChangePass()
    {
        $this->global['pageTitle'] = 'Mirota KSM : Change Password';
        
        $this->loadViews("adminpanel/user/changePassword", $this->global, NULL, NULL);
    }
    
    
    /**
     * This function is used to change the password of the user
     */
    function changePassword()
    {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('oldPassword','Old password','required|max_length[20]');
        $this->form_validation->set_rules('newPassword','New password','required|max_length[20]');
        $this->form_validation->set_rules('cNewPassword','Confirm new password','required|matches[newPassword]|max_length[20]');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->loadChangePass();
        }
        else
        {
            $oldPassword = $this->input->post('oldPassword');
            $newPassword = $this->input->post('newPassword');
            
            $resultPas = $this->user_model->matchOldPassword($this->vendorId, $oldPassword);
            
            if(empty($resultPas))
            {
                $this->session->set_flashdata('nomatch', 'Your old password not correct');
                redirect('loadChangePass');
            }
            else
            {
                $usersData = array('password'=>getHashedPassword($newPassword), 'updatedBy'=>$this->vendorId,
                                'updatedDtm'=>date('Y-m-d H:i:s'));
                
                $result = $this->user_model->changePassword($this->vendorId, $usersData);
                
                if($result > 0) { $this->session->set_flashdata('success', 'Password updation successful'); }
                else { $this->session->set_flashdata('error', 'Password updation failed'); }
                
                redirect('loadChangePass');
            }
        }
    }

    function pageNotFound()
    {
        $this->global['pageTitle'] = 'Mirota KSM : 404 - Page Not Found';
        
        $this->loadViews("404", $this->global, NULL, NULL);
    }

    function logout() {
		$this->session->sess_destroy ();
		
		redirect ( 'login' );
	}

    public function excel_user(){
        $divisi = $this->input->post('divisi');
        $nama_divisi = $this->crud_model->getdataRowbyWhere('nama_divisi', 'id_divisi='.$divisi, 'tbl_divisi')->nama_divisi;
        $list_data = $this->user_model->getUserByWhere('pegawai.divisi_id ='.$divisi);
    
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
    
        $style_col = [
          'font' => ['bold' => true], // Set font nya jadi bold
          'alignment' => [
          'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
          'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
          ],
          'borders' => [
              'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
              'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
              'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
              'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
          ]
        ];
    
        $styleRight = [
          'font' => [
            'bold' => true,
          ],
          'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
          ],
          'borders' => [
            'top' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            ],
          ],
        ];
            
    
        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = [
          'alignment' => [
          'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
          ],
          'borders' => [
          'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
          'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
          'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
          'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
          ]
        ];
    
        $sheet->setCellValue('B2', 'Username OSD divisi '.$nama_divisi.' PT. Mirota KSM'); // Set kolom A1 Sebagai Header
    
        // $sheet->mergeCells('B2:E2'); // Set Merge Cell pada kolom A1 sampai E1
        
        $sheet->setCellValue('B5', 'No');
        $sheet->setCellValue('C5', 'Nama Karyawan');
        $sheet->setCellValue('D5', 'Username');
        $sheet->setCellValue('E5', 'Password');
    
        $sheet->getStyle('B5')->applyFromArray($style_col);
        $sheet->getStyle('C5')->applyFromArray($style_col);
        $sheet->getStyle('D5')->applyFromArray($style_col);
        $sheet->getStyle('E5')->applyFromArray($style_col);
    
        $no = 1;
        $numrow = 6;
        foreach ($list_data as $ld) {
          $sheet->setCellValue('B'.$numrow, $no);
          $sheet->setCellValue('C'.$numrow, $ld->name);
          $sheet->setCellValue('D'.$numrow, $ld->username);
          $sheet->setCellValue('E'.$numrow, $ld->username);
    
          $sheet->getColumnDimension('C')->setAutoSize(true);
          $sheet->getColumnDimension('D')->setAutoSize(true);
          $sheet->getColumnDimension('E')->setAutoSize(true);
      
          $sheet->getStyle('B'.$numrow)->applyFromArray($style_row);
          $sheet->getStyle('C'.$numrow)->applyFromArray($style_row);
          $sheet->getStyle('D'.$numrow)->applyFromArray($style_row);
          $sheet->getStyle('E'.$numrow)->applyFromArray($style_row);
    
          $no++;
          $numrow++;
        }
    
        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.ms-excel');
    
        header('Content-Disposition: attactchment;filename=User OSD divisi '.$nama_divisi.'.xlsx');
    
        header('Cache-Control: max-age=0');
        $writer->save("php://output");
        exit();
      }
}

?>