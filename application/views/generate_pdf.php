<style>
body{
  font-family:arial;
}
.header{
  text-align: center;
  font-size: 18px;
  text-decoration: underline;
  margin-top:-30px;
}
table{
  width:100%;
  font-family:arial;
}
#table_details td{
  border: 0.5px solid black;
  padding:2px;
  text-align: left;
  font-size: 13PX;
}
#table_details th{
  border: 0.5px solid black;
  padding:2px;
  text-align: left;
  font-size: 13PX;
  background: #2d3436;
  color: white;
}
#table_info th{
  border: 0.5px solid black;
  padding:6px;
  text-align: center;
}
#table_info td{
  border: 0.5px solid black;
  padding:6px;
  font-size: 12px;
  text-align: center;
}
#table_info td:nth-child(1), #table_info th:nth-child(1){
	text-align:left;
}
<?php
  foreach ($result as $row) {
    $reference = $row->reference_no;
    // $institution = $row->institution_name;
    // $contact_no = $row->contact_no;
    // $email_add = $row->email_add;
    // $no_street = $row->no_street;
    // $postal = $row->postal;
    $hospital_chief = $row->hospital_chief;
    $lab_chief = $row->lab_chief;
    $head_bacterioloy = $row->head_bacterioloy;
    $head_para = $row->head_para;
    $head_TB = $row->head_TB;
    $head_bloodService = $row->head_bloodService;
    // $contact_person = $row->contact_person;
    // $telephone = $row->telephone;
    // $fax = $row->fax;
    // $email = $row->email;
    // $dept_lab_branch = $row->dept_lab_branch;
    // $trunk_line = $row->trunk_line;
    // $ship_address = $row->ship_address;
    //ownership
    $ownership_gov = $row->ownership_gov;
    $ownership_private = $row->ownership_private;
    //tblinstitutional_char
    $inst_based = $row->inst_based;
    $inst_free = $row->inst_free;
    //tblservice_capability
    $primary_lab = $row->primary_lab;
    $secondary = $row->secondary;
    $tertiary = $row->tertiary;
    $special = $row->special;
    $anaerobic = $row->anaerobic;
    //tblblood_service
    $bloodCU = $row->bloodCU;
    $bloodSt = $row->bloodSt;
    $bloodCUBS = $row->bloodCUBS;
    $bloodBk = $row->bloodBk;
    $bloodBkF = $row->bloodBkF;
    $bloodCr = $row->bloodCr;
    //tblshipping_Info
    $contact_person = $row->contact_person;
    $telephone = $row->telephone;
    $fax = $row->fax;
    $email = $row->email;
    $dept_lab_branch = $row->dept_lab_branch;
    $trunk_line = $row->trunk_line;
    $local_no = $row->local_no;
    $ship_address = $row->ship_address;
    $ship_consignee = $row->ship_consignee;
    $desig_chief_director = $row->desig_chief_director;
    $chck_tel = $row->chck_tel;
    $chck_mobile = $row->chck_mobile;
    $chck_email = $row->chck_email;
    $chck_fax = $row->chck_fax;
    $others = $row->others;
    $other_specify = $row->other_specify;
    $ship_contact_no = $row->contact_no;
    $ship_instruct = $row->shipping_instructions;
    //tblprogram_Enrollment
    $chck_bac = $row->chck_bac;
    $chck_para = $row->chck_para;
    $chck_TB = $row->chck_TB;
    $chck_culture = $row->chck_culture;
    $chck_serology = $row->chck_serology;
    //tblpayment;
    $cash = $row->cash;
    $company = $row->company;
    $landbank = $row->landbank;
    $mds = $row->mds;

    //ATTESTATION
    // $bac_personnel = $row->bac_personnel;
    // $para_personnel = $row->para_personnel;
    // $tbmicro_personnel = $row->tbmicro_personnel;
    // $tbculture_personnel = $row->tbculture_personnel;
    // $TTI_personnel = $row->TTI_personnel;
    $noted_by = $row->noted_by;
    $date_by = $row->date_by;
  }

  foreach ($brgy as $bgy) {
    $barangay = strtoupper($bgy->name);
  }

  foreach ($mun as $mun_row) {
    $municipal = strtoupper($mun_row->name);
  }

  foreach ($province_name as $province) {
    $province_name = strtoupper($province->name);
  }
