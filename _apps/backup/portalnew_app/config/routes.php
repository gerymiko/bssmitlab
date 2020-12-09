<?php defined('BASEPATH') OR exit('No direct script access allowed');
	 
	$route['syshaer/(.+)'] = 'syshaer/index';
	$route['zenmisc/(.+)'] = 'zenmisc/index';

	$route['s_url/(:any)'] = 'syslink/$1';

	//LOGIN
	$route['secauth'] = 'syslogin/check_login';
	
	//DASHBOARD
	$route['dashboard']     = 'hrDepartment/default/dashboard';
	$route['miscdashboard'] = 'misc/cdefault/zendashboard';

	//MISC PAGE
	$route['administrator'] = 'misc/cadmin/zenadmin/administrator';
	$route['leveluser']     = 'misc/clevel/zenlevel/level_user';
	
	$route['addadmin']     = 'misc/cadmin/zenadmin/add_admin';
	$route['editadmin']    = 'misc/cadmin/zenadmin/edit_admin';
	$route['nonaktifuser'] = 'misc/cadmin/zenadmin/nonaktifuser';

	//ADMIN TABLE
	$route['dtAdmin'] = 'misc/cadmin/zenadmin/table_admin';

	//MISC GET PARAMETER
	$route['getKaryawan'] = 'misc/cadmin/zenadmin/getKaryawan';
	$route['checkAdmin']  = 'misc/cadmin/zenadmin/checkAdmin';

	// REKRUTMEN PELAMAR MANUAL
	$route['mpelamarAll']        = 'hrDepartment/pelamar/manual/sysmpelamarall/pelamar_all';

	//REKRUTMEN PELAMAR
	$route['pelamarAll']        = 'hrDepartment/pelamar/syspelamarall/pelamar_all';
	$route['pelamarPerjabatan'] = 'hrDepartment/pelamar/syspelamarjabatan/pelamar_perjabatan';
	
	$route['dperjabatan/(:any)/(:any)'] = 'hrDepartment/pelamar/syspelamarjabatan/detail_perjabatan/$1/$1';
	$route['pelamarFreshgrad']  = 'hrDepartment/pelamar/syspelamarfg/pelamar_freshgrad';
	$route['pelamarQualify']    = 'hrDepartment/pelamar/syspelamarqualify/pelamar_qualify';
	$route['pelamarUnqualify']  = 'hrDepartment/pelamar/syspelamarunqualify/pelamar_unqualify';
	$route['pelamarFailed']     = 'hrDepartment/pelamar/syspelamarfailed/pelamar_failed';

	//MONITORING INTERVIEW
	$route['pelamarMonitor']        = 'hrDepartment/cmonitoring/syspelamarmonitor/pelamar_monitor';
	$route['pelamarSeleksiKspm']    = 'hrDepartment/cmonitoring/syspelamarmonitor/pelamar_monitor_kspm';
	$route['pelamarSeleksiHrd']     = 'hrDepartment/cmonitoring/syspelamarmonitor/pelamar_monitor_hrd';
	$route['pelamarSeleksiTeknis']  = 'hrDepartment/cmonitoring/syspelamarmonitor/pelamar_monitor_teknis';
	$route['pelamarSeleksiTeori']   = 'hrDepartment/cmonitoring/syspelamarmonitor/pelamar_monitor_teori';
	$route['pelamarSeleksiPraktek'] = 'hrDepartment/cmonitoring/syspelamarmonitor/pelamar_monitor_praktek';
	$route['pelamarSeleksiMCU']     = 'hrDepartment/cmonitoring/syspelamarmonitor/pelamar_monitor_mcu';
	$route['rekapMonitoring']       = 'hrDepartment/cmonitoring/sysmonitoringrekap/pelamar_monitor_rekap';
	$route['pesertaLolos']          = 'hrDepartment/cmonitoring/sysmonitoringlolos/pelamar_monitor_lolospeserta';

	//NILAI TES TEORI
	$route['addnilaites']   = 'hrDepartment/cmonitoring/sysmonitoringteori/add_nilai_tes';
	$route['editnilaites']  = 'hrDepartment/cmonitoring/sysmonitoringteori/edit_nilai_tes';

	//MEDICAL
	$route['medicalKlinik'] = 'hrDepartment/cmedical/sysklinik/klinik';

	//PRAPEMILIHAN
	$route['prapemilihan'] = 'hrDepartment/cprapemilihan/sysprapemilihan/prapemilihan';
	$route['passelection/(:any)'] = 'hrDepartment/cprapemilihan/sysprapemilihan/lolos_seleksi/$1';

	//TABLE PRAPEMILIHAN
	$route['dtPrapemilihan'] = 'hrDepartment/cprapemilihan/sysprapemilihan/table_prapemilihan';

	//REKRUTMEN LOWONGAN
	$route['lowongan']                   = 'hrDepartment/clowongan/syslowongan/lowongan';
	$route['addLowongan']                = 'hrDepartment/clowongan/syslowongan/add_lowongan';
	$route['editLowongan/(:any)/(:any)'] = 'hrDepartment/clowongan/syslowongan/edit_lowongan/$1/$1';
	$route['simpaneditlowongan']         = 'hrDepartment/clowongan/syslowongan/simpan_editlowongan';
	$route['nonaktifloker']              = 'hrDepartment/clowongan/syslowongan/nonaktifloker';

	//REKRUTMEN GET PARAMETER
	$route['getSkill']          = 'hrDepartment/clowongan/syslowongan/getSkill';
	$route['getSertifikat']     = 'hrDepartment/clowongan/syslowongan/getSertifikat';
	$route['getSyarat']         = 'hrDepartment/clowongan/syslowongan/getSyarat';
	$route['getStepSelection']  = 'hrDepartment/cmaster/sysmasterpic/getStepSelection';
	
	//MASTER REKRUTMEN
	//SKILL
	$route['masterSkill']       = 'hrDepartment/cmaster/sysmasterskill/master_skill';
	$route['editskill']         = 'hrDepartment/cmaster/sysmasterskill/edit_skill';
	//SYARAT
	$route['masterSyarat']      = 'hrDepartment/cmaster/sysmastersyarat/master_syarat';
	$route['editsyarat']        = 'hrDepartment/cmaster/sysmastersyarat/edit_syarat';
	//SERTIFIKAT
	$route['masterSertifikat']  = 'hrDepartment/cmaster/sysmastersertifikat/master_sertifikat';
	$route['editcertificate']   = 'hrDepartment/cmaster/sysmastersertifikat/edit_sertifikat';
	//PIC
	$route['masterPic']         = 'hrDepartment/cmaster/sysmasterpic/master_pic';
	
	//MANAJEMEN DATA
	$route['department']     = 'hrDepartment/cdepartment/sysdepartment/department';
	$route['adddepartment']  = 'hrDepartment/cdepartment/sysdepartment/add_department';
	$route['editdepartment'] = 'hrDepartment/cdepartment/sysdepartment/edit_department';

	$route['jabatan']              = 'hrDepartment/cjabatan/sysjabatan/jabatan';
	$route['addjabatan']           = 'hrDepartment/cjabatan/sysjabatan/add_jabatan';
	$route['editjabatan']          = 'hrDepartment/cjabatan/sysjabatan/edit_jabatan';
	$route['simpantahapanseleksi'] = 'hrDepartment/cjabatan/sysjabatan/simpan_tahapanseleksi';
	$route['getTahapan']           = 'hrDepartment/cjabatan/sysjabatan/get_tahapantes';

	$route['pengguna'] = 'hrDepartment/cpengguna/syspengguna/pengguna';

	//PDF
	$route['downloadPdf/(:any)']         = 'hrDepartment/cpdf/syspdf/download_pdf/$1';
	$route['pdfinterviewhrdkspm/(:any)'] = 'hrDepartment/cpdf/syspdf/download_pdf_interview_hrdkspm/$1';
	$route['pdfRekap/(:any)']            = 'hrDepartment/cpdf/syspdf/download_pdf_rekap_monitoring/$1';

	//ADD MASTER
	$route['addmasterskill']      = 'hrDepartment/cmaster/sysmasterskill/addmaster_skill';
	$route['addmastersyarat']     = 'hrDepartment/cmaster/sysmastersyarat/addmaster_syarat';
	$route['addmastersertifikat'] = 'hrDepartment/cmaster/sysmastersertifikat/addmaster_sertifikat';
	$route['addmasterpic']        = 'hrDepartment/cmaster/sysmasterpic/addmaster_pic';
	
	//VIEW KIRIM SMS
	$route['kirimSmsKSPM']    = 'hrDepartment/kirimsms/syskirimsmskspm/kirimsms_kspm';
	$route['kirimSmsHRD']     = 'hrDepartment/kirimsms/syskirimsmshrd/kirimsms_hrd';
	$route['kirimSmsTeknis']  = 'hrDepartment/kirimsms/syskirimsmsteknis/kirimsms_teknis';
	$route['kirimSmsPraktek'] = 'hrDepartment/kirimsms/syskirimsmspraktek/kirimsms_praktek';
	$route['kirimSmsTeori']   = 'hrDepartment/kirimsms/syskirimsmsteori/kirimsms_teori';
	$route['kirimSmsFresh']   = 'hrDepartment/kirimsms/syskirimsmsfreshgrad/kirimsms_freshgrad';
	$route['kirimSmsMCU']     = 'hrDepartment/kirimsms/syskirimsmsmedical/kirimsms_medical';
	
	//DETAIL PEOPLE
	$route['detailPeople/(:any)/(:any)'] = 'hrDepartment/cdetail/sysdetailpeople/detail_people/$1/$1';
	$route['detailPengguna/(:any)']      = 'hrDepartment/cdetail/sysdetailpeople/detail_people/$1';
	$route['detail_berkas/(:any)']       = 'hrDepartment/cdetail/sysdetailpeople/detail_berkas/$1';

	$route['detailPeopleManual/(:any)']   = 'hrDepartment/cdetail/sysdetailpeople/detail_people_manual/$1';
	$route['detail_berkas_manual/(:any)'] = 'hrDepartment/cdetail/sysdetailpeople/detail_berkas_manual/$1';

	//GAGAL BERKAS
	$route['gagalberkas'] = 'hrDepartment/cdetail/sysdetailpeople/gagal_berkas';

	//DETAIL LOKER
	$route['detailLowongan/(:any)/(:any)'] = 'hrDepartment/cdetail/sysdetaillowongan/detail_lowongan/$1/$1';
	
	// URL DATA TABLE
	$route['dtPelamarAll']          = 'hrDepartment/pelamar/syspelamarall/table_pelamar_all';
	$route['dtPelamarPerjabatan']   = 'hrDepartment/pelamar/syspelamarjabatan/table_pelamar_perjabatan';
	$route['dtDPPerjabatan/(:any)'] = 'hrDepartment/pelamar/syspelamarjabatan/table_detail_perjabatan/$1';
	$route['dtPelamarFreshgrad']    = 'hrDepartment/pelamar/syspelamarfg/table_pelamar_fg';
	$route['dtPelamarQualify']      = 'hrDepartment/pelamar/syspelamarqualify/table_pelamar_qualify';
	$route['dtPelamarUnqualify']    = 'hrDepartment/pelamar/syspelamarunqualify/table_pelamar_unqualify';
	$route['dtPelamarFailed']       = 'hrDepartment/pelamar/syspelamarfailed/table_pelamar_failed';

	$route['dtMPelamarAll']          = 'hrDepartment/pelamar/manual/sysmpelamarall/table_mpelamar_all';


	//MONITORING INTERVIEW
	$route['interviewKSPM']  = 'hrDepartment/pelamar/syspelamarfg/pelamar_freshgrad';

	//GAGAL INTERVIEW MONITORING
	$route['gagalseleksikspm']    = 'hrDepartment/cmonitoring/syspelamarmonitor/gagal_seleksi_kspm';
	$route['gagalseleksihrd']     = 'hrDepartment/cmonitoring/sysmonitoringhrd/gagal_seleksi_hrd';
	$route['gagalseleksiteknis']  = 'hrDepartment/cmonitoring/sysmonitoringteknis/gagal_seleksi_teknis';
	$route['gagalseleksiteori']   = 'hrDepartment/cmonitoring/sysmonitoringteori/gagal_seleksi_teori';
	$route['gagalseleksipraktek'] = 'hrDepartment/cmonitoring/sysmonitoringpraktek/gagal_seleksi_praktek';
	
	// INTERVIEW TABLE
	$route['dtPelamarKSPM'] = 'hrDepartment/interview/sysinterviewkspm/table_interview_kspm'; 
	
	// KIRIM SMS TABLE
	$route['dtKirimSmsKSPM']    = 'hrDepartment/kirimsms/syskirimsmskspm/table_kirimsms_kspm';
	$route['dtKirimSmsHRD']     = 'hrDepartment/kirimsms/syskirimsmshrd/table_kirimsms_hrd';
	$route['dtKirimSmsTeknis']  = 'hrDepartment/kirimsms/syskirimsmsteknis/table_kirimsms_teknis';
	$route['dtKirimSmsPraktek'] = 'hrDepartment/kirimsms/syskirimsmspraktek/table_kirimsms_praktek';
	$route['dtKirimSmsTeori']   = 'hrDepartment/kirimsms/syskirimsmsteori/table_kirimsms_teori';
	$route['dtKirimSmsFG']      = 'hrDepartment/kirimsms/syskirimsmsfreshgrad/table_kirimsms_freshgrad';
	$route['dtKirimSmsMCU']     = 'hrDepartment/kirimsms/syskirimsmsmedical/table_kirimsms_medical';

	//GET PARAMETER
	$route['getaddressclinic'] = 'hrDepartment/kirimsms/syskirimsmsmedical/getaddressclinic';

	// LOWONGAN TABLE
	$route['dtLowonganAll'] = 'hrDepartment/clowongan/syslowongan/table_lowongan_all';

	// DEPT TABLE
	$route['dtDepartment'] = 'hrDepartment/cdepartment/sysdepartment/table_department';

	// JABATAN TABLE
	$route['dtJabatan'] = 'hrDepartment/cjabatan/sysjabatan/table_jabatan';

	// USER TABLE
	$route['dtPengguna'] = 'hrDepartment/cpengguna/syspengguna/table_pengguna';

	// MONITOR SELEKSI TABLE
	$route['dtMonitorKspm']    = 'hrDepartment/cmonitoring/syspelamarmonitor/table_monitor_kspm';
	$route['dtMonitorHrd']     = 'hrDepartment/cmonitoring/syspelamarmonitor/table_monitor_hrd';
	$route['dtMonitorTeknis']  = 'hrDepartment/cmonitoring/syspelamarmonitor/table_monitor_teknis';
	$route['dtMonitorTeori']   = 'hrDepartment/cmonitoring/syspelamarmonitor/table_monitor_teori';
	$route['dtMonitorPraktek'] = 'hrDepartment/cmonitoring/syspelamarmonitor/table_monitor_praktek';
	$route['dtMonitorMCU']     = 'hrDepartment/cmonitoring/syspelamarmonitor/table_monitor_mcu';
	$route['dtMonitorRekap']   = 'hrDepartment/cmonitoring/sysmonitoringrekap/table_monitor_rekap';
	$route['dtMonitorLolosPeserta'] = 'hrDepartment/cmonitoring/sysmonitoringlolos/table_monitor_lolospeserta';

	//TAHAP MCU
	$route['medical'] = 'hrDepartment/cmedical/sysmedical/medical';

	//MEDICAL TABLE
	$route['dtKlinik']  = 'hrDepartment/cmedical/sysklinik/table_klinik';
	$route['dtMedical']  = 'hrDepartment/cmedical/sysmedical/table_medical';

	// MASTER
	$route['dtMasterSkill']      = 'hrDepartment/cmaster/sysmasterskill/table_master_skill';
	$route['dtMasterSyarat']     = 'hrDepartment/cmaster/sysmastersyarat/table_master_syarat';
	$route['dtMasterSertifikat'] = 'hrDepartment/cmaster/sysmastersertifikat/table_master_sertifikat';
	$route['dtMasterPic']        = 'hrDepartment/cmaster/sysmasterpic/table_master_pic';
	
	//FUNGSI KIRIM SMS
	$route['kirimsmspelamarkspm']      = 'hrDepartment/kirimsms/syskirimsmskspm/kirimsmspelamar';
	$route['kirimsmspelamarhrd']       = 'hrDepartment/kirimsms/syskirimsmshrd/kirimsmspelamar';
	$route['kirimsmspelamarteknis']    = 'hrDepartment/kirimsms/syskirimsmsteknis/kirimsmspelamar';
	$route['kirimsmspelamarpraktek']   = 'hrDepartment/kirimsms/syskirimsmspraktek/kirimsmspelamar';
	$route['kirimsmspelamarteori']     = 'hrDepartment/kirimsms/syskirimsmsteori/kirimsmspelamar';
	$route['kirimsmspelamarfreshgrad'] = 'hrDepartment/kirimsms/syskirimsmsfreshgrad/kirimsmspelamar';
	$route['kirimsmspelamarmcu']       = 'hrDepartment/kirimsms/syskirimsmsmedical/kirimsmspelamar';

	//ADD LOWONGAN
	$route['addlowongannew'] = 'hrDepartment/clowongan/syslowongan/addlowongan_new';
	
	//dtdetail
	$route['dtLisencePeople'] = 'hrDepartment/cdetail/sysdetailpeople/detail_lisence';
	
	//AUTOCOMPLETE CITY
	$route['getcity'] = 'hrDepartment/default/dashboard/get_city';
	
	$route['checkloker'] = 'hrDepartment/clowongan/syslowongan/checkloker';
	//DASHBOARD ITEM
	$route['dtAdminOnline'] = 'hrDepartment/default/dashboard/table_admin_online';

	//FINAL
	$route['final'] = 'hrDepartment/cfinal/syspelamarfinal/finalisasi';

	//TABLE TAHAP FINAL
	$route['dtFinal'] = 'hrDepartment/cfinal/syspelamarfinal/table_final';

	$route['default_controller']   = 'syslogin';
	$route['404_override']         = 'errors';
	$route['translate_uri_dashes'] = TRUE;

?>
