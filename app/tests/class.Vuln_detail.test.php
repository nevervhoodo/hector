<?php
require_once(dirname(__FILE__) . '/../software/simpletest/autorun.php');
require_once(dirname(__FILE__) . '/../lib/class.Vuln_detail.php');
require_once(dirname(__FILE__) . '/../lib/class.User.php');
require_once(dirname(__FILE__) . '/../lib/class.Host.php');
require_once(dirname(__FILE__) . '/../lib/class.Vuln.php');


class TestOfVuln_detailClass extends UnitTestCase {
	
	function setup() {
		$this->vuln_detail = new Vuln_detail();
	}
	
	function tearDown() {
		$this->vuln_detail->delete();
	}
	
	function testVuln_detailClass() {
		$this->assertIsA($this->vuln_detail, 'Vuln_detail');
	}
	
	function testVuln_detailId() {
		$this->assertEqual($this->vuln_detail->get_id(), 0);
	}
	
	function testVuln_detailText() {
		$text = 'Test';
		$this->vuln_detail->set_text($text);
		$this->assertEqual($this->vuln_detail->get_text(), $text);
	}
	
	function testVuln_detailDateTime() {
		$tsamp = '2012-04-01 00:03:50';
		$this->assertTrue($this->vuln_detail->set_datetime($tsamp));
		$this->assertEqual($this->vuln_detail->get_datetime(), $tsamp);
		$this->assertFalse($this->vuln_detail->set_datetime('I am not a datetime!'));
	}
	
	function testVuln_detailIgnoreDateTime() {
		$tsamp = '2012-04-01 00:03:50';
		$this->assertTrue($this->vuln_detail->set_ignore_datetime($tsamp));
		$this->assertEqual($this->vuln_detail->get_ignore_datetime(), $tsamp);
		$this->assertFalse($this->vuln_detail->set_ignore_datetime('I am not a datetime!'));
	}
	
	function testVuln_detailFixDateTime() {
		$tsamp = '2012-04-01 00:03:50';
		$this->assertTrue($this->vuln_detail->set_fixed_datetime($tsamp));
		$this->assertEqual($this->vuln_detail->get_fixed_datetime(), $tsamp);
		$this->assertFalse($this->vuln_detail->set_fixed_datetime('I am not a datetime!'));
	}
	
	function testVuln_detailIgnore() {
		$this->vuln_detail->set_ignore(TRUE);
		$this->assertTrue($this->vuln_detail->get_ignore());
		$this->vuln_detail->set_ignore(FALSE);
		$this->assertFalse($this->vuln_detail->get_ignore());
		$this->vuln_detail->set_ignore(0);
		$this->assertFalse($this->vuln_detail->get_ignore());
		$this->vuln_detail->set_ignore(1);
		$this->assertTrue($this->vuln_detail->get_ignore());
	}
	
	function testVuln_detailFixed() {
		$this->vuln_detail->set_fixed(TRUE);
		$this->assertTrue($this->vuln_detail->get_fixed());
		$this->vuln_detail->set_fixed(FALSE);
		$this->assertFalse($this->vuln_detail->get_fixed());
		$this->vuln_detail->set_fixed(0);
		$this->assertFalse($this->vuln_detail->get_fixed());
		$this->vuln_detail->set_fixed(1);
		$this->assertTrue($this->vuln_detail->get_fixed());
	}
	
	function testVuln_detailIgnoredByUser() {
		$this->vuln_detail->set_ignore_user_id(-1);
		$this->assertEqual($this->vuln_detail->get_ignored_user_id(), -1);
	}
	
	function testVuln_detailFixedByUser() {
		$this->vuln_detail->set_fixed_user_id(-1);
		$this->assertEqual($this->vuln_detail->get_fixed_user_id(), -1);
	}
	
	function testGetAddAlterForm() {
		$this->assertIsA($this->vuln_detail->get_add_alter_form(), 'Array');
	}
	
	function testGetCollectionDefinition() {
		$this->assertIsA($this->vuln_detail->get_collection_definition(), 'String');
	}
	
	function testFixedNotes() {
		$notesill = "<p>These are some illegal notes";
		$notes = "These are regular notes";
		$this->vuln_detail->set_fixed_notes($notes);
		$this->assertEqual($notes, $this->vuln_detail->get_fixed_notes());
		$this->vuln_detail->set_fixed_notes($notesill);
		$this->assertNotEqual($notesill, $this->vuln_detail->get_fixed_notes());
	}
    
    function testUserFixIgnore() {
    	$name = 'User Foo';
        $user = new User();
        $user->set_name($name);
        $user->set_password('test');
        $user->save();
        $this->assertTrue($this->vuln_detail->set_fixed_user_id($user->get_id()));
        $this->assertEqual($name, $this->vuln_detail->get_fixed_user_name());
        $this->assertTrue($this->vuln_detail->set_ignore_user_id($user->get_id()));
        $this->assertEqual($name, $this->vuln_detail->get_ignored_user_name());
        $user->delete();
    }
    
    function testVulnName() {
    	$vuln = new Vuln();
        $vuln->set_name('foo');
        $vuln->save();
        $id = $vuln->get_id();
        $this->assertTrue($this->vuln_detail->set_vuln_id($id));
        $this->assertEqual('foo', $this->vuln_detail->get_vuln_name());
        $vuln->delete();
    }
    
    function testHost() {
    	$hostname = 'new host';
        $host = new Host();
        $this->assertTrue($host->set_ip('192.0.2.1'));
        $this->assertTrue($host->set_name($hostname));
        $this->assertTrue($host->save());
        $id = $host->get_id(); print_r($id . "\n");
        $this->assertTrue($this->vuln_detail->set_host_id($id));
        $this->assertEqual($hostname, $this->vuln_detail->get_host_name());
        $host->delete();
    }
    
	function testTicket() {
		$link = "http://www.example.com";
		$this->vuln_detail->set_ticket($link);
		$this->assertEqual($this->vuln_detail->get_ticket(), $link);
		$this->assertFalse($this->vuln_detail->get_ticket() == 'http://ThisIsNotTheLink.com');
		$this->assertFalse($this->vuln_detail->set_ticket('ThisIsNotAValidLink'));
	}
	
	function testHostId() {
		$this->assertTrue($this->vuln_detail->get_host_id() == 0);
		$this->vuln_detail->set_host_id(51222);
		$this->assertEqual($this->vuln_detail->get_host_id(), 51222);
	}
	
	function testVulnId() {
		$this->assertTrue($this->vuln_detail->get_vuln_id() == 0);
		$this->vuln_detail->set_vuln_id(19953);
		$this->assertEqual($this->vuln_detail->get_vuln_id(), 19953);
	}
	
	function testGetDisplays() {
		$this->assertIsA($this->vuln_detail->get_displays(), 'Array');
	}
	
	function testSaveDelete() {
		$this->assertTrue($this->vuln_detail->get_id() == 0);
		$this->vuln_detail->save();
		$id = $this->vuln_detail->get_id();
		$this->assertTrue($id > 0);
	}
}
?>