<?php
namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use Spatie\ArrayToXml\ArrayToXml;

class OdkCentral extends ResourceController
{
	/**
	 * Return an array of resource objects, themselves in array format
	 *
	 * @return mixed
	 */
	 public function ctest(){
		 $pp='$2y$10$zvjgt.F5hjFHaBWa70W6bOab9jDuJWm.RFnTysN3bENnJyRu1OSai';
		 $p1="1234";
		 echo password_verify($p1,$pp);
		 //echo password_hash("1234", PASSWORD_DEFAULT);
	 }
	public function index()
	{
		$odk = service('odkcentral');

		$project = $odk->projects(2)->get();
		$form = $odk->projects(2)->forms('household')->get();
		echo "<pre>";
		print_r($project);
		print_r($form);
	}

	public function users(){
		echo "<pre>";
		$OdkCentral = service('odkcentral');
		// Get all users.
		//$users = $OdkCentral->users()->get();
		//print_r($users);
		// Searching users
		//$users = $OdkCentral->users('Rakesh')->get();
		//print_r($users);

		// You can also use eloquent 💥
		//$users = $OdkCentral->users()->get()->sortBy('displayName');
		//print_r($users);
		// Creating a new user.
		/*$user = $OdkCentral->users()->create([
			'email' => 'niranjan@kmail.com',
			'password' => '1234' // Optional (That email address will receive a message instructing the new user on how to claim their new account and set a password.)
		]);*/
		//print_r($user);
		// Getting User details
		//$user = $OdkCentral->users(5)->get();
		//print_r($user);
		// Getting authenticated User details
		//$user = $OdkCentral->users()->current();
		//print_r($user);
		
		// Modifying a User
		/*$user = $OdkCentral->users(5)->update([
		'displayName' => 'NiranjanSahoo', // string
		'email' => 'niranjan@wassan.org' // string
		]);
		print_r($user);
		*/
		// Directly updating a user password
		/*$user = $OdkCentral->users(20)->updatePassword([
		'old' => '2345', // string
		'new' => '123456' // string
		]);
		print_r($user);*/
		// Initiating a password reset
		//$user = $OdkCentral->users()->passwordReset("niranjan@wassan.org");
		//print_r($user);*/
		// Deleting a User
		//$user = $OdkCentral->users(20)->delete();
		//print_r($user);
	}

	public function appuser(){
		echo "<pre>";
		$OdkCentral = service('odkcentral');
		
		// Listing all App Users.
		$appUsers = $OdkCentral->projects(2)->appUsers()->get();
		print_r($appUsers);

		// Creating a new App User.
		/*$appUser = $OdkCentral->projects(2)->appUsers()->create([
		'displayName' => 'Jane Doe'
		]);
		print_r($appUser);*/

		// Deleting a App User
		//$appUser = $OdkCentral->projects(2)->appUsers(7)->delete();
		//print_r($appUser);
	}
	public function projects(){
		echo "<pre>";
		$OdkCentral = service('odkcentral');
		// Get a list of projects.
		$projects = $OdkCentral->projects()->get();
		print_r($projects);
		
		// Creating a Project.
		/*$project = $OdkCentral->projects()->create([
		  'name' => 'My new project'
		]);
		print_r($project);*/
		// Getting Project details
		/*$project = $OdkCentral->projects(3)->get();
		print_r($project);*/
		// Updating Project Details
		/*$project = $OdkCentral->projects(3)->update([
		  'name' => 'New name', // string | required
		  'archived' => false // boolean | optional
		]);
		print_r($project);*/
		// Deep Updating Project and Form Details
		/*$project = $OdkCentral->projects(3)->deepUpdate([
		  'name' => 'New name', // string | required
		  'archived' => false, // boolean | optional
		  'forms' => [
			{
			  "xmlFormId": "simple",
			  "state": "open",
			  "assignments": [
				{
				  "roleId": 2,
				  "actorId": 14
				}
			  ]
			},
		  ], // array | infos : https://odkcentral.docs.apiary.io/#reference/project-management/projects/deep-updating-project-and-form-details
		]);
		print_r($project);*/
		// Enabling Project Managed Encryption
		/*$project = $OdkCentral->projects(3)->encrypt([
		  'passphrase' => 'Super duper secret', // string | required
		  'hint' => 'My reminder' // string | optional
		]);
		print_r($project);*/
		// Deleting a Project
		//$project = $OdkCentral->projects(3)->delete();
		//print_r($project);
	}
	
