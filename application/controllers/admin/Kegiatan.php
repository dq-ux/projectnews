<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kegiatan extends CI_Controller {

	public function index()
	{
		$data['title'] = "Berita";
		$data['kegiatan'] = $this->db->get('kegiatan')->result();
		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar');
		$this->load->view('template_admin/topbar');
		$this->load->view('admin/kegiatan', $data);
		$this->load->view('template_admin/footer');
	}

	public function edit($id)
	{
		$data['title'] = "Edit Berita";
		$where = array('id_kegiatan' => $id);

		$data['kegiatan'] = $this->db->get_where('kegiatan', $where)->row_array();
		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar');
		$this->load->view('template_admin/topbar');
		$this->load->view('admin/edit-kegiatan', $data);
		$this->load->view('template_admin/footer');
	}

	public function edit_aksi()
	{
		$id = $this->input->post('id_kegiatan');
		$judul = htmlspecialchars($this->input->post('judul', true));
		$isi = htmlspecialchars($this->input->post('isi', true));
		$photo = $_FILES['gambar']['name'];
		
		if ($photo) {
			$config['upload_path'] = './assets/user/img';
			$config['allowed_types'] = 'jpeg|jpg|png|gif|tiff';

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('gambar')) {
				$photo = $this->upload->data('file_name');
				$this->db->set('gambar', $photo);
			} else {
				echo "Gagal upload";
			}
		}

		$data = array(
			'gambar' => $photo,
			'judul'  => $judul,
			'isi'	=> $isi,
		);

		$where = array(
			'id_kegiatan' => $id
		);

		$this->DataModel->update_data('kegiatan', $data, $where);
		$this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
                Data berhasil diperbaharui!.
              </div>');
		redirect('admin/kegiatan');
	}

	// Fungsi untuk menampilkan halaman tambah data
	public function tambah()
	{
		$data['title'] = "Tambah Data Berita";
		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar');
		$this->load->view('template_admin/topbar');
		$this->load->view('admin/tambah_kegiatan', $data);
		$this->load->view('template_admin/footer');
	}

	public function insert() {
		$judul = htmlspecialchars($this->input->post('judul', true));
		$isi = htmlspecialchars($this->input->post('isi', true));
		$photo = $_FILES['gambar']['name'];
	
		if ($photo) {
			$config['upload_path'] = './assets/user/img';
			$config['allowed_types'] = 'jpeg|jpg|png|gif|tiff';
	
			$this->load->library('upload', $config);
	
			if ($this->upload->do_upload('gambar')) {
				$photo = $this->upload->data('file_name');
			} else {
				echo "Gagal upload";
				return;  // Menghentikan eksekusi jika gagal upload
			}
		}
	
		$data = array(
			'judul' => $judul,
			'isi' => $isi,
			'gambar' => $photo
		);
	
		$this->DataModel->insert_kegiatan($data);
		$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<h4><i class="icon fa fa-check"></i> Success!</h4>
			Data berhasil ditambahkan!.
		</div>');
		redirect('admin/kegiatan');
	}
	public function delete($id)
	{
		// Cari data kegiatan berdasarkan ID
		$kegiatan = $this->db->get_where('kegiatan', ['id_kegiatan' => $id])->row_array();
	
		// Jika data ditemukan, hapus gambar dan data dari database
		if ($kegiatan) {
			// Hapus gambar jika ada
			if ($kegiatan['gambar'] != '') {
				unlink('./assets/user/img/' . $kegiatan['gambar']);
			}
	
			// Hapus data kegiatan dari database
			$this->db->delete('kegiatan', ['id_kegiatan' => $id]);
	
			// Tampilkan pesan berhasil
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h4><i class="icon fa fa-check"></i> Success!</h4>
				Data berhasil dihapus!.
			  </div>');
		} else {
			// Tampilkan pesan jika data tidak ditemukan
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h4><i class="icon fa fa-warning"></i> Error!</h4>
				Data tidak ditemukan!.
			  </div>');
		}
	
		// Redirect ke halaman kegiatan
		redirect('admin/kegiatan');
	}
	public function detail($id_kegiatan)
	{
		$this->load->model('DataModel');
	
		// Mengambil data kegiatan berdasarkan id_kegiatan
		$data['kegiatan'] = $this->DataModel->getKegiatanById($id_kegiatan);
	
		// Cek jika data tidak ditemukan
		if (empty($data['kegiatan'])) {
			show_404();
		}
	
		$data['identitas'] = $this->DataModel->getIdentitas();
		// Memuat view detail
		$this->load->view('admin/detail', $data);
	}
	

}