?>
</style>
<body>
<table cellspacing="0" id="table_top">
	<tbody>
		<tr>
			<td style="width:500px;padding:0">
        <p><b><u>NATIONAL EXTERNAL QUALITY ASSESSMENT SCHEME (NEQAS)</u></b></p>
        <span style="font-size:13px;">for Bacteriology, Parasitology, Mycobacteriology and Transfusion<br>
        Transmissible Infections</span><br>
        <span style="font-size:12px;"><b>Department of Health<br>
        Research Institute for Tropical Medicine</b></span>
			</td>
      <td style="padding:0; text-align:right;">
        <img src="src/img/DOH.png" height=70 width=70>
      </td>
      <td style="width:5px;padding:0; text-align:right;">
        <img src="src/img/RITM-Logo.png" height=100 width=100>
      </td>
		</tr>
	</tbody>
</table>
<div class="header">
    <h5>REGISTRATION FORM</h5>
</div>
<span><b>REFERENCE NO.:</b> <?= isset($reference) ? $reference: ''?></span>
<table cellspacing="0" id="table_details">
  <thead>
    <tr>
      <th colspan="4">HOSPITAL/LABORATORY INFORMATION</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td colspan="4" style="font-size:11px;"><b>INSTITUTION NAME (NO ABBREVIATIONS)</b><br>
        <?= strtoupper($institution);?>
      </td>
    </tr>
    <tr>
      <td colspan="4" style="font-size:11px;"><b>ADDRESS</b><br>
        <?= strtoupper($no_street);?> <?= strtoupper($barangay);?>, <?= strtoupper($municipal);?>,
        <?= strtoupper($province_name);?>, <?= $postal;?>
      </td>
    </tr>
    <tr>
      <td colspan="2" style="font-size:11px;"><b>CONTACT NUMBER</b><br>
        <?= isset($contact_no) ? $contact_no: ''?>
      </td>
      <td colspan="2" style="font-size:11px;"><b>EMAIL ADDRESS</b><br>
        <?= isset($email_add) ? $email_add: ''?>
      </td>
    </tr>
    <tr>
      <td colspan="2" style="font-size:11px;"><b>OWNERSHIP</b><br>
        <?= (isset($ownership_gov) && $ownership_gov=='1') ? '▣':'▢' ?> Government<br>
        <?= (isset($ownership_private) && $ownership_private=='1') ? '▣':'▢' ?> Private<br>
      </td>
      <td colspan="2" style="font-size:11px;"><b>INSTITUTIONAL CHARACTER</b><br>
        <?= (isset($inst_based) && $inst_based=='1') ? '▣':'▢' ?> Institution-based<br>
        <?= (isset($inst_free) && $inst_free=='1') ? '▣':'▢' ?> Freestanding<br>
      </td>
    </tr>
    <tr>
      <td colspan="2" style="font-size:11px;"><b>SERVICE CAPABILITY</b><br>
        1.  General Laboratory<br>
        <?= (isset($primary_lab) && $primary_lab=='1') ? '▣':'▢' ?> Primary<br>
        <?= (isset($secondary) && $secondary=='1') ? '▣':'▢' ?> Secondary<br>
        <?= (isset($tertiary) && $tertiary=='1') ? '▣':'▢' ?> Tertiary<br>
        2.  Special Laboratory<br>
        <?= (isset($special) && $special=='1') ? '▣':'▢' ?> Special<br>
        <?= (isset($anaerobic) && $anaerobic=='1') ? '▣':'▢' ?> Anaerobic Culture performed<br>
      </td>
      <td colspan="2" style="font-size:11px;"><b>BLOOD SERVICE</b><br>
        <?= (isset($bloodCU) && $bloodCU=='1') ? '▣':'▢' ?> Blood Collecting Unit<br>
        <?= (isset($bloodSt) && $bloodSt=='1') ? '▣':'▢' ?> Blood Station<br>
        <?= (isset($bloodCUBS) && $bloodCUBS=='1') ? '▣':'▢' ?> Blood Collecting Unit/Blood Station<br>
        <?= (isset($bloodBk) && $bloodBk=='1') ? '▣':'▢' ?> Blood Bank<br>
        <?= (isset($bloodBkF) && $bloodBkF=='1') ? '▣':'▢' ?> Blood Bank with Additional Function<br>
        <?= (isset($bloodCr) && $bloodCr=='1') ? '▣':'▢' ?> Blood Center<br>
      </td>
    </tr>
    <tr>
      <td colspan="2" style="font-size:11px;"><b>HOSPITAL CHIEF/DIRECTOR</b><br>
        <?= isset($hospital_chief) ? $hospital_chief: ''?>
      </td>
      <td colspan="2" style="font-size:11px;"><b>HEAD OF LABORATORY</b><br>
        <?= isset($lab_chief) ? $lab_chief: ''?>
      </td>
    </tr>
    <tr>
      <td colspan="2" style="font-size:11px;"><b>HEAD OF BACTERIOLOGY</b><br>
        <?= isset($head_bacterioloy) ? $head_bacterioloy: ''?>
      </td>
      <td colspan="2" style="font-size:11px;"><b>HEAD OF PARASITOLOGY</b><br>
        <?= isset($head_para) ? $head_para: ''?>
      </td>
    </tr>
    <tr>
      <td colspan="2" style="font-size:11px;"><b>HEAD OF TB LABORATORY</b><br>
        <?= isset($head_TB) ? $head_TB: ''?>
      </td>
      <td colspan="2" style="font-size:11px;"><b>HEAD OF BLOOD SERVICE FACILITY</b><br>
        <?= isset($head_bloodService) ? $head_bloodService: ''?>
      </td>
    </tr>
  </tbody>