	public function form(){
		echo "<pre>";
		$OdkCentral = service('odkcentral');
		$form = $OdkCentral->projects(2)->forms('household')->get();
		print_r($form);
		// List all forms of a project.
		//$forms = $OdkCentral->projects(2)->forms()->get();
		//print_r($forms);
		// Creating new form (sending XForms XML or XLSForm file)
		// If the second parameter is set to false, the form will be stored as draft.
		//$form = $OdkCentral->projects(2)->forms()->create($request->file('your_input_file'), true);
		//print_r($forms);
		// Getting form details
		//$form = $OdkCentral->projects(2)->forms('household')->get();
		//print_r($form);
		// Getting form fields
		//$form = $OdkCentral->projects(2)->forms('household')->fields();
		//print_r($form);
		// Listing form attachments
		//$form = $OdkCentral->projects(2)->forms('household')->attachments()->get();
		//print_r($form);
		// Downloading a form attachment
		//$form=$OdkCentral->projects(2)->forms('household')->downloadAttachment('itemsets.csv');
		//print_r($form);
		
		// Getting form shema fields
		/*$form = OdkCentral::projects($projectId)->forms($xmlFormId)->fields()->get();

		// Modifying a form
		$form = OdkCentral::projects($projectId)->forms($xmlFormId)->update([
		  'state' => 'open'
		]);

		// Deleting a form
		$form = OdkCentral::projects($projectId)->forms($xmlFormId)->delete();

		// Download form file (xml, xls, xlsx)
		return OdkCentral::projects($projectId)->forms($xmlFormId)->xlsx()->download(); // xml(), xls(), xlsx()
		*/
	}
	
	public function draft(){
		// Let's say we already have our form
		$form = OdkCentral::projects($projectId)->forms($xmlFormId);

		// Create a new draft
		$form->draft()->create($request->file('your_input_file'));

		// Getting Draft Form Details
		$form->draft()->get();

		// Getting Draft Form Fields
		$form->draft()->fields();

		// Publish the draft
		$form->draft()->publish('v1.2.0'); // string | optional

		// Deleting the draft
		$form->draft()->delete();
	}

