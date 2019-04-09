<?php 
add_image_size("blog-image",350,200,true);
function twentyseventeen_scripts() {
	//css
	wp_enqueue_style( 'custom-css', get_stylesheet_directory_uri() . '/css/custom.css');
	wp_enqueue_style( 'jqueryui-css', get_stylesheet_directory_uri() . '/css/jquery-ui.css');
	//js
	wp_enqueue_script( 'jquery-validate', get_stylesheet_directory_uri() . '/js/jquery.validate.min.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'jqueryui-js', get_stylesheet_directory_uri() . '/js/jquery-ui.min.js', array( 'jquery' ), '1.0', true );
	wp_enqueue_script( 'custom-js', get_stylesheet_directory_uri() . '/js/custom.js', array( 'jquery' ), '1.0', true );
	wp_enqueue_script( 'sweetalert-js', get_stylesheet_directory_uri() . '/js/sweetalert.min.js', array( 'jquery' ), '1.0', true );
	wp_localize_script( 'custom-js', 'screenReaderText', array(
		'admin_ajax'   =>admin_url("admin-ajax.php"),
		'collapse' => __( 'collapse child menu', 'twentysixteen' ),
		) ); 
}
add_action( 'wp_enqueue_scripts', 'twentyseventeen_scripts' );

function register_action(){
	$user_pass = wp_generate_password( 12, false );
	$username = $_POST['name'];
	$father_name = $_POST['father_name'];
	$street = $_POST['street'];
	$building = $_POST['building'];
	$block = $_POST['block'];
	$flat = $_POST['flat'];
	$area = $_POST['area'];
	$governorate = $_POST['governorate'];
	$gender = $_POST['gender'];
	$transport = $_POST['transport'];
	$email = $_POST['email'];
	$aemail = $_POST['aemail'];
	$dob = $_POST['dob'];
	$mobno = $_POST['mobno'];
	$resno = $_POST['resno'];
	$offno = $_POST['offno'];
	$civilid = $_POST['civilid'];
	$passport = $_POST['passport'];
	$bgroup = $_POST['bgroup'];
	$schoolname = $_POST['schoolname'];
	$classname = $_POST['classname'];
	$occupation = $_POST['occupation'];
	$ibakno = $_POST['ibakno'];
	$ibaktype = $_POST['ibaktype'];
	$week = $_POST['week'];
	$coachinglevel = $_POST['coachinglevel'];
	$tshirt = $_POST['tshirt'];
	$payment = $_POST['payment'];
	$amount = $_POST['amount'];
	$userimage = $_FILES['userimage']; 
	$civilidcopy = $_FILES['civilidcopy'];
	$passportcopy = $_FILES['passportcopy'];
	  //echo $civilidcopy; exit();
	
	if($username !='' && $father_name != '' && $email !='' ){

		$userdata = array(
			'user_login' => $email,
			'user_email' => $email,
			'user_pass' => $user_pass,
			'role' => 'editor'
			);

		$user_id = wp_insert_user( $userdata );
		//print_r($user_id);exit;
	}
	if ( is_wp_error( $user_id ) ) {
		echo "error";
		exit;
	}else{
		echo $user_id;
	}
	
// if ( !$user_id) {
// 	 $errors = '<strong>ERROR</strong>: Couldn&#8217;t register you... please check detail';

// }

	$uploaddir = wp_upload_dir();
	$file = $userimage['name'];

	$target_path = $_SERVER['DOCUMENT_ROOT'] .'/ibak/wp-content/uploads/' . basename($_FILES['userimage']['name']);
	move_uploaded_file($_FILES['userimage']['tmp_name'], $target_path);
	$filename = basename( $file );

	$wp_filetype = wp_check_filetype(basename($target_path), null );

	$attachment = array(
		'post_mime_type' => $wp_filetype['type'],
		'post_title' => preg_replace( '/\.[^.]+$/', '', basename( $target_path ) ),
		'post_content' => '',
		'post_status' => 'inherit',
		'menu_order' => $_i + 1000
		);
	$attach_id = wp_insert_attachment( $attachment, $target_path );
	set_post_thumbnail( $user_id, $attach_id );
//civili copy
	$file1 = $civilidcopy['name'];
	$target_path1 = $_SERVER['DOCUMENT_ROOT'] .'/ibak/wp-content/uploads/' . basename($_FILES['civilidcopy']['name']);
	move_uploaded_file($_FILES['civilidcopy']['tmp_name'], $target_path1);
	$filename1 = basename( $file1 );

	$wp_filetype1 = wp_check_filetype(basename($target_path1), null );

	$attachment1 = array(
		'post_mime_type' => $wp_filetype1['type'],
		'post_title' => preg_replace( '/\.[^.]+$/', '', basename( $target_path1 ) ),
		'post_content' => '',
		'post_status' => 'inherit',
		'menu_order' => $_i + 1000
		);
	$attach_id1 = wp_insert_attachment( $attachment1, $target_path1 );
	set_post_thumbnail( $user_id, $attach_id1 );

//passport copy
	$file2 = $passportcopy['name'];
	$target_path2 = $_SERVER['DOCUMENT_ROOT'] .'/ibak/wp-content/uploads/' . basename($_FILES['passportcopy']['name']);
	move_uploaded_file($_FILES['passportcopy']['tmp_name'], $target_path2);
	$filename2 = basename( $file2 );

	$wp_filetype2 = wp_check_filetype(basename($target_path2), null );

	$attachment2 = array(
		'post_mime_type' => $wp_filetype2['type'],
		'post_title' => preg_replace( '/\.[^.]+$/', '', basename( $target_path2 ) ),
		'post_content' => '',
		'post_status' => 'inherit',
		'menu_order' => $_i + 1000
		);
	$attach_id2 = wp_insert_attachment( $attachment2, $target_path2 );
	set_post_thumbnail( $user_id, $attach_id2 );


	update_user_meta( $user_id, 'first_name', $username );
	update_user_meta( $user_id, 'student_name', $username );
	update_user_meta( $user_id, 'father_mother_name', $father_name );
	update_user_meta( $user_id, 'street_name_no', $street );
	update_user_meta( $user_id, 'building_name', $building );
	update_user_meta( $user_id, 'block_name', $block );
	update_user_meta( $user_id, 'flat_name', $flat);
	update_user_meta( $user_id, 'area', $area );
	update_user_meta( $user_id, 'governorate', $governorate );
	update_user_meta( $user_id, 'gender', $gender );
	update_user_meta( $user_id, 'transport', $transport );
	update_user_meta( $user_id, 'email', $email );
	update_user_meta( $user_id, 'alternative_email', $aemail );
	update_user_meta( $user_id, 'dob', $dob );
	update_user_meta( $user_id, 'mobile_number', $mobno );
	update_user_meta( $user_id, 'residency_phone_number', $resno );
	update_user_meta( $user_id, 'office_phone_number', $offno );
	update_user_meta( $user_id, 'civilid', $civilid );
	update_user_meta( $user_id, 'passport', $passport );
	update_user_meta( $user_id, 'bgroup', $bgroup );
	update_user_meta( $user_id, 'school_name', $schoolname );
	update_user_meta( $user_id, 'class_name', $classname );
	update_user_meta( $user_id, 'father_occupation', $occupation );
	update_user_meta( $user_id, 'ibak_membership_number', $ibakno );
	update_user_meta( $user_id, 'ibak_membership_type', $ibaktype );
	update_user_meta( $user_id, 'week', $week );
	update_user_meta( $user_id, 'coaching_level', $coachinglevel );
	update_user_meta( $user_id, 'tshirt_size', $tshirt );
	update_user_meta( $user_id, 'payment_details', $payment );
	update_user_meta( $user_id, 'amount', $amount );
	update_user_meta( $user_id, 'userimage', $attach_id );
	update_user_meta( $user_id, 'civilidcopy', $attach_id1 );
	update_user_meta( $user_id, 'passportcopy', $attach_id2 );
	$reg_no=get_option('regnumber');
	if($reg_no==''){
		$reg_no=0;
	}
	$reg_no=$reg_no+1;
	update_option('regnumber',$reg_no);
	$regno=date('Y').date('m').'000'.$reg_no;
	update_user_meta( $user_id, 'reg_no',$regno );
//
	$key = rand();
	$link=get_permalink(1291).'?key='.$key.'&userid='.$user_id;
	$pdflink = 'http://zillionweb.com/ibak/pdf/?key='.$key.'&userid='.$user_id;
	update_user_meta( $user_id, 'key',  $key );
	$to = $_POST['email'];
	$subject = "Registration";
	$message = "Hello ".$username.',';
	$message .="<br/>";
	$message .="Thanks for your registration!";
	$message .="<br/>";
	$message .="Please click on below given link to activate your account.";
	$message .="<br/>";
/*$message .="Activation link :<a href='".$link."'>Click Here</a>";
$message .="<br/>";*/
$message .="Activation link :<a href='".$pdflink."'>Click Here</a>";
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <ibak@yopmail.com>' . "\r\n";
$headers .= 'Cc: ibak@yopmail.com' . "\r\n";

mail( $to,$subject,$message,$headers);
die();
}
add_action( 'wp_ajax_register_action', 'register_action' );
add_action( 'wp_ajax_nopriv_register_action', 'register_action' );

function update_user_action(){
	$user_id = $_REQUEST['uid'];
	$username = $_POST['name']; 
	$father_name = $_POST['father_name'];
	$street = $_POST['street'];
	$building = $_POST['building'];
	$block = $_POST['block'];
	$flat = $_POST['flat'];
	$area = $_POST['area'];
	$governorate = $_POST['governorate'];
	$gender = $_POST['gender'];
	$transport = $_POST['transport'];
	$email = $_POST['email'];
	$aemail = $_POST['aemail'];
	$dob = $_POST['dob'];
	$mobno = $_POST['mobno'];
	$resno = $_POST['resno'];
	$offno = $_POST['offno'];
	$civilid = $_POST['civilid'];
	$passport = $_POST['passport'];
	$bgroup = $_POST['bgroup'];
	$schoolname = $_POST['schoolname'];
	$classname = $_POST['classname'];
	$occupation = $_POST['occupation'];
	$ibakno = $_POST['ibakno'];
	$ibaktype = $_POST['ibaktype'];
	$week = $_POST['week'];
	$coachinglevel = $_POST['coachinglevel'];
	$tshirt = $_POST['tshirt'];
	$payment = $_POST['payment'];
	$amount = $_POST['amount'];
	$userimage = $_FILES['userimage'];
	$civilidcopy = $_FILES['civilidcopy'];
	$passportcopy = $_FILES['passportcopy'];
	if($username !='' && $father_name != '' && $email !='' ){

		$userdata = array(
			'ID' => $user_id, 
			'user_login' => $email,
			'user_email' => $email,
			'user_pass' => $user_pass,
			'first_name'    =>   $username,
			'role' => 'editor'
			);
		$user_id = wp_update_user($userdata);
	}
	echo $user_id;

	$uploaddir = wp_upload_dir();
	$file = $userimage['name'];
	if($file!=''){
		$target_path = $_SERVER['DOCUMENT_ROOT'] .'/ibak/wp-content/uploads/' . basename($_FILES['userimage']['name']);
		move_uploaded_file($_FILES['userimage']['tmp_name'], $target_path);
		$filename = basename( $file );

		$wp_filetype = wp_check_filetype(basename($target_path), null );

		$attachment = array(
			'post_mime_type' => $wp_filetype['type'],
			'post_title' => preg_replace( '/\.[^.]+$/', '', basename( $target_path ) ),
			'post_content' => '',
			'post_status' => 'inherit',
			'menu_order' => $_i + 1000
			);
		$attach_id = wp_insert_attachment( $attachment, $target_path );
		set_post_thumbnail( $user_id, $attach_id );
		update_user_meta( $user_id, 'userimage', $attach_id );
	}
//civilidcopy
	$file1 = $civilidcopy['name'];
	if($file1!=''){
		$target_path1 = $_SERVER['DOCUMENT_ROOT'] .'/ibak/wp-content/uploads/' . basename($_FILES['civilidcopy']['name']);
		move_uploaded_file($_FILES['civilidcopy']['tmp_name'], $target_path1);
		$filename = basename( $file1 );

		$wp_filetype1 = wp_check_filetype(basename($target_path1), null );

		$attachment1 = array(
			'post_mime_type' => $wp_filetype1['type'],
			'post_title' => preg_replace( '/\.[^.]+$/', '', basename( $target_path1 ) ),
			'post_content' => '',
			'post_status' => 'inherit',
			'menu_order' => $_i + 1000
			);
		$attach_id1 = wp_insert_attachment( $attachment1, $target_path1 );
		set_post_thumbnail( $user_id, $attach_id1 );
		update_user_meta( $user_id, 'civilidcopy', $attach_id1 );
	}

//passportcopy
	$file2 = $passportcopy['name'];
	if($file2!=''){
		$target_path2 = $_SERVER['DOCUMENT_ROOT'] .'/ibak/wp-content/uploads/' . basename($_FILES['passportcopy']['name']);
		move_uploaded_file($_FILES['passportcopy']['tmp_name'], $target_path1);
		$filename = basename( $file2 );

		$wp_filetype2 = wp_check_filetype(basename($target_path2), null );

		$attachment2 = array(
			'post_mime_type' => $wp_filetype2['type'],
			'post_title' => preg_replace( '/\.[^.]+$/', '', basename( $target_path2 ) ),
			'post_content' => '',
			'post_status' => 'inherit',
			'menu_order' => $_i + 1000
			);
		$attach_id2 = wp_insert_attachment( $attachment2, $target_path2 );
		set_post_thumbnail( $user_id, $attach_id2 );
		update_user_meta( $user_id, 'passportcopy', $attach_id2 );
	}

	update_user_meta( $user_id, 'student_name', $username );
	update_user_meta( $user_id, 'father_mother_name', $father_name );
	update_user_meta( $user_id, 'street_name_no', $street );
	update_user_meta( $user_id, 'building_name', $building );
	update_user_meta( $user_id, 'block_name', $block );
	update_user_meta( $user_id, 'flat_name', $flat);
	update_user_meta( $user_id, 'area', $area );
	update_user_meta( $user_id, 'governorate', $governorate );
	update_user_meta( $user_id, 'gender', $gender );
	update_user_meta( $user_id, 'transport', $transport );
	update_user_meta( $user_id, 'email', $email );
	update_user_meta( $user_id, 'alternative_email', $aemail );
	update_user_meta( $user_id, 'dob', $dob );
	update_user_meta( $user_id, 'mobile_number', $mobno );
	update_user_meta( $user_id, 'residency_phone_number', $resno );
	update_user_meta( $user_id, 'office_phone_number', $offno );
	update_user_meta( $user_id, 'civilid', $civilid );
	update_user_meta( $user_id, 'passport', $passport );
	update_user_meta( $user_id, 'bgroup', $bgroup );
	update_user_meta( $user_id, 'school_name', $schoolname );
	update_user_meta( $user_id, 'class_name', $classname );
	update_user_meta( $user_id, 'father_occupation', $occupation );
	update_user_meta( $user_id, 'ibak_membership_number', $ibakno );
	update_user_meta( $user_id, 'ibak_membership_type', $ibaktype );
	update_user_meta( $user_id, 'week', $week );
	update_user_meta( $user_id, 'coaching_level', $coachinglevel );
	update_user_meta( $user_id, 'tshirt_size', $tshirt );
	update_user_meta( $user_id, 'payment_details', $payment );
	update_user_meta( $user_id, 'amount', $amount );



/*$to = $email = $_POST['email'];
$subject = "Registration";
$message = "Hello";
// Always set content-type when sending HTML email
$message .="Thanks for your registration! your application is pending review for approval from coaching committee. Email will be sent on the application status to your registered email ID within 48 hrs. 
If you have any clarification, call us at 97889437.";
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <ibak@yopmail.com>' . "\r\n";
$headers .= 'Cc: ibak@yopmail.com' . "\r\n";*/
//mail( $to,$subject,$message,$headers);


die();
}
add_action( 'wp_ajax_update_user_action', 'update_user_action' );
add_action( 'wp_ajax_nopriv_update_user_action', 'update_user_action' );

function login_action(){
	$creds = array();
	$creds['user_login'] = $_REQUEST['username'];
	$creds['user_password'] = $_REQUEST['password'];
	$creds['remember'] = true;
	$user = wp_signon( $creds, false );
	//echo $user->ID;
	//echo '<pre>';
	//print_r($user);
	//$test= 'jksjadhkj';
	if ( is_wp_error($user) ){
		echo "error";
	}
	else{
		echo $user->ID;
	}
	die();
}
add_action( 'wp_ajax_login_action', 'login_action' );
add_action( 'wp_ajax_nopriv_login_action', 'login_action' );

/*add_action('edit_user_profile_update', 'update_extra_profile_fields');
add_action( 'personal_options_update', 'update_extra_profile_fields' );

function update_extra_profile_fields($user_id) {
	$approved= $_REQUEST['acf']['field_5a4ca9ecaa1a1'][0];

	$all_meta_for_user = get_user_meta( $user_id );
	var_dump($all_meta_for_user);  exit;	  
	$username=$all_meta_for_user['first_name'][0] ;
	$user_pass = wp_generate_password( 12, false );
	if($approved == 'approve'){
		wp_set_password( $user_pass, $user_id );
		require_once __DIR__.'/demo.php';
		$file = get_stylesheet_directory() . '/savepdf/application_form_'.$user_id.'.pdf';
		$attachment = chunk_split(base64_encode($file));		

		$to = $all_meta_for_user['email'][0];
		$subject = "Registration";
		$message = "Hello ".$username.',';
		$message .= "\r\n";
		$message .="Your UserName : ".$username;
		$message .="\r\n";
		$message .="Your  Password : ".$user_pass;
		$headers = '';
		wp_mail( $to, $subject, $message,  $headers = '', $attachments = array($file) );
		//die();
	}
}*/
function finish_reg_action(){
	$user_id=$_REQUEST['uid'];
	$key = get_user_meta( $user_id,'verify',true);
	if($key!='yes'){
		echo 'noverify';exit;
	}
 	/*print_r($key);
 	die();*/
 	$email = $_REQUEST['email'];
 	$to = $email;
 	$subject = "Registration";
 	$message = "Hello";
    // Always set content-type when sending HTML email
 	$message .="Thanks for your registration! your application is pending review for approval from coaching committee. Email will be sent on the application status to your registered email ID within 48 hrs. 
 	If you have any clarification, call us at 97889437.";
 	$headers = "MIME-Version: 1.0" . "\r\n";
 	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

	// More headers
 	$headers .= 'From: <ibak@yopmail.com>' . "\r\n";
 	$headers .= 'Cc: ibak@yopmail.com' . "\r\n";

 	mail( $to,$subject,$message,$headers);
 	die();
 }
 add_action( 'wp_ajax_finish_reg_action', 'finish_reg_action' );
 add_action( 'wp_ajax_nopriv_finish_reg_action', 'finish_reg_action' );

 /*function governorate_area(){
 	$governorate = $_POST['governorate'];
 	var_dump($governorate);exit;
 	$Capital = array("Kuwait City", "Dasmān", "Sharq", "Dasma","Da'iya","Sawābir","Mirgāb","Jibla","Salhiya","Bneid il-Gār","Keifan","Mansūriya","Abdullah as-Salim suburb","Nuzha","Faiha'","Shamiya","Rawda","Adiliya","Khaldiya","Qadsiya","Qurtuba","Surra","Yarmūk","Shuwaikh","Rai","Ghirnata","Sulaibikhat","Doha","Nahdha","Jabir al-Ahmad City","Qairawān");

 	$Hawalli = array("Hawally", "Rumaithiya", "Jabriya", "Salmiya","Mishrif","Sha'ab","Bayān","Bi'di'","Nigra","Salwa","Maidan Hawalli","Mubarak aj-Jabir suburb","South Surra","Hittin");

 	$Mubarak = array("Mubarak al-Kabeer", "Adān", "Qurain", "Qusūr","Sabah as-Salim suburb","Misīla","Abu 'Fteira","Sabhān","Fintās","Funaitīs");

 	$Ahmadi = array("Ahmadi", "Aqila", "Zuhar", "Miqwa'","Mahbula","Rigga","Hadiya","Abu Hulaifa","Sabahiya","Mangaf","Fahaheel","Wafra","Zoor","Khairan","Abdullah Port","Agricultural Wafra","Bneidar","Jilei'a","Jabir al-Ali Suburb","Fahd al-Ahmad Suburb","Shu'aiba","Sabah al-Ahmad City","Nuwaiseeb","Khairan City","Ali as-Salim suburb","Sabah al-Ahmad Nautical City");
 	
 	if($governorate == 'Capital'){
 		foreach ($Capital as $key => $value) {
 			?>
 			<option value='<?php echo $value;?>' ><?php echo $value;?></option>
 			<?php
 		}
 	}
 	if($governorate == 'Hawalli'){
 		foreach ($Hawalli as $key => $value) {
 			?>
 			<option value='<?php echo $value;?>' ><?php echo $value;?></option>
 			<?php
 		}
 	}
 	if($governorate == 'Mubarak al-Kabeer'){
 		foreach ($Mubarak as $key => $value) {
 			?>
 			<option value='<?php echo $value;?>' ><?php echo $value;?></option>
 			<?php
 		}
 	}
 	if($governorate == 'Ahmadi'){
 		foreach ($Ahmadi as $key => $value) {
 			?>
 			<option value='<?php echo $value;?>' ><?php echo $value;?></option>
 			<?php
 		}
 	}
 	die();
 }
 add_action( 'wp_ajax_governorate_area', 'governorate_area' );
 add_action( 'wp_ajax_nopriv_governorate_area', 'governorate_area' );*/
 function area_detail(){
 	$area = $_POST['area'];
 	$Capital = array("Kuwait City", "Dasmān", "Sharq", "Dasma","Da'iya","Sawābir","Mirgāb","Jibla","Salhiya","Bneid il-Gār","Keifan","Mansūriya","Abdullah as-Salim suburb","Nuzha","Faiha'","Shamiya","Rawda","Adiliya","Khaldiya","Qadsiya","Qurtuba","Surra","Yarmūk","Shuwaikh","Rai","Ghirnata","Sulaibikhat","Doha","Nahdha","Jabir al-Ahmad City","Qairawān");

 	 $Hawalli = array("Hawally", "Rumaithiya", "Jabriya", "Salmiya","Mishrif","Sha'ab","Bayān","Bi'di'","Nigra","Salwa","Maidan Hawalli","Mubarak aj-Jabir suburb","South Surra","Hittin");

 	 $Mubarak = array("Mubarak al-Kabeer", "Adān", "Qurain", "Qusūr","Sabah as-Salim suburb","Misīla","Abu 'Fteira","Sabhān","Fintās","Funaitīs");

 	 $Ahmadi = array("Ahmadi", "Aqila", "Zuhar", "Miqwa'","Mahbula","Rigga","Hadiya","Abu Hulaifa","Sabahiya","Mangaf","Fahaheel","Wafra","Zoor","Khairan","Abdullah Port","Agricultural Wafra","Bneidar","Jilei'a","Jabir al-Ali Suburb","Fahd al-Ahmad Suburb","Shu'aiba","Sabah al-Ahmad City","Nuwaiseeb","Khairan City","Ali as-Salim suburb","Sabah al-Ahmad Nautical City");
 	 if(in_array($area, $Capital)){
 	 	?>
	<option value='Capital' <?php  if($governorate == 'Capital') { echo 'selected'; }  else { } ?>>Capital</option>
 	 	<?php
 	 }
 	 if(in_array($area, $Hawalli)){
 	 	?>
	<option value='Hawalli' >Hawalli</option>
 	 	<?php
 	 }if(in_array($area, $Mubarak)){
 	 	?>
	<option value='Mubarak' >Mubarak</option>
 	 	<?php
 	 }if(in_array($area, $Ahmadi)){
 	 	?>
	<option value='Ahmadi' >Ahmadi</option>
 	 	<?php
 	 } 	
 	die();
 }
 add_action( 'wp_ajax_area_detail', 'area_detail' );
 add_action( 'wp_ajax_nopriv_area_detail', 'area_detail' );
 /* custom menu page */
 add_action( 'admin_menu', 'addCustomMenuItem' );
 function addCustomMenuItem(){
 	$page_title = 'IBAK';
 	$menu_title = 'IBAK Users List';
 	$capability = 'manage_options';
 	$parent_slug = 'userlist';
 	add_menu_page($page_title, $menu_title, $capability, $parent_slug, 'pg_building_function',Null,48);
 	add_submenu_page($parent_slug, $page_title . " - Edit Users", 'Edit Users', $capability, $parent_slug . "-edit-user","pg_building_function_edit" );
}//end addCustomMenuItem function.
function pg_building_function(){
	if(!current_user_can('manage_options')){
	//wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}//end if user is allowed.
//add any form processing code here in PHP:
	?>
	<div>
		<h1 style="text-align:center; margin-top:30px;"><span style="position:relative;top:-7px">Approved Users List</span></h1>
		<?php
		$blogusers = get_users();
		?>
		<table border="2" width="100%" style="text-align:center;">
			<tr>
				<th>Username</th>
				<th>Email</th>
				<th>Date</th>
				<th>Action</th>
			</tr>
			<?php 
			foreach ( $blogusers as $user ){
				$usermeta = get_user_meta($user->ID, 'verify', true);
				$usermetaall = get_user_meta($user->ID); 
				$user = get_userdata( $user->ID );
				if($usermeta != ''){
			//var_dump($usermeta);
			echo '<tr>';
			echo '<td>';
			echo '<span>' . esc_html( $user->user_login ) . '</span>';
			echo '</td>';
			echo '<td>';
			echo '<span>' . esc_html( $user->user_email ) . '</span>';
			echo '</td>';
			echo '<td>';
			echo '<span>' . esc_html( $user->user_registered ) . '</span>';
			echo '</td>';
			echo '<td>';
			echo '<a href="admin.php?page=userlist-edit-user&id='.$user->ID.'">Edit</a>';
			echo '&nbsp&nbsp&nbsp';
			echo '<a onclick="myFunction('.$user->ID.')"  href="javascriprt:void(0);" data-id="'.$user->ID.'">View Pdf</a>';
			echo '</td>';
			echo '</tr>';
		}
	} ?>
</table>
<style>
	/* The Close Button */
	.close1 {
		color: #000000;
		float: right;
		font-size: 28px;
		font-weight: bold;
	}

	.close1:hover,.close1:focus {
		color: #000;
		text-decoration: none;
		cursor: pointer;
	}
	/* The Modal (background) */
	.modal1 {
		display: none; /* Hidden by default */
		position: absolute; /* Stay in place */
		z-index: 999; /* Sit on top */
		padding-top: 82px; /* Location of the box */
		left: 0;
		top: 0;
		width: 100%; /* Full width */
		height: 100%; /* Full height */
		/*overflow: auto;*/ /* Enable scroll if needed */
		background-color: rgb(0,0,0); /* Fallback color */
		background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
	}
	/* Modal Content */
	.modal-content1 {
		position: relative;
		background-color: #fefefe;
		margin: auto;
		padding: 0;
		border: 1px solid #888;
		width: 88%;
		height: 100%;
		overflow-y: scroll;
		box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
		-webkit-animation-name: animatetop;
		-webkit-animation-duration: 0.4s;
		animation-name: animatetop;
		animation-duration: 0.4s
	}
</style>
<!-- The Modal -->
<div id="myModal1" class="modal1">
	<!-- Modal content -->
	<div class="modal-content1">
		<div class="modal-header">
			<span class="close1">&times;</span>
		</div>
		<div class="ibakpdf" style="margin: 0 auto;text-align: center;display: block;margin-top: 5%;width: 80%; margin-bottom: 50px; ">
			<?php /* ajax content will display here */?>
		
			</div>
		</div>
	</div>
	<script>
	// Get the modal
		var modal1 = document.getElementById('myModal1');
        function myFunction(id) {
        	var ids = id;
        	var ajaxurl = '<?php echo admin_url('admin-ajax.php') ?>';
        	jQuery.post({
	            url: ajaxurl,
	            type: 'post',
	            data: {
	                    action : 'myusermodel',
	                    uid : ids
	                },
	            success: function(data) {
	                    jQuery('div.ibakpdf').html(data); 
	                    jQuery('#myModal1').show();
	            },
	            error: function(jqXHR, textStatus, errorThrown) {
	                alert(errorThrown);
	            }
    		});
    	}    	
	</script>
	<script>
		// Get the <span> element that closes the modal
		var span1 = document.getElementsByClassName("close1")[0];
		// When the user clicks on <span> (x), close the modal
		span1.onclick = function() { 
			modal1.style.display = "none";
		}
		// Get the modal
		var modal1 = document.getElementById('myModal1');
		// When the user clicks anywhere outside of the modal, close it
		window.onclick = function(event) {
			if (event.target == modal1) {
				modal1.style.display = "none";
			}
		}
	</script>
	<?php
}
function myusermodel(){ 
	$uid = $_POST['uid'];
	$user = get_userdata( $uid);
	$attchement_id=get_user_meta($uid, 'userimage', true);
	$image=wp_get_attachment_url($attchement_id);
	$father_name = get_field('father_mother_name','user_'.$uid);
	$street_name=get_field('street_name_no','user_'.$uid);
	$building_name=get_field('building_name','user_'.$uid);
	$block_name=get_field('block_name','user_'.$uid);
	$flat_name=get_field('flat_name','user_'.$uid);
	$class_name=get_field('class_name','user_'.$uid);
	$gender = get_field('gender','user_'.$uid);
	$transport = get_field('transport','user_'.$uid);
	$dob = get_field('dob','user_'.$uid);
	$civilid = get_field('civilid','user_'.$uid);
	$passport = get_field('passport','user_'.$uid);
	$bgroup = get_field('bgroup','user_'.$uid);
	$school_name=get_field('school_name','user_'.$uid);
	$father_occupation=get_field('father_occupation','user_'.$uid);
	$alternative_email=get_field('alternative_email','user_'.$uid);
	$mobile_number=get_field('mobile_number','user_'.$uid);
	$residency_phone_number=get_field('residency_phone_number','user_'.$uid);
	$office_phone_number=get_field('office_phone_number','user_'.$uid);
	$ibak_membership_number=get_field('ibak_membership_number','user_'.$uid);
	$ibak_membership_type=get_field('ibak_membership_type','user_'.$uid);
	$coaching_level=get_field('coaching_level','user_'.$uid);
	$amount=get_field('amount','user_'.$uid);
	$tshirt_size=get_field('tshirt_size','user_'.$uid);
	$week=get_field('week','user_'.$uid);
	$week1 = str_replace(array('[',']','"'), '', $week);
	$reg_no=get_field('reg_no','user_'.$uid);
	$governorate=get_field('governorate','user_'.$uid);
	$area=get_field('area','user_'.$uid);
?>
	<table style="margin: 0 auto;width: 50%;"  cellspacing="0" cellpadding="10">
				<tr style="text-align:center;">
					<td><img src="<?php echo site_url();?>/wp-content/uploads/2018/01/ibakk.png" style="width:160px; padding-top:10px;"></td>
					<td><img src="<?php echo get_stylesheet_directory_uri();?>/images/logomid.jpg" style="width:400px;">
						<p style="font-size: 25px; margin-top: -14px; margin-bottom: 0px;">INSPIRE - TRAIN - ACHIEVE</p></td>
						<td><img src="<?php echo get_stylesheet_directory_uri();?>/images/ibakpdf.png"></td>
					</tr>
				</table>
				<table border="1" style="margin: 0 auto;width: 100%;"  cellspacing="0" cellpadding="10">

					<tr>
						<td  rowspan="2" colspan="3" style="text-align:center;padding: 3%;font-size: 25px;font-weight: bold;">Registration Form-Badminton Coaching</td>
						<td style="padding: 7px;margin: 0;width: 10%;font-size: 13px;">Reg No.: <br>* IBAK use</td>
						<td colspan="2" style="padding: 0 86px 0 0;"><?php echo $reg_no;?></td>
					</tr>
					<tr>
					</tr>
					<tr>
						<td rowspan="2">Name:</td>
						<td style="border-bottom: none;text-align: center;text-decoration: underline;width: 230px">Participant</td>
						<td style="border-bottom: none;text-align: center;text-decoration: underline;">Parent</td>
						<td colspan="2" rowspan="7" style="text-align:center"><img style="width:100%" src="<?php echo $image; ?>"></td>
					</tr>
					<tr>
						<td style="background-color: #ffc04c;border-top: none !important;padding: 20px;"><?php echo $user->user_firstname;  ?></td>
						<td style="background-color: #ffc04c;border-top: none !important;padding: 20px;"><?php echo $father_name;?></td>
					</tr>
					<tr>
						<td rowspan="2" colspan="3"  style="width:62px;border-right: none;">
							<span style="width: 100%;display: inline-block;float: left;margin-top: 5%;"> Address:
								<p style="padding: 10px;margin-top: -24px;width: 86%;float: right;"><?php echo "street:- ".$street_name.' , '."Building:- ".$building_name.' , '."Block:- ".$block_name.' , '."Flat:- ".$flat_name.' , '."Governorate:-".$governorate.' , '."Area:-".$area;?>
								</p>
							</span>
						</td>
					</tr>
					<tr>
					</tr>
					<tr>
						<td style="font-weight: bold;text-decoration: underline;border-right: none; text-align: center;">Particulars of Participant</td>

					</tr>
					<tr>
						<td style="width: 12%;">Gender</td>
						<td>Transport</td>
						<td>D.O.B</td>
					</tr>
					<tr>
						<td><?php echo $gender; ?></td>
						<td><?php echo $transport; ?></td>
						<td style="border-top: none;"><?php echo $dob; ?></td>

					</tr>
					<tr>
						<td  style="border-right: none;width: 38%;">
							<span style="width: 100%;display: inline-block;float: left;">Civil id # 
								<p style="background-color: #ffc04c;padding: 10px;"><?php echo $civilid; ?></p>
							</span>
						</td>

						<td  style="border-right: none;width: 36%;"><span style="width: 100%;display: inline-block;float: left;">Passport #:<p style="background-color: #ffc04c;padding: 10px;"><?php echo $passport; ?> </p></span></td>

						<td colspan="3" style="width: 24%;">
							<span style="width: 100%;display: inline-block;float: left;">Blood Group :<p style="background-color: #ffc04c;padding: 10px;"><?php echo $bgroup; ?></p></span>
						</td>
					</tr>
					<tr>
						<td colspan="2" style="border-bottom: none; text-align:center;text-decoration: underline">Class & School</td>
						<td colspan="3" style="border-bottom: none;text-align:center;text-decoration: underline">Occupation / Employer (Parent)</td>
					</tr>
					<tr>
						<td colspan="2" style="border-top: none;"><p style="padding: 10px;"><?php echo "Class Name:- ".$class_name.' , '."School Name:- ".$school_name;?></p></td>
						<td colspan="3" style="border-top: none;"><p style="padding: 10px;"><?php echo $father_occupation;?></p></td>

					</tr>
					<tr><td colspan="5" style="font-weight:bold;text-decoration:underline">Email ID</td></tr>
					<tr>
						<td style="border-right: none;">Primary:</td>
						<td style="border-left: none;"><p style="background-color: #ffc04c; border-color: #ffc04c; padding: 10px;" class="email"><?php echo $user->user_email;  ?></p></td>
						<td  style="border-right: none;">Alternative:</td>
						<td colspan="2" style="border-left: none;"><p style="padding: 10px;"><?php echo $alternative_email;?></p>
						</td>
					</tr>
					<tr><td colspan="5" style="font-weight:bold;text-decoration:underline">Contact numbers</td></tr>
					<tr>
						<td  style="border-right: none;width: 38%;"><span style="width: 100%;display: inline-block;float: left;">Mob: <p style="background-color: #ffc04c;padding: 10px;display: inline-block;width: 70%;"><?php echo $mobile_number;?></p></span></td>

						<td  style="border-right: none;width: 36%;"><span style="width: 100%;display: inline-block;float: left;">Res: <p style="background-color: #ffc04c;padding: 10px;display: inline-block;width: 70%;"><?php echo $residency_phone_number; ?></p></span></td>

						<td colspan="3" style="width: 24%;"><span style="width: 100%;display: inline-block;float: left;">Off: <p style="background-color: #ffc04c;padding: 10px;display: inline-block;width: 70%;"><?php echo  $office_phone_number; ?></p></span></td>

					</tr>
					<tr>
						<td  style="border-right: none;width: 38%;">IBAK Membership Type & No</td>
						<td colspan="4"><?php echo $ibak_membership_type .' & '.$ibak_membership_number;?></td>
					</tr>
					<tr>
						<td  style="border-right: none;width: 38%;">
							<span style="width: 100%;display: inline-block;float: left;">Payment Details: 
								<?php echo get_user_meta($userid, 'payment', true);?>
							</span>
						</td>

						<td  style="border-right: none;width: 36%;"><span style="width: 100%;display: inline-block;float: left;">Amount:<p style="padding: 10px;display: inline-block;width: 60%;margin: 0;"><?php echo $amount; ?></p>(KWD)</span></td>

						<td colspan="3" width: 24%;">
							<span style="width: 100%;display: inline-block;float: left;">Coaching Levels: 
								<?php echo $coaching_level;?>
							</span>
						</td>

					</tr>
					<tr>
						<td  style="border-right: none;width: 38%;">Preferred days (3 days/Week) </td>
						<td  style="border-right: none;width: 36%;">
							<span style="width: 100%;display: inline-block;float: left;font-size: 16px;">
								<?php echo $week1; ?>
							</span>
						</td>

						<td colspan="3" style="width: 24%;">
							<span style="width: 100%;display: inline-block;float: left;">T-shirt size: 
								<?php echo $tshirt_size;?>
							</span>
						</td>
					</tr>
					<tr>
						<td  colspan="3" style="border-right: none;width: 38%;">By signing the form I understand accept the terms and conditions below. <br>
							<span style="width: 100%;display: inline-block;float: left;">Applicant (Parent) Signature:<p style="display: inline-block;width: 56%;margin-left: 14px;padding: 3%;border-bottom: 1px solid black;"></p></span>
						</td>
						<td colspan="2" style="padding: 7px;text-align: center;">Date <br>
							<span style="width: 100%;display: inline-block;float: left;"><p style="display: inline-block;width: 51%;margin-left: 14px;padding: 8%;border-bottom: 1px solid black;"></p></span>
						</td>
					</tr>
				</table>
<?php	
}
add_action( 'wp_ajax_myusermodel', 'myusermodel' );
add_action( 'wp_ajax_nopriv_myusermodel', 'myusermodel' );
/* edit user*/
function pg_building_function_edit(){
$userid = $_GET['id']; 
$userlist = get_userdata( $userid );
$coaching_level = get_field('coaching_level','user_'.$userid);
$dob = get_field('dob','user_'.$userid);
# object oriented
$from = new DateTime($dob);
$to   = new DateTime('today');
	echo "<center><h1>Student Progress Report</h1></center>";
	echo "<h3>User Email:".$userlist->user_email."</h3>";
	echo "<h3>Coaching Level:".$coaching_level."</h3>";
	echo "<h3>Age:".$from->diff($to)->y."</h3>";
	//echo 'Approve:-<input type="checkbox" value ="" name="approve[]" />';
	?>
	<style>
		/*#page-content.sprogress form input[type=text].small{
			width: 50px;
		}*/
		#page-content.sprogress form input[type=textarea]{
			width: 100%;
		}
		#page-content.sprogress form .sprogress_button{
		    text-align: center;
			padding-top: 10px;
			padding-bottom: 10px;
		}
		.apreject{
			text-align: center;
		}
		.apreject input#areject{
			margin-left: 15px;
		}
		.apreject lable {
			font-size: 15px;
    		font-weight: 500;
    		padding-right: 10px;
		}
	</style>
