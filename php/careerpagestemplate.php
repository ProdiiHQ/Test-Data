<?php

class CareerpagesTemplate {
	
	// Do not change the constructor
	function __construct() {
	}
	
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/////                                                                  ///////////////////////////////////////////////////////////
	/////  Careerpages template Dublin ini                                 ///////////////////////////////////////////////////////////
	/////                                                                  ///////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	public static function getIni() {
		$ini = array();
		
		$ini["styles"] = self::getStyles();
		$ini["scripts"] = self::getScripts();

		return $ini;
	}
	
	// Template specific styles
	public static function getStyles() {
		$styles = array(
			'cpdublin_awesomefonts_css' => 'css/all.min.css',
			'cpdublin_style' => 'css/careerpagestemplatedefault.css'
		);

		return $styles;
	}
	
	// Template specific scripts
	public static function getScripts() {
		$scripts = array(
			'cpdublin_template_script' => 'js/careerpagestemplate.js',
			'cpdublin_script' => 'js/cpdublin.js',
			'cpdublin_awesomecloud' => 'js/jquery.awesomeCloud-0.2.min.js',
			'cpdublin_ellipsis' => 'js/jquery.ellipsis.min.js',
			'cpdublin_brands' => 'js/brands.min.js',
			'cpdublin_solid' => 'js/solid.min.js',
			'cpjson_formatter' => 'js/json-formatter.js'
		);

		return $scripts;
	}
	
	// My template specific images
	public static function getImages() {
		$images = array(
			'company_image_placeholder' => 'image-placeholder900x600.png',
			'team_image_placeholder' => 'image-placeholder900x600.png',
			'profile_image_placeholder' => 'image-placeholder310x310.png',
			'circle_year' => 'circle-year.png',
			'company_tree' => 'company-tree.png',
			'globe_bg' => 'globe-bg.png',
			'header_bg' => 'header-bg.jpg',
			'section_laptop_bg' => 'section-laptop-bg.jpg'
		);

		return $images;
	}

	
	
	
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/////                                                                  ///////////////////////////////////////////////////////////
	/////  Careerpages template Dublin                                     ///////////////////////////////////////////////////////////
	/////                                                                  ///////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	public static function getLoaderGui() {
		$gui = 	'
				<div id="loading"><i class="fa fa-spinner fa-spin fa-3x"></i></div>
				';

		return $gui;
	}

	public static function getBreadcrumbGui($breadcrumbs) {
		$company = (!$breadcrumbs[0] && $breadcrumbs[1]) || (!$breadcrumbs[1] && !$breadcrumbs[2]);
		$companyactive = $breadcrumbs[0] && ($breadcrumbs[1] || $breadcrumbs[2]);
		$team = $breadcrumbs[1] && !$breadcrumbs[2];
		$teamactive = $breadcrumbs[1] && $breadcrumbs[2];
		$profile = $breadcrumbs[2] && ($breadcrumbs[0] || $breadcrumbs[1]);
		$profileactive = false;

		$gui =						'<div id="prd-breadcrumb" class="prd-cursor-default">';
		if($company) $gui .= 		'	<span class="prd-color-green">'.$breadcrumbs["company"].'</span>';
		if($companyactive) $gui .= 	'	<span class="prd-cursor-pointer prd-color-aquamarine" onclick="getCompanyHtml(\''.$breadcrumbs[0].'\');">'.($breadcrumbs["company"] ? $breadcrumbs["company"] : 'Company').'</span>';
		if($team) $gui .= 			'	<span class="prd-color-aquamarine prd-padding-left-5 prd-padding-right-5">/</span><span class="prd-color-green">'.$breadcrumbs["team"].'</span>';
		if($teamactive) $gui .= 	'	<span class="prd-color-aquamarine prd-padding-left-5 prd-padding-right-5">/</span><span class="prd-cursor-pointer prd-color-aquamarine" onclick="getTeamHtml(\''.$breadcrumbs[1].'\');">'.$breadcrumbs["team"].'</span>';
		if($profile) $gui .= 		'	<span class="prd-color-aquamarine prd-padding-left-5 prd-padding-right-5">/</span><span class="prd-color-green">'.$breadcrumbs["profile"].'</span>';
		if($profileactive) $gui .= 	'	<span class="prd-color-aquamarine prd-padding-left-5 prd-padding-right-5">/</span><span class="prd-cursor-pointer prd-color-aquamarine" onclick="getProfileHtml(\''.$breadcrumbs[2].'\');">'.$breadcrumbs["profile"].'</span>';
		$gui .= 					'</div>';

		return $gui;
	}

	public static function getCompany($companydata) {
		return '<pre>'.print_r($companydata, true).'</pre>';
	}

	public static function getNetwork($companydata) {
		return '<pre>'.print_r($companydata, true).'</pre>';
	}

	public static function getTeam($teamdata) {
		return '<pre>'.print_r($teamdata, true).'</pre>';
	}
	
	public static function getProfile($profiledata) {
		return '<pre>'.print_r($profiledata, true).'</pre>';
	}
	
	
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	///////                                ///////////////////////////////////////////////////////////////////////////////////////////
	///////  Company                       ///////////////////////////////////////////////////////////////////////////////////////////
	///////                                ///////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	
	public static function getCompanyheaderGui($companydata) {
		$gui = 	'
				<header id="prd-header" class="prd-padding-bottom-1">
					'.self::getBreadcrumbGui($companydata["breadcrumbs"]).'
					<div class="prd-container">
						<h1 class="prd-color-dark-blue">'.($companydata["basic"]["name"] ? strtoupper($companydata["basic"]["name"]) : '').'</h1>
					</div>
				</header>
				';
				
		return $gui;
	}
	
	public static function getCompanybasicGui($companydata) {
		global $templateImages;
		global $prodiiUrl;
		
		$medias = $companydata["medias"];
		
		if (isset($companydata["basic"]["address"]["addresscomponents"])) {
			$address = CareerpagesLibrary::getFormattedaddress($companydata["basic"]["address"]["addresscomponents"]);
		}

		$gui = 	'
				<section class="prd-aquamarine-bg prd-padding-top-30 prd-company-header-section">
					<div class="prd-container">
						<div class="prd-row">
							<div class="prd-col-xs-12">
								<h2 class="prd-margin-top-0 prd-margin-bottom-0 prd-text-white header">'.strtoupper($companydata["basic"]["shortdescription"]).'</h2>
								<p class="prd-lead prd-text-white">
									'.$companydata["basic"]["longdescription"].'
								</p>
							</div>	
						</div>	
						<div class="prd-row">
							<div class="prd-col-xs-12 prd-col-sm-6 prd-col-md-6 prd-col-lg-6">
								<p class="text-darker-blue prd-lead prd-company-city-text-pull">
									<i class="fas fa-map-marker-alt"></i> '.(isset($address["CI, CO"]) ? $address["CI, CO"] : '').' 
								</p>
							</div>
							<div class="prd-col-xs-12 prd-col-sm-6 prd-col-md-6 prd-col-lg-6">
								<ul class="prd-list-unstyled prd-list-inline prd-media-icons-lg prd-color-white-green">
						';
		$socialmedias = $companydata["socialmedias"];
		if (!empty($socialmedias)) {
			foreach ($socialmedias as $socialmedia) {
				$gui .=	'		
									<li>
										<a href="'.$socialmedia["url"].'" target="_blank" title="'.$medias[$socialmedia["mediaid"]]["alias"].'">
											<img src="'.$prodiiUrl.'/assets/img/'.$medias[$socialmedia["mediaid"]]["webicon"].'" class="fab"></i>
										</a>
									</li>
						';
			}
		}
		
		$contactperson = $companydata["basic"]["contactperson"];

		$gui .=	'
								</ul>
							</div> <!-- /.prd-col-md-10 -->

						</div> <!-- /.prd-row -->

					</div> <!-- /.prd-container -->
				</section>
								
				<div id="prd-highlighted-person-top" class="prd-highlighted-person prd-container">
					<section class="prd-aqua-bg">
						<div class="prd-row">
							<div class="prd-col-sm-3 prd-col-md-3">
								<img src="'.CareerpagesLibrary::getProfileimageurl($templateImages, $contactperson["basic"]["profileimage"]).'" alt="" class="prd-img-circle prd-cursor-pointer" onclick="getProfileHtml('.$contactperson["basic"]["id"].');">
							</div>
							<div class="prd-col-sm-9 prd-col-md-9">
								<h2 class=" prd-color-dark-blue prd-overflow">'.strtoupper($contactperson["basic"]["name"]).'</h2>
								<span class="prd-color-aquamarine">
									'.(isset($contactperson["currentposition"]) ? $contactperson["currentposition"]["title"] : '').'
								</span>

								<hr>
				';
		if ($contactperson["basic"]["email"] || $contactperson["basic"]["mobile"] || $contactperson["basic"]["phone"] || $contactperson["basic"]["skype"]) {
			$gui .=	'

								<ul class="prd-list-unstyled">
					';
			if ($contactperson["basic"]["email"]) {
				$gui .=	'
									<li class="prd-contact-row">
										<i class="fa fa-fw fa-envelope prd-color-aquamarine"></i>
										'.$contactperson["basic"]["email"].'
									</li>
						';
			}
			if ($contactperson["basic"]["mobile"]["number"]) {
				$gui .=	'
									<li class="prd-contact-row">
										<i class="fa fa-fw fa-phone prd-color-aquamarine"></i>
										('.$contactperson["basic"]["mobile"]["prefix"].') '.$contactperson["basic"]["mobile"]["number"].'
									</li>
						';
			} elseif ($contactperson["basic"]["phone"]["number"]) {
				$gui .=	'
									<li class="prd-contact-row">
										<i class="fa fa-fw fa-phone prd-color-aquamarine"></i>
										('.$contactperson["basic"]["phone"]["prefix"].') '.$contactperson["basic"]["phone"]["number"].'
									</li>
						';
			}
			if ($contactperson["basic"]["skype"]) {
				$gui .=	'
									<li class="prd-contact-row">
										<i class="fab fa-fw fa-skype prd-color-aquamarine"></i>
										live: '.$contactperson["basic"]["skype"].'
									</li>
						';
			}
			$gui .=	'
								</ul>
					';
		}
		$gui .=	'
							</div>
						</div>
					</section>
				</div>
				';
				
		return $gui;
	}
	
	public static function getCompanyskillsGui($companydata) {
		//global $skilllevels;
		$skilllevels = $companydata["skilllevels"];
		
		$wantedSkills = 6;

		$skills = array();
		$skillseval = array();
		$noofskilllevels = count($skilllevels);
		$convert2ptc = array();
		for ($i=1; $i<$noofskilllevels+1; $i++) {
			$convert2ptc[$i] = $noofskilllevels ? ($noofskilllevels + 1 - $i) * 100 / $noofskilllevels : 100 / $noofskilllevels;
			$skillseval[$i] = null;
		}

		foreach ($companydata["teams"] as $team) {
			foreach ($team["team"] as $profile) {
				foreach ($profile["skills"] as $skill) {
					$skill["pct"] = $convert2ptc[$skill["skilllevelsid"]];
					if (!isset($skills[$skill["name"]]) || (isset($skills[$skill["name"]]) && $skill["skilllevelsid"] < $skills[$skill["name"]]["skilllevelsid"])) $skills[$skill["name"]] = $skill;
				}
			}
		}

		foreach ($skills as $skill) {
			$skillseval[$skill["skilllevelsid"]][$skill["name"]] = $skill;
		}

		$gui = 	'
				<section class="prd-skills prd-padding-top-30 prd-padding-bottom-30">
					<div class="prd-container">
						<h2 class="prd-bordered-title prd-border-color-blue">
							<b class="prd-color-blue">'.gettext('OUR 6 TOP SKILLS').'</b>
							'./*<br>
							<span>?liquam congue sem at libero malesuada, eu placerat enim rutrum</span>*/''.'
						</h2>

						<div class="prd-padding-left-34">
							<ul class="prd-list-unstyled prd-row">
						';
						
		$wantedSkillCounter = 0;
		foreach($skillseval as $skills) {
			if (!empty($skills)) {
				foreach($skills as $skill) {
					$wantedSkillCounter++;
					$levelname = gettext($skilllevels[$skill["skilllevelsid"]]["name"]);
					$gui .= '
								<li class="prd-col-md-6">
									<span>'.$levelname.'<b>'.$skill["pct"].'%</b></span>
									<strong>'.$skill["name"].'</strong>
									<div class="prd-progress">
										<div class="prd-progress-bar" style="width: '.$skill["pct"].'%;"></div>
									</div>
								</li>
							';
					//if ($wantedSkillCounter >= $wantedSkills) break 2;
					if ($wantedSkillCounter >= $wantedSkills) break;
				}
			}
			if ($wantedSkillCounter >= $wantedSkills) break;
		}
		$gui .= '
							</ul>
						</div>
					</div>
				</section>
				';
				
		return $gui;
	}
	
	public static function getCompanyindustryGui($companydata) {
		$uniquepositions = array();
		foreach ($companydata["teams"] as $team) {
			foreach ($team["team"] as $profile) {
				foreach ($profile["positions"] as $position) {
					$uniquepositions[$position["id"]] = $position;
				}
			}
		}

		$industries = array();
		foreach ($uniquepositions as $uniqueposition) {
			$enddate = $uniqueposition["enddate"] ? $uniqueposition["enddate"] : time();
			if ($uniqueposition["industry"]) {
				if (isset($industries[$uniqueposition["industry"]])) {
					$industries[$uniqueposition["industry"]]["time"] += $enddate - $uniqueposition["startdate"];
				} else {
					$industries[$uniqueposition["industry"]]["time"] = $enddate - $uniqueposition["startdate"];
				}
			}
		}
		arsort($industries);
		$industryyears = array();
		foreach ($industries as $industryname => &$industry) {
			$time = CareerpagesLibrary::getDiffTime(1, $industry["time"] + 1);
			$industry["industry"] = $industryname;
			$industryyears[$time["intyear"] + 1][] = $industry;
		}
		$industryyears = array_slice ($industryyears, 0, 5, true);

		$gui = 	'
				<section class="prd-experience prd-blue-bg prd-text-white prd-padding-top-30 padding-bottom-30">
					<div class="prd-container">
						<h2 class="prd-bordered-title prd-text-white">
							'.gettext("OUR INDUSTRIAL EXPERIENCE").'
							'./*<span>?liquam congue sem at libero malesuada, eu placerat enim rutrum</span>*/''.'
						</h2>


						<ul class="prd-list-unstyled prd-list-inline prd-clearfix">
				';
		$index = 0;
		foreach ($industryyears as $years => $industryyear) {
			$industryColorclasses = self::getIndustryColorclasses($index);
			$gui .= '
							<li class="indusrtial-coin"><span class="prd-circle-year '.$industryColorclasses["bg"].' '.$industryColorclasses["color"].'"><b>'.$years.'</b>'.ngettext('Year', 'Years', $years).'</span></li>
					';
			$index++;
		}
		$gui .= '
						</ul>
						<div class="prd-row">

							<div class="prd-col-xs-12">
								<ul class="prd-list-unstyled prd-row prd-experience-texts">
				';
		$index = 0;
		foreach ($industryyears as $years => $industryyear) {
			$industryColorclasses = self::getIndustryColorclasses($index);
			foreach ($industryyear as $industry) {
				$gui .= '
									<li class="prd-col-sm-6">
										<span><i class="'.$industryColorclasses["color"].'">&bull;</i></span>
										<span>'.$industry["industry"].'</span>
									</li>
						';
			}
			$index++;
		}
		$gui .= '
								</ul>
							</div>

						</div>

					</div>
				</section>
				';
				
		return $gui;
	}
	
	public static function getCompanysubheaderGui() {
		$gui = 	'
				<section id="prd-section-laptop">
				</section>
				';
				
		return $gui;
	}
	
	public static function getCompanycountriesGui($companydata) {
		//global $languagelevels;
		$languagelevels = $companydata["languagelevels"];
		
		$uniqueprofiles = array();
		foreach ($companydata["teams"] as $team) {
			foreach ($team["team"] as $profile) {
				$uniqueprofiles[$profile["basic"]["id"]] = $profile;
			}
		}
		
		$countries = array();
		$languages = array();
		foreach ($uniqueprofiles as $uniqueprofile) {
			$residence = $uniqueprofile["basic"]["residence"];
			$timezone = $residence["timezoneid"];
			if (isset($residence["addresscomponents"]) && $residence["addresscomponents"]) {
				$address = CareerpagesLibrary::getFormattedaddress($residence["addresscomponents"]);
				if (isset($address["CO"]) && !isset($countries[$address["CO"]])) $countries[$address["CO"]]["count"] = 0;
				if (isset($address["CO"]) && !isset($countries[$address["CO"]]["profiles"][$uniqueprofile["basic"]["id"]])) {
					$countries[$address["CO"]]["profiles"][$uniqueprofile["basic"]["id"]] = '';
					$countries[$address["CO"]]["count"]++;
				}
			}
			
			foreach ($uniqueprofile["languages"] as $language) {
				if (!isset($languages[$language["id"]]) || (isset($languages[$language["name"]]) && $language["languagesspeaklevelsid"] < $languages[$language["id"]]["languagesspeaklevelsid"])) $languages[$language["id"]] = $language;
			}
		}
		
		$gui = 	'
				<section class="prd-padding-top-30 prd-padding-bottom-30">
					<div class="prd-container">
						<div class="prd-row">
							<div class="prd-col-md-6">

								<h2 class="prd-bordered-title prd-border-color-aquamarine">
									<b class="prd-color-aquamarine">'.sprintf(ngettext('WE HAVE %d TEAM', 'WE HAVE %d TEAMS', count($companydata["teams"])), count($companydata["teams"])).'</b>
									<br>
									<span class="prd-color-blue">'.sprintf(ngettext('in our company and %d employee', 'in our company and %d employees', count($uniqueprofiles)), count($uniqueprofiles)).' '.sprintf(ngettext('from %d country', 'from %d different countries', count($countries)), count($countries)).'</span>
								</h2>
				';
		if (count($languages)) {
			$gui .=	'
								<br>
								<h2 class="prd-bordered-title prd-border-color-green">
									<b class="prd-color-green">'.gettext('AND WE SPEAK').'</b>
									<br>
									<span class="prd-overflow prd-color-blue">'.sprintf(ngettext('%d language', '%d different languages', count($languages)), count($languages)).'</span>
								</h2>

								<div class="prd-languages prd-row">
									<div class="prd-col-md-12"></div>
								</div>
					';
		}
		$mapclasses = self::getMapclasses();
		$gui .=	'
							</div>

							<div class="prd-col-md-6">
								<div class="prd-country-wrapper">
									<ul class="prd-countries prd-list-unstyled">
				';
		foreach($countries as $countryname => $country) {
			$current = array_rand($mapclasses, 1);
			$gui .=	'
										<li class="'.$mapclasses[$current].'">
											<i class="fas fa-map-marker-alt"></i>
											<span>'.$countryname.'</span>
										</li>
					';
			unset($mapclasses[$current]);
			if (empty($mapclasses)) break;
		}
		$gui .=	'
									</ul>
								</div>
							</div>

						</div>
				';
		if (count($languages)) {
			$gui .=	'
						<div class="prd-languages prd-row">
							<div class="prd-col-md-12">
								<ul class="prd-list-unstyled prd-row">
					';
			foreach ($languages as $language) {
				$gui .=	'
									<li class="prd-col-md-6"><b>'.$language["name"].'</b><span>'.gettext($languagelevels[$language["languagespeaklevelsid"]]["speaknamelong"]).'</span></li>
						';
			}
			$gui .=	'
								</ul>             
							</div>
						</div>
					';
		}
		$gui .=	'
					</div>
				</section>
				';
				
		return $gui;
	}
	
	public static function getCompanyteamsGui($companydata) {
		global $templateImages;
		global $prodiiUrl;
		
		$medias = $companydata["medias"];
		
		$gui = 	'
				<section class="prd-padding-bottom-30">
					<div class="prd-container">
						<h2 class="prd-bordered-title prd-color-dark-blue">
							'.gettext('OUR TEAMS').'
							'./*<span>lorem ipsum dolor sit amet, consectetur adipiscing elit</span>*/''.'
						</h2>
				';
		foreach($companydata["teams"] as $team) {
			$contactperson = !empty($team["contactpersons"]) ? $team["contactpersons"][0] : null;

			$gui .= '
						<div class="prd-team-holder">
							<div class="prd-team-title prd-lead prd-aquamarine-bg prd-text-white prd-cursor-pointer prd-overflow" onclick="getTeamHtml('.$team["basic"]["id"].');">
								'.$team["basic"]["name"].'
							</div>
					';
			if ($contactperson) {
				$gui .= '
							<div class="prd-aqua-bg">
								<div class="prd-row">

									<div class="prd-col-sm-1">
									</div>

									<div class="prd-col-sm-2 prd-text-center">
										<br>
										<br>
										<img src="'.CareerpagesLibrary::getProfileimageurl($templateImages, $contactperson["basic"]["profileimage"]).'" class="prd-img-circle prd-cursor-pointer" alt="" onclick="getProfileHtml('.$contactperson["basic"]["id"].');">
										<br>
										<br>
									</div>

									<div class="prd-col-sm-8 prd-padding-left-34">
										<div class="prd-highlighted-person">
											<br>
											<ul class="prd-list-unstyled prd-list-inline prd-media-icons-sm prd-color-aquemarine-green">
						';
				if(isset($contactperson["socialmedias"]) && count($contactperson["socialmedias"])) {
					foreach($contactperson["socialmedias"] as $socialmedia) {
						$gui .= '
												<li>
													<a href="'.$socialmedia["url"].'" target="_blank">
														<img src="'.$prodiiUrl.'/assets/img/'.$medias[$socialmedia["mediaid"]]["webicon"].'" title="'.$medias[$socialmedia["mediaid"]]["alias"].'" onclick="event.stopPropagation();" class="fab">
													</a>
												</li>
								';
					}
				}
				$gui .= '
											</ul>

											<h3 class="prd-margin-bottom-0 prd-color-blue">'.($contactperson ? strtoupper($contactperson["basic"]["profilename"]) : '').'</h3>

											<span class="prd-color-aquamarine">
												'.($contactperson["basic"]["currentworktitle"]).'
											</span>

											<hr>

											<p class="prd-font-size-14">
												'.$team["basic"]["headline"].'
											</p>
											<br>
										</div>
									</div>

								</div>
								
								<div class="prd-cursor-pointer" onclick="getTeamHtml('.$team["basic"]["id"].');">
									<i class="fa fa-angle-double-up"></i>
								</div>

								<a href="#" class="prd-team-toggler"><i class="fa fa-chevron-down"></i></a>
							</div>
						';
			} else {
				$gui .= '
							<div class="prd-aqua-bg">
								<div class="prd-cursor-pointer" onclick="getTeamHtml('.$team["basic"]["id"].');">
									<i class="fa fa-angle-double-up"></i>
								</div>
								<div class="prd-row">

									<div class="prd-col-sm-1">
									</div>

									<div class="prd-col-sm-2 prd-text-center">
										<br>
										<br>
									</div>

									<div class="prd-col-sm-8 prd-padding-left-34">
									</div>

								</div>

								<a href="#" class="prd-team-toggler"><i class="fa fa-chevron-down"></i></a>
							</div>
						';
			}
			$gui .= '
							<div class="prd-team-members prd-row">
					';
			foreach($team["team"] as $member) {
				$summary = !empty($member["basic"]["summary"]) ? $member["basic"]["summary"] : '';
				
				$gui .= '
								<div class="prd-col-sm-4 prd-col-md-4">

									<div class="prd-team-member" onclick="getProfileHtml('.$member["basic"]["id"].');">
										<div class="prd-cursor-pointer">
											<i class="fa fa-angle-double-up"></i>
										</div>
										<img src="'.CareerpagesLibrary::getProfileimageurl($templateImages, $member["basic"]["profileimage"]).'" class="prd-img-circle" alt="">
										<h4 class="prd-color-blue">'.($member["basic"]["profilename"] ? $member["basic"]["profilename"] : '&nbsp;').'</h4>
										<strong class="prd-color-aquamarine">'.(isset($member["basic"]["currentworktitle"]) && $member["basic"]["currentworktitle"] ? $member["basic"]["currentworktitle"] : '&nbsp;').'</strong>
										<div class="prd-team-member-summary">
											<p class="prd-font-size-14 prd-ellipsis prd-team-ellipsis">
												'.$summary.'
											</p>
										</div>
										<ul class="prd-list-unstyled prd-list-inline prd-media-icons-sm prd-color-aquemarine-grey">
						';
				if(isset($member["socialmedias"])) {
					foreach($member["socialmedias"] as $socialmedia) {
						$gui .= '
											<li>
												<a href="'.$socialmedia["url"].'" target="_blank">
													<img src="'.$prodiiUrl.'/assets/img/'.$medias[$socialmedia["mediaid"]]["webicon"].'" title="'.$medias[$socialmedia["mediaid"]]["alias"].'" onclick="event.stopPropagation();" class="fab">
												</a>
											</li>
								';
					}
				} else {
					$gui .= '
											<li></li>
							';
				}
				$gui .= '
										</ul>
									</div>

								</div>
						';
			}
			$gui .= '
							</div>
						</div>
						';
		}
		$gui .= '
					</div>
					
				</section>
				<script type="text/javascript">
					jQuery(document).ready(function(){
						jQuery(".prd-team-ellipsis").prdEllipsis({peRows: 3, peLink: \' ... \'});
					});
				</script>
				';
				
		return $gui;
	}
	
	public static function getCompanyfooterGui() {
		$gui = 	'
				<footer class="prd-footer prd-green-bg prd-text-white">
					<div class="prd-container">
						design by 
						<strong>Prodii</strong>
					</div>
				</footer>
				';
				
		return $gui;
	}
	
	
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	///////                                ///////////////////////////////////////////////////////////////////////////////////////////
	///////  Team                          ///////////////////////////////////////////////////////////////////////////////////////////
	///////                                ///////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	
	public static function getTeamheaderGui($teamdata) {
		$gui = 	'
				<header id="prd-header-team" class="prd-padding-bottom-1">
					'.self::getBreadcrumbGui($teamdata["breadcrumbs"]).'
					<div class="prd-container">
					<h1 class="prd-color-blue">'.strtoupper($teamdata["basic"]["name"]).'</h1>
					'./*<a href="#"><i class="fa fa-play fa-3x"></i></a>*/''.'
					</div>
				</header>
				';
				
		return $gui;
	}
	
	public static function getTeamBasicGui($teamdata) {
		global $templateImages;
		
		if (isset($teamdata["company"]["address"]["addresscomponents"])) {
			$address = CareerpagesLibrary::getFormattedaddress($teamdata["company"]["address"]["addresscomponents"]);
		}

		$contactperson = !empty($teamdata["contactpersons"]) ? $teamdata["contactpersons"][0] : null;
		
		$gui = 	'
				<section class="prd-aquamarine-bg prd-padding-top-30 '.($contactperson ? 'prd-padding-bottom-180' : 'prd-padding-bottom-0').'">
					<div class="prd-container prd-text-left">
						<div class="prd-row">
							<div class="prd-col-md-10">
								<h2 class="prd-margin-top-0 prd-margin-bottom-0 prd-text-white prd-overflow">'.strtoupper($teamdata["basic"]["headline"]).'</h2>
								<p class="prd-lead prd-text-white">
									'.$teamdata["basic"]["description"].'
								</p>
								<p class="text-darker-blue prd-lead">
									<i class="fas fa-map-marker-alt"></i> '.(isset($address["CI, CO"]) ? $address["CI, CO"] : '').' 
								</p>
						<br>
					</div> <!-- /.prd-container -->
				</section>
				';
		if ($contactperson) {
			$gui .= '
				<div id="prd-highlighted-person-top" class="prd-highlighted-person prd-container">
					<section class="prd-aqua-bg">
						<div class="prd-row">
							<div class="prd-col-sm-3 prd-col-md-3">
								<img src="'.CareerpagesLibrary::getProfileimageurl($templateImages, $contactperson["basic"]["profileimage"]).'" alt="" class="prd-img-circle prd-cursor-pointer" onclick="getProfileHtml('.$contactperson["basic"]["id"].');">
							</div>
							<div class="prd-col-sm-9 prd-col-md-9">
								<h2 class="prd-color-dark-blue prd-overflow">'.strtoupper($contactperson["basic"]["profilename"]).'</h2>
								<span class="prd-color-aquamarine">
									'.$contactperson["basic"]["currentworktitle"].'
								</span>

								<hr>

								<ul class="prd-list-unstyled">
					';
			if($contactperson["basic"]["email"]) {
				$gui .= '
									<li class="prd-contact-row">
										<i class="fa fa-fw fa-envelope prd-color-aquamarine"></i>&nbsp;
										'.$contactperson["basic"]["email"].'
									</li>
						';
			}
			if ($contactperson["basic"]["mobile"]["number"]) {
				$gui .=	'
									<li class="prd-contact-row">
										<i class="fa fa-fw fa-phone prd-color-aquamarine"></i>&nbsp;
										('.$contactperson["basic"]["mobile"]["prefix"].') '.$contactperson["basic"]["mobile"]["number"].'
									</li>
						';
			} elseif ($contactperson["basic"]["phone"]["number"]) {
				$gui .=	'
									<li class="prd-contact-row">
										<i class="fa fa-fw fa-phone prd-color-aquamarine"></i>&nbsp;
										('.$contactperson["basic"]["phone"]["prefix"].') '.$contactperson["basic"]["phone"]["number"].'
									</li>
						';
			}
			if($contactperson["basic"]["skype"]) {
				$gui .= '
									<li class="prd-contact-row">
										<i class="fab fa-fw fa-skype prd-color-aquamarine"></i>&nbsp;
										live: '.$contactperson["basic"]["skype"].'
									</li>
						';
			}
			$gui .= '
								</ul>
							</div>
						</div>
					</section>
				</div>
					';
		}
				
		return $gui;
	}
	
	public static function getTeamcountriesGui($teamdata) {
		$languagelevels = $teamdata["languagelevels"];

		$profiles = array();
		$countries = array();
		$languages = array();

		foreach ($teamdata["team"] as $profile) {
			$profiles[$profile["basic"]["id"]] = '';
			$residence = $profile["basic"]["residence"];
			if (isset($residence["addresscomponents"]) && $residence["addresscomponents"]) {
				$address = CareerpagesLibrary::getFormattedaddress($residence["addresscomponents"]);
				if (isset($address["CO"]) && !isset($countries[$address["CO"]])) $countries[$address["CO"]]["count"] = 0;
				if (isset($address["CO"]) && !isset($countries[$address["CO"]]["profiles"][$profile["basic"]["id"]])) {
					$countries[$address["CO"]]["profiles"][$profile["basic"]["id"]] = '';
					$countries[$address["CO"]]["count"]++;
				}
			}
			
			foreach ($profile["languages"] as $language) {
				$languages[$language["name"]][$profile["basic"]["id"]] = $language["languagespeaklevelsid"];
			}
		}
		
		$gui = 	'
				<section class="prd-padding-top-30 prd-padding-bottom-30">
					<div class="prd-container">
						<div class="prd-row">
							<div class="prd-col-md-6">

								<h2 class="prd-bordered-title prd-border-color-aquamarine">
									<b class="prd-color-aquamarine">'.sprintf(ngettext('WE ARE %d PERSON', 'WE ARE %d PEOPLE', count($teamdata["team"])), count($teamdata["team"])).'</b>
									<br>
									<span>'.sprintf(ngettext('in our team from %d country', 'in our team from %d different countries', count($countries)), count($countries)).'</span>
								</h2>
				';
		if (count($languages)) {
			$gui .=	'
								<br>
								<h2 class="prd-bordered-title prd-border-color-green">
									<b class="prd-color-green">'.gettext('AND WE SPEAK').'</b>
									<br>
									<span>'.sprintf(ngettext('%d language', '%d different languages', count($languages)), count($languages)).'</span>
								</h2>

								<div class="prd-languages prd-row">

									<div class="prd-col-md-12">
									</div>

								</div>
					';
		}
		$mapclasses = self::getMapclasses();
		$gui .=	'
							</div>

							<div class="prd-col-md-6">
								<div class="prd-country-wrapper">
									<ul class="prd-countries prd-list-unstyled">
				';
		foreach($countries as $countryname => $country) {
			$current = array_rand($mapclasses, 1);
			$gui .=	'
										<li class="'.$mapclasses[$current].'">
											<i class="fas fa-map-marker-alt"></i>
											<span>'.$countryname.'</span>
										</li>
					';
			unset($mapclasses[$current]);
			if (empty($mapclasses)) break;
		}
		$gui .=	'
									</ul>
								</div>
							</div>

						</div>
				';
		if (count($languages)) {
			$gui .=	'
						<div class="prd-languages prd-row">
							<div class="prd-col-md-12">
								<ul class="prd-list-unstyled prd-row">
					';
			foreach ($languages as $languagename => $language) {
				$bestlevelid = $languagelevels[count($languagelevels)]["id"];
				foreach ($language as $profileid => $levelid) {
					if ($levelid < $bestlevelid) $bestlevelid = $levelid;
				}
				$gui .=	'
									<li class="prd-col-md-6"><b>'.$languagename.'</b><span>'.gettext($languagelevels[$bestlevelid]["speaknamelong"]).'</span></li>
						';
			}
			$gui .=	'
								</ul>             
							</div>
						</div>
					';
		}
		$gui .=	'
					</div>
				</section>
				';
				
		return $gui;
	}
	
	public static function getTeameducationGui($teamdata) {
		$educations = array();
		foreach ($teamdata["team"] as $profile) {
			foreach ($profile["educations"] as $education) {
				$educations[$profile["basic"]["id"]][] = $education;
			}
		}
		
		$gui = 	'
				<section class="prd-green-bg prd-padding-top-30 prd-padding-bottom-30">
					<div class="prd-container">
						<h2 class="prd-bordered-title prd-border-color-white">
							<b class="prd-text-white">'.gettext('OUR EDUCATIONS').'</b>
							<br>
							'./*<span>lorem ipsum dolor sit amet, consectetur</span>*/''.'
						</h2>

						<br>
						<table class="prd-table prd-green-bg prd-border-color-white">
							<thead>
								<tr class="prd-green-bg prd-border-color-white">
									<th class="prd-green-bg prd-border-color-white"><i class="fa fa-bookmark fa-2x prd-text-white"></i></th>
									<th class="prd-green-bg prd-border-color-white"><i class="fa fa-university fa-2x prd-text-white"></i></th>
									<th class="prd-green-bg prd-border-color-white"><i class="fa fa-calendar fa-2x prd-text-white"></i></th>
								</tr>
							</thead>
							<tbody>
				';
		foreach($educations as $profile) {
			foreach($profile as $index => $education) {
				if ($education["iscurrent"] || !$index) {
					$startdate = CareerpagesLibrary::getTime(isset($education["startdate"]) ? $education["startdate"] : null, "UTC");
					$enddate = CareerpagesLibrary::getTime(isset($education["enddate"]) ? $education["enddate"] : null, "UTC");
					$gui .= '
								<tr class="prd-green-bg prd-border-color-white">
									<td class="prd-green-bg prd-border-color-white"><strong>'.$education["degree"].'</strong></td>
									<td class="prd-green-bg prd-border-color-white">'.$education["name"].'</td>
									<td class="prd-green-bg prd-border-color-white">'.($startdate["year"] ? $startdate["year"] : '').' - '.($enddate["year"] ? $enddate["year"] : '').'</td>
								</tr>
							';
				}
			}
		}
		$gui .= '
							</tbody>
						</table>
						<br>
					</div>
				</section>
				';
				
		return $gui;
	}
	
	public static function getTeamsubheaderGui() {
		$gui = 	'
				<section id="prd-section-laptop-team">
				</section>
				';
				
		return $gui;
	}
	
	public static function getTeamskillsGui($teamdata) {
		//global $skilllevels;
		$skilllevels = $teamdata["skilllevels"];

		$skills = array();
		foreach ($teamdata["team"] as $profile) {
			foreach ($profile["skills"] as $skill) {
				$skills[$profile["basic"]["id"]][$skill["name"]] = $skill;
			}
		}
		
		$gui = 	'
				<section class="prd-skills prd-padding-top-30 prd-padding-bottom-30">
					<div class="prd-container">
						<h2 class="prd-bordered-title prd-border-color-blue">
							<b class="prd-color-blue">'.gettext('OUR 6 TOP SKILLS').'</b>
							'./*<br>
							<span>?liquam congue sem at libero malesuada, eu placerat enim rutrum</span>*/''.'
						</h2>

						<div class="prd-padding-left-34">
							<ul class="prd-list-unstyled prd-row">
				';
		$skillevaluations = array();
		foreach ($skills as $profile) {
			foreach ($profile as $skillname => $skill) {
				if (!isset($skillevaluations[$skillname])) {
					$levelsinitiation = array();
					foreach ($skilllevels as $skilllevel => $skilllevelname) {
						$levelsinitiation[$skilllevel] = 0;
					}
					$skillevaluations[$skillname] = $levelsinitiation;
				}
				
				$skillevaluations[$skill["name"]][$skill["skilllevelsid"]]++;
			}
		}
		$skillevaluations = array_slice ($skillevaluations, 0, 6, true);
		$noofskilllevels = count($skilllevels);
		foreach($skillevaluations as $skillname => $skilllevelelement) {
			foreach ($skilllevels as $skilllevel => $skilllevelname) {
				if ($skilllevelelement[$skilllevel]) {
					$currentlevel = $skilllevel;
					$currentlevelname = $skilllevelname;
					$currentpercent = $noofskilllevels ? ($noofskilllevels + 1 - $skilllevel) * 100 / $noofskilllevels : 100 / $noofskilllevels;
					break;
				}
			}

			$gui .= '
								<li class="prd-col-md-6">
									<span>'.gettext($currentlevelname["name"]).'<b>'.$currentpercent.'%</b></span>
									<strong>'.$skillname.'</strong>
									<div class="prd-progress">
										<div class="prd-progress-bar" style="width: '.$currentpercent.'%;"></div>
									</div>
								</li>
					';
		}
		$gui .= '
							</ul>
						</div>
					</div>
				</section>
				';
				
		return $gui;
	}
		
	public static function getTeamindustriGui($teamdata) {
		$positions = array();
		foreach ($teamdata["team"] as $profile) {
			foreach ($profile["positions"] as $position) {
				$positions[$profile["basic"]["id"]][] = $position;
			}
		}

		$industries = array();
		foreach ($positions as $positions) {
			foreach ($positions as $position) {
				$enddate = $position["enddate"] ? $position["enddate"] : time();
				if ($position["industry"]) {
					if (isset($industries[$position["industry"]])) {
						$industries[$position["industry"]]["time"] += $enddate - $position["startdate"];
					} else {
						$industries[$position["industry"]]["time"] = $enddate - $position["startdate"];
					}
				}
			}
		}
		arsort($industries);
		$industryyears = array();
		foreach ($industries as $industryname => &$industry) {
			$time = CareerpagesLibrary::getDiffTime(1, $industry["time"] + 1);
			$industry["industry"] = $industryname;
			$industryyears[$time["intyear"] + 1][] = $industry;
		}
		$industryyears = array_slice($industryyears, 0, 5, true);
		//$industryyears = array_rand($industryyears, count($industryyears));
		
		$gui = 	'
				<section class="prd-experience prd-blue-bg prd-text-white prd-padding-top-30 prd-padding-bottom-30">
					<div class="prd-container">
						<h2 class="prd-bordered-title prd-text-white">
							'.gettext('INDUSTRIAL EXPERIENCE').'
							'./*<span>?liquam congue sem at libero malesuada, eu placerat enim rutrum</span>*/''.'
						</h2>


						<ul class="prd-list-unstyled prd-list-inline prd-clearfix">
				';
		$index = 0;
		foreach ($industryyears as $years => $industryyear) {
			$industryColorclasses = self::getIndustryColorclasses($index);
			$gui .= '
							<li class="indusrtial-coin"><span class="prd-circle-year '.$industryColorclasses["bg"].' '.$industryColorclasses["color"].'"><b>'.$years.'</b>'.ngettext('Year', 'Years', $years).'</span></li>
					';
			$index++;
		}
		$gui .= '
						</ul>
						<div class="prd-row">

							<div class="prd-col-md-12">
								<ul class="prd-list-unstyled prd-row prd-experience-texts">
				';
		$index = 0;
		foreach ($industryyears as $years => $industryyear) {
			$industryColorclasses = self::getIndustryColorclasses($index);
			foreach ($industryyear as $industry) {
				$gui .= '
									<li class="prd-col-md-6">
										<span><i class="'.$industryColorclasses["color"].'">&bull;</i></span>
										<span>'.$industry["industry"].'</span>
									</li>
						';
			}
			$index++;
		}
		$gui .= '
								</ul>
							</div>
						</div>

					</div>
				</section>
				';
				
		return $gui;
	}
	
	public static function getTeammembersGui($teamdata) {
		global $templateImages;
		global $prodiiUrl;
		
		$medias = $teamdata["medias"];

		$team = $teamdata["team"];
		
		$gui =	'
				<section class="prd-padding-top-30 prd-padding-bottom-30">
					<div class="prd-container">
						<h2 class="prd-bordered-title prd-color-dark-blue">
							'.gettext('TEAM MEMBERS').'
							'./*<span>?liquam congue sem at libero malesuada, eu placerat enim rutrum</span>*/''.'
						</h2>
						<div class="prd-team-holder prd-team-members prd-showing prd-row">
				';
		foreach($team as $member) {
			$gui .= '
							<div class="prd-col-sm-4 prd-col-md-4">

								<div class="prd-team-member" onclick="event.stopPropagation(); getProfileHtml('.$member["basic"]["id"].');">
									<i class="fa fa-angle-double-up"></i>
									<img src="'.CareerpagesLibrary::getProfileimageurl($templateImages, $member["basic"]["profileimage"]).'" class="prd-img-circle" alt="">
									<h4 class="prd-color-dark-blue">'.($member["basic"]["profilename"] ? $member["basic"]["profilename"] : '&nbsp;').'</h4>
									<strong class="prd-color-aquamarine">'.(isset($member["professionalinfo"]["positions"][0]["worktitle"]) && $member["professionalinfo"]["positions"][0]["worktitle"] ? $member["professionalinfo"]["positions"][0]["worktitle"] : '&nbsp;').'</strong>
									<div class="prd-team-member-summary">
										<p class="prd-font-size-14 prd-ellipsis prd-team-ellipsis">
											'.$member["basic"]["summary"].'
										</p>
									</div>
									<ul class="prd-list-unstyled prd-list-inline prd-media-icons-sm prd-color-aquemarine-grey">
					';
			if(isset($member["socialmedias"]) && count($member["socialmedias"])) {
				foreach($member["socialmedias"] as $socialmedia) {
					$gui .= '
										<li>
											<a href="'.$socialmedia["url"].'" target="_blank">
												<img src="'.$prodiiUrl.'/assets/img/'.$medias[$socialmedia["mediaid"]]["webicon"].'" title="'.$medias[$socialmedia["mediaid"]]["alias"].'" onclick="event.stopPropagation();" class="fab">
											</a>
										</li>
							';
				}
			} else {
				$gui .= '
										<li></li>
						';
			}
			$gui .= '
									</ul>
								</div>
							</div>
					';
		}
		$gui .= '
						</div>
					</div>
					<script type="text/javascript">
						jQuery(document).ready(function(){
							jQuery(".prd-team-ellipsis").prdEllipsis({peRows: 3, peLink: \' ... \'});
						});
					</script>
				</section>
				';
				
		return $gui;
	}
	
	public static function getTeamfooterGui() {
		$gui = 	'
				<footer class="prd-footer prd-green-bg prd-text-white">
					<div class="prd-container">
						design by 
						<strong>Prodii</strong>
					</div>
				</footer>
				';
				
		return $gui;
	}

	
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	///////                                ///////////////////////////////////////////////////////////////////////////////////////////
	///////  Profile                       ///////////////////////////////////////////////////////////////////////////////////////////
	///////                                ///////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	
	public static function getProfileheaderGui($profiledata) {
		$gui = 	'
				<header id="prd-header-profile">
					'.self::getBreadcrumbGui($profiledata["breadcrumbs"]).'
				</header>
				';
				
		return $gui;
	}
	
	public static function getProfileBasicGui($profiledata) {
		global $templateImages;
		global $prodiiUrl;
		
		$medias = $profiledata["medias"];
	
		$worktitle = null;
		foreach ($profiledata["positions"] as $position) {
			if ($position) {
				if ($position["iscurrent"]) {
					$worktitle = $position["worktitle"];
					break;
				}
			}
		}
		
		$gui = 	'
				<section class="prd-aquamarine-bg prd-padding-top-30 prd-company-header-section">
					<div class="prd-container">
						<div class="prd-row">
							<div class="prd-col-xs-12 prd-col-sm-12 prd-col-md-12 prd-col-lg-12">
								<ul class="prd-list-unstyled prd-list-inline prd-media-icons-lg prd-color-white-green">
				';
		if (!empty($profiledata["socialmedias"])) {
			foreach ($profiledata["socialmedias"] as $socialmedia) {
				$gui .=	'		
									<li>
										<a href="'.$socialmedia["url"].'" target="_blank">
											<img src="'.$prodiiUrl.'/assets/img/'.$medias[$socialmedia["mediaid"]]["webicon"].'" class="fab " title="'.$medias[$socialmedia["mediaid"]]["alias"].'"></i>
										</a>
									</li>
						';
			}
		}

		$basic = $profiledata["basic"];
		$gui .=	'
								</ul>
							</div> <!-- /.prd-col-md-10 -->

						</div> <!-- /.prd-row -->

					</div> <!-- /.prd-container -->
				</section>
								
				<div id="prd-highlighted-person-top" class="prd-highlighted-person prd-container">
					<section class="prd-aqua-bg">
						<div class="prd-row">
							<div class="prd-col-sm-3 prd-col-md-3">
								<img src="'.CareerpagesLibrary::getProfileimageurl($templateImages, $basic["profileimage"]).'" alt="" class="prd-img-circle /*prd-img-circle410*/">
							</div>
							<div class="prd-col-sm-9 prd-col-md-9">
								<h2 class="prd-color-dark-blue prd-overflow">'.strtoupper($basic["profilename"]).'</h2>
								<span class="prd-color-aquamarine">
									'.$worktitle.'
								</span>

								<hr>
				';
		if ($basic["email"] || $basic["mobile"] || $basic["phone"] || $basic["skype"]) {
			$gui .=	'

								<ul class="prd-list-unstyled">
					';
			if ($basic["email"]) {
				$gui .=	'
									<li class="prd-contact-row">
										<i class="fa fa-fw fa-envelope prd-color-aquamarine"></i>
										'.$basic["email"].'
									</li>
						';
			}
			if ($basic["mobile"]["number"]) {
				$gui .=	'
									<li class="prd-contact-row">
										<i class="fa fa-fw fa-phone prd-color-aquamarine"></i>
										('.$basic["mobile"]["prefix"].') '.$basic["mobile"]["number"].'
									</li>
						';
			} elseif ($basic["phone"]["number"]) {
				$gui .=	'
									<li class="prd-contact-row">
										<i class="fa fa-fw fa-phone prd-color-aquamarine"></i>
										('.$basic["phone"]["prefix"].') '.$basic["phone"]["number"].'
									</li>
						';
			}
			if ($basic["skype"]) {
				$gui .=	'
									<li class="prd-contact-row">
										<i class="fab fa-fw fa-skype prd-color-aquamarine"></i>
										live: '.$basic["skype"].'
									</li>
						';
			}
			$gui .=	'
								</ul>
					';
		}
		$gui .=	'
							</div>
						</div>
					</section>
				</div>
				';
				
		return $gui;
	}
	
	public static function getProfileaboutGui($profiledata) {
		//global $languagelevels;
		$languagelevels = $profiledata["languagelevels"];
		//global $skilllevels;
		$skilllevels = $profiledata["skilllevels"];

		$summary = isset($profiledata["basic"]["summary"]) ? $profiledata["basic"]["summary"] : '';
		
		$residence = $profiledata["basic"]["residence"];
		if (isset($residence["addresscomponents"]) && $residence["addresscomponents"]) {
			$address = CareerpagesLibrary::getFormattedaddress($residence["addresscomponents"]);
		}
		$gui = 	'
				<section class="prd-padding-top-30 prd-padding-bottom-30">
					<div class="prd-container">
						<div class="prd-row">
							<div class="prd-col-md-6">

								<h2 class="prd-bordered-title prd-border-color-aquamarine">
									<b class="prd-color-aquamarine">'.gettext('ABOUT ME').'</b>
									<br>
									'./*<span>my current position in our company is Senior Developer in “Development” department</span>*/''.'
								</h2>
								<br>
								<p class="prd-padding-left-34 prd-ellipsis prd-profile-ellipsis">
									'.$summary.'
								</p>
								<p class="prd-padding-left-34 prd-hide">
									'.$summary.' &nbsp; <a class="view-less" href="#">'.gettext('View less').'</a>
								</p>
								<br>
								<br>
				';
		$languages = $profiledata["languages"];
		if (count($languages)) {
			$gui .= '
								<h2 class="prd-bordered-title prd-border-color-green">
									<b class="prd-color-green">'.gettext('I SPEAK').'</b>
									<br>
									<span class="prd-color-dark-blue">'.gettext('my comfort zones').'</span>
								</h2>
					';
		}
		$gui .= '
							</div>
				';
		//$languages = $curriculum["languages"];
		$gui .= '
							<div class="prd-col-md-6">
								<div class="prd-country-wrapper">
									<ul class="prd-countries prd-list-unstyled">
				';
		if (isset($residence["addresscomponents"]) && $residence["addresscomponents"]) {
			$address = CareerpagesLibrary::getFormattedaddress($residence["addresscomponents"]);
		}
		$mapclasses = self::getMapclasses();
		if (isset($address["CO"]) && $address["CO"]) {
			$current = array_rand($mapclasses, 1);
			$gui .= '
										<li class="'.$mapclasses[$current].'">
											<i class="fas fa-map-marker-alt"></i>
											<span>'.$address["CO"].'</span>
										</li>
					';
		}
		$gui .= '
									</ul>
								</div>
							</div>

						</div>
				';
		if (count($languages)) {
			$gui .=	'
						<div class="prd-languages prd-row">
							<div class="prd-col-md-12">
								<ul class="prd-list-unstyled prd-row">
					';
			if (count($languages)) {
				foreach ($languages as $language) {
					$gui .= '
									<li class="prd-col-md-6"><b>'.$language["name"].'</b><span>'.gettext($languagelevels[$language["languagespeaklevelsid"]]["speaknamelong"]).'</span></li>
							';
				}
			}
			$gui .= '
								</ul>                
							</div>
						</div>
					';
		}
		$gui .=	'
						<br>
						<br>
						<h2 class="prd-bordered-title prd-border-color-blue">
							<b class="prd-color-blue">'.gettext('EXPERTISE').'</b>
							<br>
							<span class="prd-color-dark-blue">'.gettext('my 6 top skills').'</span>
						</h2>

						<div class="prd-skills prd-padding-left-34">
							<ul class="prd-list-unstyled prd-row">
				';
		$skills = $profiledata["skills"];
		$skills = array_slice ($skills, 0, 6, true);
		$noofskilllevels = count($skilllevels);
		foreach($skills as $skillname => $skill) {
			$currentpercent = $noofskilllevels ? ($noofskilllevels + 1 - $skill["skilllevelsid"]) * 100 / $noofskilllevels : 100 / $noofskilllevels;
			$gui .= '
								<li class="prd-col-md-6">
									<span>'.gettext($skilllevels[$skill["skilllevelsid"]]["name"]).'<b>'.$currentpercent.'%</b></span>
									<strong>'.$skill["name"].'</strong>
									<div class="prd-progress">
										<div class="prd-progress-bar" style="width: '.$currentpercent.'%;"></div>
									</div>
								</li>
					';
		}
		$gui .= '
							</ul>
						</div>

					</div>
				</section>
				<script type="text/javascript">
					jQuery(document).ready(function(){
						jQuery(".prd-profile-ellipsis").prdEllipsis({peRows: 10, peLink: \' ... &nbsp; <a href="#" class="view-more">'.gettext('View more').'</a>\'});
					});
				</script>
				';
				
		return $gui;
	}
		
	public static function getProfileindustriGui($profiledata) {
		$industries = array();
		foreach ($profiledata["positions"] as $position) {
			$enddate = $position["enddate"] ? $position["enddate"] : time();
			if ($position["industry"]) {
				if (isset($industries[$position["industry"]])) {
					$industries[$position["industry"]]["time"] += $enddate - $position["startdate"];
				} else {
					$industries[$position["industry"]]["time"] = $enddate - $position["startdate"];
				}
			}
		}
		arsort($industries);
		$industryyears = array();
		foreach ($industries as $industryname => &$industry) {
			$time = CareerpagesLibrary::getDiffTime(1, $industry["time"] + 1);
			$industry["industry"] = $industryname;
			$industryyears[$time["intyear"] + 1][] = $industry;
		}
		$industryyears = array_slice($industryyears, 0, 5, true);
		
		$gui = 	'
				<section class="prd-experience prd-blue-bg prd-text-white prd-padding-top-30 prd-padding-bottom-30">
					<div class="prd-container">
						<h2 class="prd-bordered-title prd-text-white">
							'.gettext('INDUSTRIAL EXPERIENCE').'
							'./*<span>?liquam congue sem at libero malesuada, eu placerat enim rutrum</span>*/''.'
						</h2>


						<ul class="prd-list-unstyled prd-list-inline prd-clearfix">
				';
		$index = 0;
		foreach ($industryyears as $years => $industryyear) {
			$industryColorclasses = self::getIndustryColorclasses($index);
			$gui .= '
							<li class="indusrtial-coin"><span class="prd-circle-year '.$industryColorclasses["bg"].' '.$industryColorclasses["color"].'"><b>'.$years.'</b>'.ngettext('Year', 'Years', $years).'</span></li>
					';
			$index++;
		}
		$gui .= '
						</ul>
						<div class="prd-row">

							<div class="prd-col-md-12">
								<ul class="prd-list-unstyled prd-row prd-experience-texts">
				';
		$index = 0;
		foreach ($industryyears as $years => $industryyear) {
			$industryColorclasses = self::getIndustryColorclasses($index);
			foreach ($industryyear as $industry) {
				$gui .= '
									<li class="prd-col-sm-6">
										<span><i class="'.$industryColorclasses["color"].'">&bull;</i></span>
										<span>'.$industry["industry"].'</span>
									</li>
						';
			}
			$index++;
		}
		$gui .= '
								</ul>
							</div>
						</div>

					</div>
				</section>
				';
				
		return $gui;
	}
	
	public static function getProfilesubheaderGui() {
		$gui = 	'
				<section id="prd-section-laptop-profile">
				</section>
				';
				
		return $gui;
	}
	
	public static function getProfileeducationGui($profiledata) {
		$gui = 	'
				<section class="prd-green-bg prd-padding-top-30 prd-padding-bottom-30">
					<div class="prd-container">
						<h2 class="prd-bordered-title prd-border-color-white">
							<b class="prd-text-white">'.gettext('EDUCATION').'</b>
							<br>
							'./*<span>lorem ipsum dolor sit amet, consectetur</span>*/''.'
						</h2>

						<br>
						<table class="prd-border-color-white prd-table">
							<thead>
								<tr class="prd-border-color-white">
									<th class="prd-green-bg prd-border-color-white"><i class="fa fa-bookmark fa-2x prd-text-white"></i></th>
									<th class="prd-green-bg prd-border-color-white"><i class="fa fa-university fa-2x prd-text-white"></i></th>
									<th class="prd-green-bg prd-border-color-white"><i class="fa fa-calendar fa-2x prd-text-white"></i></th>
								</tr>
							</thead>
							<tbody>
				';
		foreach($profiledata["educations"] as $education) {
			$startdate = CareerpagesLibrary::getTime(isset($education["startdate"]) ? $education["startdate"] : null, "UTC");
			$enddate = CareerpagesLibrary::getTime(isset($education["enddate"]) ? $education["enddate"] : null, "UTC");
			$gui .= '
								<tr class="prd-border-color-white">
									<td class="prd-green-bg prd-border-color-white"><strong>'.$education["degree"].'</strong></td>
									<td class="prd-green-bg prd-border-color-white">'.$education["name"].'</td>
									<td class="prd-green-bg prd-border-color-white">'.($startdate["year"] ? $startdate["year"] : '').' - '.($enddate["year"] ? $enddate["year"] : '').'</td>
								</tr>
					';
		}
		$gui .= '
							</tbody>
						</table>
						<br>
					</div>
				</section>
				';
				
		return $gui;
	}
	
	public static function getProfilefooterGui() {
		$gui = 	'
				<footer class="prd-footer prd-dark-green-bg prd-text-white">
					<div class="prd-container">
						design by 
						<strong>Prodii</strong>
					</div>
				</footer>
				';
				
		return $gui;
	}
	
	
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	///////                                ///////////////////////////////////////////////////////////////////////////////////////////
	///////  Help functions                ///////////////////////////////////////////////////////////////////////////////////////////
	///////                                ///////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	
	// My template specific industry color classes
	public static function getIndustryColorclasses($index) {
		$industricolorsclasses = array(
			0 => array('bg' => 'prd-aquamarine-bg', 'color' => 'prd-color-aquamarine'),
			1 => array('bg' => 'prd-yellow-bg', 'color' => 'prd-color-yellow'),
			2 => array('bg' => 'prd-orange-bg', 'color' => 'prd-color-orange'),
			3 => array('bg' => 'prd-light-orange-bg', 'color' => 'prd-color-light-orange'),
			4 => array('bg' => 'prd-white-bg', 'color' => 'prd-color-white')
		);
		
		return isset($industricolorsclasses[$index]) ? $industricolorsclasses[$index] : $industricolorsclasses[4]; // 4 is default
	}

	public static function getMapclasses() {
		$mapclasses = array(
			0 => 'prd-country-top-left',
			1 => 'prd-country-top-right',
			2 => 'prd-country-right',
			3 => 'prd-country-bottom-left',
			4 => 'prd-country-left'
		);
		
		return $mapclasses;
	}

}
?>