	public function manualsubmit(){
        $xmldata='<?xml version="1.0" ?><data id="farmer_module_test" version="2021121306" xmlns:h="http://www.w3.org/1999/xhtml" xmlns:jr="http://openrosa.org/javarosa" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:ev="http://www.w3.org/2001/xml-events" xmlns:orx="http://openrosa.org/xforms" xmlns:odk="http://www.opendatakit.org/xforms"><g1><block>D01B06</block><grampanchayat>D01B06G06</grampanchayat><village>D01B06G06V01</village><respondent>D01B06G06V01R09</respondent></g1><g2><fgps>18.6175396 82.562844 819.7 4.988</fgps><interviewer_name>abhishek</interviewer_name><interview_cdate>26-4-2022</interview_cdate><interview_date /><gender>female</gender><respondent_age>47</respondent_age><marital_status>married</marital_status><qualification>no_education</qualification></g2><crop>ragi_or_finger_millet little_millet</crop><g3_count>2</g3_count><g3><crop_name>1. Ragi or finger millet</crop_name><crop_name_data /><a11>yes</a11><sg><a12>1.0</a12><a13>no</a13><a14>9.0</a14><a15>4.0</a15><a16>5.0</a16><a17>22.0</a17></sg></g3><g3><crop_name>2. Little millet</crop_name><crop_name_data /><a11>yes</a11><sg><a12>0.5</a12><a13>no</a13><a14>4.0</a14><a15 /><a16>4.0</a16><a17>30.0</a17></sg></g3><a2>2021 2020</a2><g4_count>2</g4_count><g4><lockdown_name>2021 lockdown (May-Jul 2021)</lockdown_name><a21>sold stored</a21><a22>1__village_trader_middleman</a22><a23>no</a23><a24>4__kept_for_hh_consumption</a24><a25>3__home</a25><a26>no</a26></g4><g4><lockdown_name>2020 lockdown (Apr-Jun 2020)</lockdown_name><a21>sold stored</a21><a22>1__village_trader_middleman</a22><a23>no</a23><a24>4__kept_for_hh_consumption</a24><a25>3__home</a25><a26>no</a26></g4><a3>2021 2020</a3><g5_count>2</g5_count><g5><g5_lockdown_name>2021 lockdown (May-Jul 2021)</g5_lockdown_name><a31>8__no_support</a31><a32 /><a33>NA</a33><a34>no</a34><a36>3__about_the_same</a36></g5><g5><g5_lockdown_name>2020 lockdown (Apr-Jun 2020)</g5_lockdown_name><a31>8__no_support</a31><a32>5__pulverising</a32><a33>Machine could not be repaired in time during lockdown</a33><a34>no</a34><a36>3__about_the_same</a36></g5><a4>2021 2020</a4><g6_count>2</g6_count><g6><g6_lockdown_name>2021 lockdown (May-Jul 2021)</g6_lockdown_name><a41>1__own</a41><a42>NA</a42><a43>1__own_saving</a43><a44 /><a45>NA</a45><a46>3__weekly_market 2__local_trader</a46><a47 /><a48>1__own</a48><a49 /><a410>3__about_the_same</a410><a411>2__higher</a411></g6><g6><g6_lockdown_name>2020 lockdown (Apr-Jun 2020)</g6_lockdown_name><a41>1__own</a41><a42 /><a43>5__private_money_lender</a43><a44>5__others</a44><a44_other>Household requirements</a44_other><a45 /><a46>2__local_trader 3__weekly_market</a46><a47>Irregular haat made it difficult getting fertilizer</a47><a48>1__own</a48><a49 /><a410>4__lower</a410><a411>2__higher</a411></g6><mp><a412 /><FPO>Nari Shakti</FPO><Intermediary_Traders>Kangrapada shop (sold in small installments as barter for home ration</Intermediary_Traders><Processers>Village has a private mill and a pulverizer</Processers></mp><start>2022-03-21T17:06:31.731+05:30</start><end>2022-04-26T13:21:44.903+05:30</end><today>2022-03-21</today><username /><deviceid>collect:8W4Tn1S0e5Gzn6fA</deviceid><meta><instanceID>uuid:292987a0-2537-4386-b5d2-f7249691f37c</instanceID></meta></data>';

	    $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://central.milletsodisha.com/v1/projects/1/forms/farmer_module_test/submissions");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_POST, TRUE);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $xmldata);


        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/xml",
            "Authorization: Bearer b6iIYOVz3MKepuOR1mCgpFGCupygttrWbwZg!nR8NnpwZfqpvErUYqIQr7epHADo",

        ));

        $response = curl_exec($ch);
        curl_close($ch);

        var_dump($response);
    }

	public function stest(){
        $xmldata = '<?xml version="1.0" encoding="UTF-8"?>
				<data id="household">
					<orx:meta>
						<orx:deprecatedID>uuid:83cd8026-5aca-4e1b-8b27-af51bb104361</orx:deprecatedID>
						<orx:instanceID>uuid:83cd8026-5aca-4e1b-8b27-af51bb104361</orx:instanceID>
					</orx:meta>
					<gp2><female_member>Alice</female_member></gp2>
				</data>';



        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://central.milletsodisha.com/v1/projects/2/forms/household/submissions/uuid:83cd8026-5aca-4e1b-8b27-af51bb104361
        ");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");

        curl_setopt($ch, CURLOPT_POSTFIELDS, $xmldata);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
          "Content-Type: application/xml",
            "Authorization: Bearer !P7eeTleIU2cNh$3gqE4Tw0q2jR69CCQtyJDUlnCk2$!YDWwTX2wbTOy!CZui0W9",

        ));
        
        $response = curl_exec($ch);
        $info = curl_getinfo($ch);
       // print_r($info);
        curl_close($ch);
        $array_data = json_decode(json_encode(simplexml_load_string($response)), true);

        print_r($response);
    }
	
	public function xml(){
		$array = [
			'Good guy' => [
				'name' => 'Luke Skywalker',
				'weapon' => 'Lightsaber'
			],
			'Bad guy' => [
				'name' => 'Sauron',
				'weapon' => 'Evil Eye'
			]
		];

		$result = ArrayToXml::convert($array,'data');
		print_r($result);
		exit;
	}
	public function submission(){
		$OdkCentral = service('odkcentral');
		// Listing all submissions on a form
		$projectId=2;
		$xmlFormId="household";
		$instanceId="uuid:83cd8026-5aca-4e1b-8b27-af51bb104361";
		$deprecatedId="";
		$newinstanceId="";
		//$submissions = $OdkCentral->projects($projectId)->forms($xmlFormId)->submissions()->get();
		echo "<pre>";
		//print_r($submissions);
		// Getting Submission metadata
		//$submissions = $OdkCentral->projects($projectId)->forms($xmlFormId)->submissions($instanceId)->get();

		// Updating Submission metadata
		$submissions = $OdkCentral->projects($projectId)->forms($xmlFormId)->submissions($instanceId)->xmlUpdate(
		  '<?xml version="1.0" encoding="UTF-8"?>
				<data id="household">
					<orx:meta>
						<orx:deprecatedID>uuid:83cd8026-5aca-4e1b-8b27-af51bb104361</orx:deprecatedID>
						<orx:instanceID>uuid:83cd8026-5aca-4e1b-8b27-af51bb104361</orx:instanceID>
					</orx:meta>
					<gp2><female_member>Alice</female_member></gp2>
				</data>'
// null, edited, hasIssues, rejected, approved | enum
		);
		print_r($submissions);
		exit;

		// Retrieving Submission XML
		$submissions = $OdkCentral->projects($projectId)->forms($xmlFormId)->submissions($instanceId)->xml();
		print_r($submissions);
		exit;
		// Geting Submission comments
		$submissions = OdkCentral::projects($projectId)->forms($xmlFormId)->submissions($instanceId)->comments()->get();

		// Posting Submission comments
		$submission = OdkCentral::projects($projectId)->forms($xmlFormId)->submissions($instanceId)->comments()->create([
		  'body' => 'this is the text of my comment',
		]);
	}
	
	public function response(){
		// Our form
		$form = OdkCentral::projects($projectId)->forms($xmlFormId);

		// You can get answers directly :
		$answers = $form()->answers();
		// OR
		$anwserWithRepeats = $form()->answersWithRepeats();

		// If you need to get only answers associated to a submission :
		$answers = $form()->submissions($submissionId)->answers();
		// OR
		$anwserWithRepeats = $form()->submissions($submissionId)->answersWithRepeats();

		// answersWithRepeats() method accept a boolean parameter to only get the questions and responses (no meta, ids, etc)
		$onlyAnswers = $form()->submissions($submissionId)->answersWithRepeats(true);
	}
	
	public function odata(){
		$OdkCentral = service('odkcentral');
		// Listing all submissions on a form
		$projectId=1;
		$xmlFormId="farmer_module_test";
		// Our form
		$form = $OdkCentral->projects($projectId)->forms($xmlFormId);
		
		/**
		 * OData request.
		 *
		 * @param string $url
		 * @param boolean $top
		 * @param boolean $skip
		 * @param boolean $count
		 * @param boolean $wkt
		 * @param string $filter
		 * @param boolean $expand
		 */
        //$submissions = $form->odata($url= '', $top = false, $skip = false, $count = false, $wkt = false, $filter = '', $expand = false)->get();

        // Example :
		//$submissions = $form->odata('Submissions')->get();
        $parameter=[
            'top'=>10,

        ];
        $submissions = $form->pdata('Submissions',$parameter)->get();
       // $submissions = $form->odata('Submissions',10,0,'true')->get();
		echo "<pre>";
		print_r($submissions);
		
	}
	
	
	
}