<script>
	jQuery(function() {
		jQuery('.apreject input.user_approve').on('change', function() {
    jQuery('.apreject input.user_approve').not(this).prop('checked', false);
    });
		jQuery('#areject').on('submit',function(e) {
			e.preventDefault();
    		//alert("test");
        jQuery.post({
        url: '<?php echo admin_url('admin-ajax.php') ?>',
        type: 'post',
        data: {
                action : 'approveuser',
                approve : jQuery('#approveck').val(),
                reject : jQuery('#rejectck').val(),
                uid : jQuery('#uid').val()
            },
        success: function(data) {
                //jQuery('#area').html(data);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });
});
});
</script>
	<form action ='' method= 'post' id='areject'>
	<div class='apreject'>
		<input type='checkbox' name='approve' value='approve' id='approveck' class="user_approve"><lable>Approve</lable>
		<input type='checkbox' name='reject' value='reject' id='rejectck' class="user_approve"><lable>Reject</lable>
		<input type="hidden" name="uid" id="uid" value="<?php echo $userid = $_GET['id']; ?> ">
		<input type='submit' name='submit' id="" value='submit'>
	</div>
	</form>
	<section id="page-content" class="sprogress">
	<div class="block-posts register">
		<div class="container">
			<h2 class="blogtitle registertitle"><span class="orange-text"><?php the_title(); ?> </span></h2>
			<div class="row">	
				<div class="col-md-12">				
					<form action="" method="post" id="sprogress_report">
					<div class="boxed-form">
							<div class="row">
							<center><h1>Score Card</h1></center>	
								<div class="table-wrap timingtable" style="padding:15px 15px 0px 15px; margin-top:30px;">
									<table class="table-2" border="2" align="center" width="80%">
										<tbody>
											<tr class="">
												<th style="font-size: 25px;" colspan="3">Student Name</th>
												<td colspan="5"><?php echo "<h3 style='padding-left: 25px;'>".$userlist->user_email."</h3>" ?></td>
											</tr>
											<tr class="">
												<th style="font-size: 25px;" colspan="3">Student Age</th>
												<td colspan="5"><?php echo "<h3 style='padding-left: 25px;'>".$from->diff($to)->y."</h3>"?></td>
											</tr>
											<tr class="orange-text p-gray" height="40px">
												<th width="50px">Parameter</th>
												<th width="50px">March</th>
												<th width="50px">June</th>
												<th width="50px">September</th>
												<th width="50px">December</th>
												<th width="50px">Mistakes</th>
												<th width="50px">Remarks</th>
											</tr>
											<tr>
												<th scope="row" class="orange-text p-gray">Service</th>
												<td width="50px"><input type="text" name="mar_service" id="mar_service" class="small"></td>
												<td width="50px"><input type="text" name="june_service" id="june_service" class="small"></td>
												<td width="50px"><input type="text" name="sep_service" id="sep_service" class="small"></td>
												<td width="50px"><input type="text" name="dec_service" id="dec_service" class="small"></td>
												<td width="50px"><input type="text" name="mist_service" id="mist_service" class="small"></td>
												<td width="150px"><input type="text" name="remark_service" id="remark_service"></td>
											</tr>
											<tr>
												<th scope="row" class="orange-text p-gray">Tossing</th>
												<td width="50px"><input type="text" name="mar_tossing" id="mar_tossing" class="small"></td>
												<td width="50px"><input type="text" name="june_tossing" id="june_tossing" class="small"></td>
												<td width="50px"><input type="text" name="sep_tossing" id="sep_tossing" class="small"></td>
												<td width="50px"><input type="text" name="dec_tossing" id="dec_tossing" class="small"></td>
												<td width="50px"><input type="text" name="mist_tossing" id="mist_tossing" class="small"></td>
												<td width="150px"><input type="text" name="remark_tossing" id="remark_tossing"></td>
											</tr>
											<tr>
												<th scope="row" class="orange-text p-gray">Strokes</th>
												<td width="50px"><input type="text" name="mar_strokes" id="mar_strokes" class="small"></td>
												<td width="50px"><input type="text" name="june_strokes" id="june_strokes" class="small"></td>
												<td width="50px"><input type="text" name="sep_strokes" id="sep_strokes" class="small"></td>
												<td width="50px"><input type="text" name="dec_strokes" id="dec_strokes" class="small"></td>
												<td width="50px"><input type="text" name="mist_strokes" id="mist_strokes" class="small"></td>
												<td width="150px"><input type="text" name="remark_strokes" id="remark_strokes"></td>
											</tr>
											<tr>
												<th scope="row" class="orange-text p-gray">Stamina</th>
												<td width="50px"><input type="text" name="mar_stamina" id="mar_stamina" class="small"></td>
												<td width="50px"><input type="text" name="june_stamina" id="june_stamina" class="small"></td>
												<td width="50px"><input type="text" name="sep_stamina" id="sep_stamina" class="small"></td>
												<td width="50px"><input type="text" name="dec_stamina" id="dec_stamina" class="small"></td>
												<td width="50px"><input type="text" name="mist_stamina" id="mist_stamina" class="small"></td>
												<td width="150px"><input type="text" name="remark_stamina" id="remark_stamina"></td>
											</tr>
											<tr>
												<th scope="row" class="orange-text p-gray">Foot Work</th>
												<td width="50px"><input type="text" name="mar_footwork" id="mar_footwork" class="small"></td>
												<td width="50px"><input type="text" name="june_footwork" id="june_footwork" class="small"></td>
												<td width="50px"><input type="text" name="sep_footwork" id="sep_footwork" class="small"></td>
												<td width="50px"><input type="text" name="dec_footwork" id="dec_footwork" class="small"></td>
												<td width="50px"><input type="text" name="mist_footwork" id="mist_footwork" class="small"></td>
												<td width="150px"><input type="text" name="remark_footwork" id="remark_footwork"></td>
											</tr>
											<tr>
												<th scope="row" class="orange-text p-gray">Exercise</th>
												<td width="50px"><input type="text" name="mar_exercise" id="mar_exercise" class="small"></td>
												<td width="50px"><input type="text" name="june_exercise" id="june_exercise" class="small"></td>
												<td width="50px"><input type="text" name="sep_exercise" id="sep_exercise" class="small"></td>
												<td width="50px"><input type="text" name="dec_exercise" id="dec_exercise" class="small"></td>
												<td width="50px"><input type="text" name="mist_exercise" id="mist_exercise" class="small"></td>
												<td width="150px"><input type="text" name="remark_exercise" id="remark_exercise"></td>
											</tr>
											<tr class="p-gray" height="40px">
												<th style="font-size: 25px;" colspan="8">Rating</th>
											</tr>
											<tr class="orange-text" height="40px">
											<th style="font-size: 25px;" colspan="8">
												1-Poor, 2-Average, 3-Good, 4-Very Good, 5-Excellent
											</th>
											</tr>
											<tr>
												<td colspan="8"><center><input  type="submit" value="Submit Report" class="btn btn-link-w" id="submit-report">
												<input type="hidden" name="uid" id="uid" value="<?php echo $userid = $_GET['id']; ?> ">
											</tr>
											<tr class="p-gray" height="30px">
												<th style="font-size: 25px;" colspan="8" >Comments</th>
											</tr>	
										</tbody>
									</table>
								</div>								
							</div>
						</div>
					</form>
					<div class="table-wrap timingtable coach_commentlist" style="border:2px solid; border-top: none!important; float:none; margin:0 auto; width:1040px;">
						<?php 
						global $wpdb;
						$comments = $wpdb->get_results( "SELECT * FROM wp_coachreview where user_id ='$userid' ORDER BY ID " );
						foreach ( $comments as $print )   {
						?>
						<div style="padding-left:5px;"><strong><?php echo $print->reviwer."Comment";?></strong></div>
						<div class="scrollable" style="border-bottom:1px solid hsl(0, 0%, 87%); word-wrap: break-word; padding: 5px 10px 5px 10px;"><?php echo $print->comment;?></div>
						<?php } ?>
					</div>
					<div class="table-wrap timingtable" style="padding:15px 15px 15px 15px; margin-top:30px;margin-bottom:30px;">						
						<form method="post" id="coachpreviewform">
							<table class="table-3" align="center" width="80%" style="border:none;">
								<tbody>
									<tr class="p-gray" style="border:1px solid;">
										<th style="font-size: 20px;" colspan="8" >Coach Review Form</th>
									</tr>
									<tr>
										<td colspan="8"><textarea rows="4" cols="140" id="coachreview"></textarea></td>
									</tr>
									<tr>
										<td colspan="2"><center><input  type="submit" value="Submit Detail" class="btn btn-link-w" id="submit-sprogress">
										<input type="hidden" name="uid" id="uid" value="<?php echo $userid = $_GET['id']; ?> ">
										<input type="hidden" name="reviewer" id="reviewer" value="<?php echo 'Coach'; ?> "></center></td>
									</tr>
								</tbody>
							</table>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	</section>
	<script>
		jQuery(function() {
    		jQuery('#sprogress_report').on('submit',function(e) {
    			e.preventDefault(); 
	        	jQuery.post({
	            url: '<?php echo admin_url('admin-ajax.php') ?>',
	            type: 'post',
	            data: {
	                    action : 'progress_report',
	                    formdata : jQuery(this).serialize()
	                },
	            success: function(data) {
	            		jQuery("#sprogress_report")[0].reset();
	                    
	            },
	            error: function(jqXHR, textStatus, errorThrown) {
	                alert(errorThrown);
	            }
	        });
         });
     });
	</script>
	<script>
		 jQuery(function() {
    		jQuery('#submit-sprogress').on('click',function(e) {
    			e.preventDefault(); 
	        	jQuery.post({
	            url: '<?php echo admin_url('admin-ajax.php') ?>',
	            type: 'post',
	            data: {
	                    action : 'student_progress_detail',
	                    coachreview : jQuery('#coachreview').val(),
	                    reviewer : jQuery('#reviewer').val(),
	                    userid : jQuery('#uid').val()
	                },
	            success: function(data) {
	            		jQuery("#coachpreviewform")[0].reset();
	                    jQuery('.coach_commentlist').append( '<div class="scrollable" style="border-bottom:1px solid hsl(0, 0%, 87%); word-wrap: break-word; padding: 5px 10px 5px 5px;"><b>Coach Comment</b>'+"<br/>"+" "+data+"<br/>"+"</div>");
	            },
	            error: function(jqXHR, textStatus, errorThrown) {
	                alert(errorThrown);
	            }
	        });
         });
     });
	</script>
<?php
}
/* remove submenu page from admin bar */
add_action( 'admin_head', function(){
    remove_submenu_page( 'userlist', 'userlist-edit-user' );
});

/* login logout */
add_filter( 'wp_nav_menu_items', 'wti_loginout_menu_link', 10, 2 );

function wti_loginout_menu_link( $items, $args ) {
   if ($args->theme_location == 'primary') {
      if (is_user_logged_in()) {
         $items .= '<li><a href="'. wp_logout_url(get_permalink(1177)) .'">'. __("Log Out") .'</a></li>';
      } else {
         $items .= '<li><a href="'. get_permalink(1177) .'">'. __("Log In") .'</a></li>';
      }
   }
   return $items;
}
function approveuser(){
	$approved = $_REQUEST['approve'];
	$user_id = trim($_REQUEST['uid']);
	$all_meta_for_user = get_user_meta( $user_id );	
	var_dump($all_meta_for_user);  exit;
	$username=$all_meta_for_user['first_name'][0] ;
	$user_pass = wp_generate_password( 12, false );
	if($approved == 'approve'){
		wp_set_password( $user_pass, $user_id );
		require_once __DIR__.'/demo.php';
		$file = get_stylesheet_directory() . '/savepdf/application_form_'.$user_id.'.pdf';
		$attachment = chunk_split(base64_encode($file));

		$to = $all_meta_for_user['email'][0];
		$subject = "Registration";
		$message = "Hello ".$username.',';
		$message .= "\r\n";
		$message .="Your UserName : ".$username;
		$message .="\r\n";
		$message .="Your  Password : ".$user_pass;
		$headers = '';
		wp_mail( $to, $subject, $message,  $headers = '', $attachments = array($file) );
		die();
	}
}
add_action( 'wp_ajax_approveuser', 'approveuser' );
add_action( 'wp_ajax_nopriv_approveuser', 'approveuser' );
//
function student_progress_detail(){
	$c_review = $_POST['coachreview'];
	$reviewer = $_REQUEST['reviewer'];
	$user_id = $_REQUEST['userid'];
	if(isset($_POST['coachreview'])) {
		global $wpdb;
		$c_review = $_POST['coachreview'];
		$reviewer = $_REQUEST['reviewer'];
		$user_id = $_REQUEST['userid'];
		if($wpdb->insert(
        'wp_coachreview',
        array(
                'user_id' => $user_id,
                'reviwer' => $reviewer,
                'comment' =>$c_review
            )
) == false) wp_die('Database Insertion failedd'); else echo $c_review;
	}
	die();
}
add_action( 'wp_ajax_student_progress_detail', 'student_progress_detail' );
add_action( 'wp_ajax_nopriv_student_progress_detail', 'student_progress_detail' );

function parent_review(){
	if(isset($_POST['parent_review'])) {
		global $wpdb;
		$user_id = $_REQUEST['userid'];
		$p_review = $_POST['parent_review'];
		$reviewer = $_REQUEST['reviewer'];
		if($wpdb->insert(
        'wp_coachreview',
        array(
                'user_id' => $user_id,
                'reviwer' => $reviewer,
                'comment' =>$p_review
            )
) == false) wp_die('Database Insertion failed'); else echo $p_review;
	}

	die();
}
add_action( 'wp_ajax_parent_review', 'parent_review' );
add_action( 'wp_ajax_nopriv_parent_review', 'parent_review' );

function progress_report(){
	parse_str($_POST['formdata'], $searcharray);
	//print_r($searcharray); // Only for print array
	$id =$searcharray['uid'];
	$user_id = str_replace(' ', '', $id);
	$mar_service = $searcharray['mar_service'];
	$june_service = $searcharray['june_service'];
	$sep_service = $searcharray['sep_service'];
	$dec_service = $searcharray['dec_service'];
	$mist_service = $searcharray['mist_service'];
	$remark_service = $searcharray['remark_service'];

	$mar_tossing = $searcharray['mar_tossing'];
	$june_tossing = $searcharray['june_tossing'];
	$sep_tossing = $searcharray['sep_tossing'];
	$dec_tossing = $searcharray['dec_tossing'];
	$mist_tossing = $searcharray['mist_tossing'];
	$remark_tossing = $searcharray['remark_tossing'];

	$mar_strokes = $searcharray['mar_strokes'];
	$june_strokes = $searcharray['june_strokes'];
	$sep_strokes = $searcharray['sep_strokes'];
	$dec_strokes = $searcharray['dec_strokes'];
	$mist_strokes = $searcharray['mist_strokes'];
	$remark_strokes = $searcharray['remark_strokes'];

	$mar_stamina = $searcharray['mar_stamina'];
	$june_stamina = $searcharray['june_stamina'];
	$sep_stamina = $searcharray['sep_stamina'];
	$dec_stamina = $searcharray['dec_stamina'];
	$mist_stamina = $searcharray['mist_stamina'];
	$remark_stamina = $searcharray['remark_stamina'];

	$mar_footwork = $searcharray['mar_footwork'];
	$june_footwork = $searcharray['june_footwork'];
	$sep_footwork = $searcharray['sep_footwork'];
	$dec_footwork = $searcharray['dec_footwork'];
	$mist_footwork = $searcharray['mist_footwork'];
	$remark_footwork = $searcharray['remark_footwork'];

	$mar_exercise = $searcharray['mar_exercise'];
	$june_exercise = $searcharray['june_exercise'];
	$sep_exercise = $searcharray['sep_exercise'];
	$dec_exercise = $searcharray['dec_exercise'];
	$mist_exercise = $searcharray['mist_exercise'];
	$remark_exercise = $searcharray['remark_exercise'];
	if(isset($user_id)){
		update_user_meta( $user_id, 'mar_service', $mar_service );
		update_user_meta( $user_id, 'june_service', $june_service );
		update_user_meta( $user_id, 'sep_service', $sep_service );
		update_user_meta( $user_id, 'dec_service', $dec_service );
		update_user_meta( $user_id, 'mist_service', $mist_service );
		update_user_meta( $user_id, 'remark_service', $remark_service );

		update_user_meta( $user_id, 'mar_tossing', $mar_tossing );
		update_user_meta( $user_id, 'june_tossing', $june_tossing );
		update_user_meta( $user_id, 'sep_tossing', $sep_tossing );
		update_user_meta( $user_id, 'dec_tossing', $dec_tossing );
		update_user_meta( $user_id, 'mist_tossing', $mist_tossing );
		update_user_meta( $user_id, 'remark_tossing', $remark_tossing );

		update_user_meta( $user_id, 'mar_strokes', $mar_strokes );
		update_user_meta( $user_id, 'june_strokes', $june_strokes );
		update_user_meta( $user_id, 'sep_strokes', $sep_strokes );
		update_user_meta( $user_id, 'dec_strokes', $dec_strokes );
		update_user_meta( $user_id, 'mist_strokes', $mist_strokes );
		update_user_meta( $user_id, 'remark_strokes', $remark_strokes );

		update_user_meta( $user_id, 'mar_stamina', $mar_stamina );
		update_user_meta( $user_id, 'june_stamina', $june_stamina );
		update_user_meta( $user_id, 'sep_stamina', $sep_stamina );
		update_user_meta( $user_id, 'dec_stamina', $dec_stamina );
		update_user_meta( $user_id, 'mist_stamina', $mist_stamina );
		update_user_meta( $user_id, 'remark_stamina', $remark_stamina );

		update_user_meta( $user_id, 'mar_footwork', $mar_footwork );
		update_user_meta( $user_id, 'june_footwork', $june_footwork );
		update_user_meta( $user_id, 'sep_footwork', $sep_footwork );
		update_user_meta( $user_id, 'dec_footwork', $dec_footwork );
		update_user_meta( $user_id, 'mist_footwork', $mist_footwork );
		update_user_meta( $user_id, 'remark_footwork', $remark_footwork );

		update_user_meta( $user_id, 'mar_exercise', $mar_exercise );
		update_user_meta( $user_id, 'june_exercise', $june_exercise );
		update_user_meta( $user_id, 'sep_exercise', $sep_exercise );
		update_user_meta( $user_id, 'dec_exercise', $dec_exercise );
		update_user_meta( $user_id, 'mist_exercise', $mist_exercise );
		update_user_meta( $user_id, 'remark_exercise', $remark_exercise );

	}
	die();
}
add_action( 'wp_ajax_progress_report', 'progress_report' );
add_action( 'wp_ajax_nopriv_progress_report', 'progress_report' );
