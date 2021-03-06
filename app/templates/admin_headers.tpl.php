<!DOCTYPE html>
<html lang="en">
<head>
	<!-- This is the header template for logged in users -->
	<meta charset="utf-8">
	<title>HECTOR</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="images/favicon.ico" />

	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/ajaxFunctions.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script type="text/javascript" src="js/Chart.js"></script>
	<script type="text/javascript" src="js/jquery.dataTables.js"></script>
	<script type="text/javascript" src="js/hector.analytics.js"></script>
	<?php if (isset($javascripts)) echo $javascripts;?>
	<?php if (!empty($testscripts)): ?>
		<?php foreach($testscripts as $script): ?>
			<?php echo $script;?>
		<?php endforeach?>
	<?php endif;?>

	<link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/bootstrap-responsive.css" rel="stylesheet">
	<link href="css/penn.css" rel="stylesheet">
	<link href="css/chart-legend.css" rel="stylesheet">
	<link href="css/jquery.dataTables.css" rel="stylesheet">
	<?php if (isset($css)) echo $css;?>
	<?php if (!empty($testcss)): ?>
		<?php foreach($testcss as $link):?>
			<?php echo $link;?>
		<?php endforeach;?>
	<?php endif;?>
</head>
<body>
<!--

	HECTOR

	an open source security intelligence platform

-->

<div class="container">
<div class="row">
    <div class="span11"><h1>HECTOR</h1></div>
    <div class="span1"><i class="icon-info-sign"></i><a href="?action=about" title="About HECTOR">About</a></div>
</div>
<div class="navbar"><div class="navbar-inner">
  <ul class="nav">
    <li><a href="?action=summary" title="Summary screen with overview statistics">Home</a></li>
    <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Browse, search, and review assets"><i class="icon-hdd"></i> Assets <b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li><a href="?action=browse_ip">Browse</a></li>
        <li><a href="?action=host_groups">Host groups</a></li>
        <li><a href="?action=ossec">OSSEC clients</a></li>
        <li class="divider"></li>
        <li class="nav-header">Search</li>
        <li><a href="?action=assets&object=search">Search</a></li>
        <li><a href="?action=assets&object=ports">Advanced search</a></li>
        <li class="divider"></li>
        <li class="nav-header">State changes</li>
        <li><a href="?action=assets&object=alerts">View alerts</a></li>
        <li class="divider"></li>
        <li class="nav-header">Add</li>
				<li><a href="?action=add_hosts">Add hosts</a></li>
      </ul>
    </li>
    <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Create, review, and manage security incidents."><i class="icon-warning-sign"></i> Incidents <b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li><a href="?action=incident_reports">Incident reports</a></li>
        <li><a href="?action=new_ir">New incident report</a></li>
        <li class="nav-header">Configuration</li>
        <li><a href="?action=details&object=IRAsset">Assets</a></li>
        <li><a href="?action=details&object=IRDiscovery">Discovery methods</a></li>
        <li><a href="?action=details&object=IRAgent">Incident agents</a></li>
        <li><a href="?action=details&object=IRMagnitude">Magnitudes</a></li>
        <li><a href="?action=details&object=IRAction">Threat actions</a></li>
        <li><a href="?action=details&object=IRTimeframe">Timeframes</a></li>
      </ul>
    </li>
    <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Comprehensive reports from HECTOR"><i class="icon-list-alt"></i> Reports <b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li><a href="?action=reports&report=danger_host">Dangerous hosts</a></li>
        <li><a href="?action=reports&report=oses">Operating systems</a></li>
        <li><a href="?action=reports&report=by_port">Ports detected</a></li>
        <li><a href="?action=vuln">Vulnerabilities <?php if (isset($vuln_badge)) echo $vuln_badge ;?></a></li>
        <li><a href="?action=vulnscans">Vulnerability Scans</a></li>
      </ul>
    </li>
    <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="View intrustion detection summaries."><i class="icon-eye-open"></i> Detection <b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li><a href="?action=detection">Detection summary</a></li>
        <li><a href="?action=honeypot">Honeypot data</a></li>
        <li><a href="?action=attackerip">Malicious IP database</a></li>
        <li><a href="?action=ossecalerts">OSSEC alerts</a></li>
        <li><a href="?action=screenshots">Website Screenshots</a>
        <li class="nav-header">Vulnerabilities</li>
        <li><a href="?action=add_edit&object=Vuln">Add vulnerability </a></li>
        <li><a href="?action=nessus_scans">Nessus scans</a></li>
        <li><a href="?action=add_edit&object=Vuln_detail">Report vulnerability</a></li>
        <li><a href="?action=upload_qualys_xml">Upload Qualys report</a></li>
        <li><a href="?action=upload_openvas_xml">Upload OpenVAS report</a></li>
      </ul>
    </li>
    <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="View open source intelligence collections."><i class="icon-globe"></i> OSINT <b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li><a href="?action=articles">Articles</a></li>
        <li><a href="?action=add_edit&object=Article">Add Article</a></li>
      </ul>
    </li>
    <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Configure HECTOR components and scans."><i class="icon-wrench"></i> Config <b class="caret"></b></a>
      <ul class="dropdown-menu">
        <!-- <li><a href="?action=config">Overview</a></li> -->
        <li class="nav-header">Scans</li>
        <li><a href="?action=config&object=scan">Scan schedule</a></li>
        <li><a href="?action=config&object=scan_type">Script configuration</a></li>
        <li class="divider"></li>
        <li class="nav-header">Designations</li>
        <li><a href="?action=config&object=tags">Free tags</a></li>
        <li><a href="?action=config&object=host_group">Host groups</a></li>
        <li><a href="?action=config&object=location">Locations</a></li>
        <li><a href="?action=config&object=risk">Risk levels</a></li>
        <li><a href="?action=config&object=supportgroup">Support groups</a></li>
        <li><a href="?action=config&object=vuln">Vulnerabilities</a></li>
        <li class="divider"></li>
        <li class="nav-header">Data sources</li>
        <li><a href="?action=config&object=feeds">RSS feeds</a></li>
        <li class="divider"></li>
        <li class="nav-header">Authorizations</li>
        <li><a href="?action=config&object=api_key">API key</a></li>
        <li><a href="?action=config&object=users">User accounts</a></li>
      </ul>
    </li>
    <li><a href="?action=logout" title="Log out of HECTOR">Log Out</a></li>
  </ul>

    <form class="navbar-search pull-right" method="post" name="<?php echo $ip_search_name;?>" id="<?php echo $ip_search_name;?>" action="?action=assets&object=search">
    	<input type="text" class="search-query" placeholder="Search for IP" name="ip">
    	<input type="hidden" name="token" value="<?php echo $ip_search_token;?>"/>
			<input type="hidden" name="form_name" value="<?php echo $ip_search_name;?>"/>
    </form>

</div></div>  <!-- End navbar -->

<div id="content">