</table>

<table cellspacing="0" id="table_details">
  <thead>
    <tr>
      <th colspan="4">SHIPPING INFORMATION</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td colspan="4" style="font-size:11px;"><b>CONTACT PERSON</b><br>
        <?= isset($contact_person) ? $contact_person: ''?>
      </td>
    </tr>
    <tr>
      <td colspan="4" style="font-size:11px;"><b>DEPARTMENT/LABORATORY/BRANCH NAME</b><br>
        <?= isset($dept_lab_branch) ? $dept_lab_branch: ''?>
      </td>
    </tr>
    <tr>
      <td colspan="4" style="font-size:11px;"><b>SHIPPING ADDRESS</b><br>
        <?= isset($ship_address) ? $ship_address: ''?>
      </td>
    </tr>
    <tr>
      <td colspan="4" style="font-size:11px;"><b>SHIPPING INSTRUCTIONS</b><br>
        <?= isset($ship_instruct) ? $ship_instruct: ''?>
      </td>
    </tr>
    <tr>
      <td colspan="2" style="font-size:11px;"><b>TELEPHONE (Area Code + Landline)</b><br>
        <?= isset($telephone) ? $telephone: ''?>
      </td>
      <td colspan="1" style="font-size:11px;"><b>FAX (Area Code + Landline)</b><br>
        <?= isset($fax) ? $fax: ''?>
      </td>
      <td colspan="1" style="font-size:11px;"><b>CONTACT NO</b><br>
        <?= isset($ship_contact_no) ? $ship_contact_no: ''?>
      </td>
    </tr>
    <tr>
      <td colspan="2" style="font-size:11px;"><b>EMAIL ADDRESS</b><br>
        <?= isset($email) ? $email: ''?>
      </td>
      <td colspan="1" style="font-size:11px;"><b>TRUNK LINE</b><br>
        <?= isset($trunk_line) ? $trunk_line: ''?>
      </td>
      <td colspan="1" style="font-size:11px;"><b>LOCAL NO.</b><br>
        <?= isset($local_no) ? $local_no: ''?>
      </td>
    </tr>
    <tr>
      <td colspan="2" style="font-size:11px;"><b>DESIGNATION OF SHIPPING CONSIGNEE</b><br>
        <?= isset($ship_consignee) ? $ship_consignee: ''?>
      </td>
      <td colspan="2" style="font-size:11px;"><b>DESIGNATION FOR HOSPITAL CHIEF/DIRECTOR</b><br>
        <?= isset($desig_chief_director) ? $desig_chief_director: ''?>
      </td>
    </tr>
    <tr>
      <td colspan="4" style="font-size:11px;"><b>Please check the best way to contact you:</b><br>
        <?= (isset($chck_tel) && $chck_tel=='1') ? '▣':'▢' ?> Telephone
        <?= (isset($chck_mobile) && $chck_mobile=='1') ? '▣':'▢' ?> Mobile Number
        <?= (isset($chck_email) && $chck_email=='1') ? '▣':'▢' ?> Email
        <?= (isset($chck_fax) && $chck_fax=='1') ? '▣':'▢' ?> Fax
        <?= (isset($others) && $others=='1') ? '▣':'▢' ?> Others (please indicate): <?= $other_specify;?>

      </td>
    </tr>
  </tbody>
</table>

<table cellspacing="0" id="table_details">
  <thead>
    <tr>
      <th colspan="4">PROGRAM ENROLLMENT</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td colspan="4" style="font-size:11px;"><b>Please check the proficiency test your laboratory would like to register:</b><br>
        <?= (isset($chck_bac) && $chck_bac=='1') ? '▣':'▢' ?> Bacteriology
        <?= (isset($chck_para) && $chck_para=='1') ? '▣':'▢' ?> Parasitology
        <?= (isset($chck_TB) && $chck_TB=='1') ? '▣':'▢' ?> TB Microscopy
        <?= (isset($chck_culture) && $chck_culture=='1') ? '▣':'▢' ?> TB Culture (Optional)
        <?= (isset($chck_serology) && $chck_serology=='1') ? '▣':'▢' ?> TTI Serology
      </td>
    </tr>
  </tbody>
</table>

<table cellspacing="0" id="table_details">
  <thead>
    <tr>
      <th colspan="4">PAYMENT METHODS</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td colspan="4" style="font-size:11px;">
        <?= (isset($cash) && $cash=='1') ? '▣':'▢' ?> Cash (for on-site payment only)<br>
        <?= (isset($company) && $company=='1') ? '▣':'▢' ?> Company/Manager’s Check/Postal Money Order – payable to RESEARCH INSTITUTE FOR TROPICAL MEDICINE<br>
        <?= (isset($landbank) && $landbank=='1') ? '▣':'▢' ?> LANDBANK Electronic Payment Portal<br>
        <?= (isset($mds) && $mds=='1') ? '▣':'▢' ?> Modified Disbursement System (option for Government Agencies only)<br><br>

        <span><i>Please contact the NEQAS Office for clarifications<br>
        DIRECT BANK DEPOSITS WILL NOT BE ACCEPTED</i></span>
      </td>
    </tr>
  </tbody>
</table>
<span style="font-size:12px;"><b>National External Quality Assessment Scheme<br>
Research Institute for Tropical Medicine</b><br>
9002 Research Drive, DOH Compound, Filinvest Corporate City<br>
Alabang, Muntinlupa City</span>

<table cellspacing="0" id="table_top">
	<tbody>
		<tr>
			<td style="width:500px;padding:0">
        <p><b><u>NATIONAL EXTERNAL QUALITY ASSESSMENT SCHEME (NEQAS)</u></b></p>
        <span style="font-size:13px;">for Bacteriology, Parasitology, Mycobacteriology and Transfusion<br>
        Transmissible Infections</span><br>
        <span style="font-size:12px;"><b>Department of Health<br>
        Research Institute for Tropical Medicine</b></span>
			</td>
      <td style="padding:0; text-align:right;">
        <img src="src/img/DOH.png" height=70 width=70>
      </td>
      <td style="width:5px;padding:0; text-align:right;">
        <img src="src/img/RITM-Logo.png" height=100 width=100>
      </td>
		</tr>
	</tbody>
</table>

<table cellspacing="0" id="table_details">
  <thead>
    <tr>
      <th colspan="4">ATTESTATION</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td colspan="4" style="font-size:11px;">
        <p style="text-align:justify;">I, the undersigned, performing the laboratory testing must attest to the incorporation of the NEQAS analytes
           into the routine laboratory workload and that the testing of the NEQAS analytes shall be done using the
           laboratory’s standard operating procedures.
        </p><br>
        <p style="text-align:justify;">I also attest that the laboratory testing of the NEQAS analytes shall neither be referred to nor done in another
            laboratory other than the laboratory that enrolled in the NEQAS program and that I should sign the Laboratory Result Form.
        </p><br><br>
        <!-- <b>TESTING PERSONNEL:</b><br><br> -->
      </td>
    </tr>
    <!-- <tr>
      <td colspan="2"><b>BACTERIOLOGY</b></td>
      <td colspan="2"><?= strtoupper($bac_personnel);?></td>
    </tr>
    <tr>
      <td colspan="2"><b>PARASITOLOGY</b></td>
      <td colspan="2"><?= strtoupper($para_personnel);?></td>
    </tr>
    <tr>
      <td colspan="2"><b>MYCOBACTERIOLOGY - TB MICROSCOPY</b></td>
      <td colspan="2"><?= strtoupper($tbmicro_personnel);?></td>
    </tr>
    <tr>
      <td colspan="2"><b>MYCOBACTERIOLOGY - TB CULTURE</b></td>
      <td colspan="2"><?= strtoupper($tbculture_personnel);?></td>
    </tr>
    <tr>
      <td colspan="2"><b>TRANSFUSION TRANSMISSIBLE INFECTIONS</b></td>
      <td colspan="2"><?= strtoupper($TTI_personnel);?></td>
    </tr> -->
    <tr>
      <td colspan="4" style="font-size:11px;">
        <br><br>
        <span><?= strtoupper($noted_by);?></span><br>
        <span><b>PATHOLOGY-LABORATORY HEAD</b></span><br><br>

        <b>DATE</b><br>
        <span><?= strtoupper($date_by);?></span>
      </td>
    </tr>
  </tbody>
</table>
<span style="font-size:12px;"><b>National External Quality Assessment Scheme<br>
Research Institute for Tropical Medicine</b><br>
9002 Research Drive, DOH Compound, Filinvest Corporate City<br>
Alabang, Muntinlupa City</span>

</body>
