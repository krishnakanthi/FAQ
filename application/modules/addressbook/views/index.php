<style type="text/css">    
    .cphone{
        width:250px;
    }
    #search_msg{
        clear:both;color:red;padding-left:20px;display:none;
    }
</style>
<div id="" style="overflow:auto;">
        <div class="tab-6-container">

	<div class="grid_11 alpha">
    
    	<div class="grid_4 alpha">	
        
			<!--<div class="importcontacts" style="margin-bottom: 50px;"> 
            <a href="#" id="importContact">            
			Import Contacts
            <img src="<?php echo base_url(); ?>assets/img/profile_icon.png" class="icon">
            </a>
            </div> -->
       
            <div class="ui-widget-header recentadded">
            Recently Added
            <img src="<?php echo base_url(); ?>assets/img/profile_icon.png" class="icon">
            </div>
            
            <div class="ui-widget-content recentadded" style=" height: 650px;">
            	<table class="tablesorter" id="recent-added">
					<thead>
                    	<tr>
                        	<th align="left"><input type="checkbox" class="checkallr" name="all"/></th>
                            <th style="width:60px">Name</th>
                            <th>Email</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <?php
                            foreach ($contacts_recent as $contact) {
                                
                        ?>
                    	<tr>
                        	<td><input type="checkbox" name="addressID[]" id="addressID[]" value="<?php echo $contact->id;?>"  /></td>
                            <td><?php echo $contact->name;?></td>
                            <td><?php echo $contact->email;?></td>
                            <td><button class="editAddress" id="editAddress" name="edit_button_arr[]" value="<?php echo $contact->id.'&&'.$contact->name.'&&'.$contact->email.'&&'.$contact->phonenumber.'&&'.$contact->company.'&&'.$contact->street.'&&'.$contact->city.'&&'.$contact->zip.'&&'.$contact->cellphone.'&&'.$contact->webaddress;?>" style="background: none repeat scroll 0 0 transparent;border: 0 solid #FFFFFF;height: 25px;width: 25px;">&nbsp;</button></td>
                        </tr>
                     <?php } ?>    
                        <!--<tr style="margin-bottom: 20px;">
                            <td colspan="5" align="right">
                                <?php echo $pagination_link_2; ?>
                            </td>
                        </tr>-->
                        <tbody class="tablesorter-no-sort">
                                <tr class="paginationFooter"><th colspan="5" align="right"><?php echo $pagination_link_2; ?></th></tr>
                        </tbody>
                </table>
            
            <!-- BEGIN FOOTER INFO -->
            
            <div class="ui-widget-header recentFooter">
            
            <button name="quick-send" class="quick-send"/> Send E-mail</button>
            <button name="quick-list" class="quick-list"/> Quick List </button>
            <button class="delAddBook ui-state-error" style="float: right; margin-right: 20px;">Delete</button>
            
            </div><!-- END FOOTER INFO -->
            
            </div><!-- END RECENTLY ADDED -->
            
        
        </div><!-- END GRID 4 -->
        
        <div class="grid_7 alpha">
        
        	<div class="ui-widget-header addresslist">
            Contacts
            <img src="<?php echo base_url(); ?>assets/img/VM_icon.png" class="icon">
            </div>
            
            <div class="ui-widget-content addresslist">
                <div class="top-book">
                    <div class="addContactButton">
                    <button id="addContact">Add Contact</button>
                    <button id="google_contacts">Import Google Contacts</button>
                    <button id="ImportContacts">Import Contacts</button>
                    </div>
                    
                    </div>
                <div class="searchAligner">
                    <div class="search-box" style=" margin-left: 20px;margin-bottom: 10px;">
                        <input type="text" name="search" size="50" id="search" placeholder="Search" tabindex="0" >
                        <span class="ui-icon ui-icon-search search-sym" onclick="search_addressbook($( '#search' ).val());"></span>
                        <input type="hidden" id="searchedfor" value="">
                    </div>
                    <!--<div class="addContact" style="border-radius: 10px 10px 10px 10px;">
                    
                </div>
                    <div class="search-box" style="border-radius: 10px 10px 10px 10px;">
                    <button id="yahoo_contacts" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" role="button"><span class="ui-button-icon-primary ui-icon ui-icon-plus"></span><span class="ui-button-text">Import Yahoo Contacts</span></button>
                        &nbsp;
                    </div> -->
                    <div id='search_msg'></div>
                    </div>
            
            <div class="letter-bar" id="letter-bar">
            <a href='#'  onclick=search_addressbook('a',true); >A</a>&nbsp;<a href='#' onclick=search_addressbook('b',true);  >B</a>&nbsp;<a href='#' onclick=search_addressbook('c',true);>C</a>&nbsp;<a href='#' onclick=search_addressbook('d',true);>D</a>&nbsp;<a href='#' onclick=search_addressbook('e',true);>E</a>&nbsp;<a href='#' onclick=search_addressbook('f',true);>F</a>&nbsp;<a href='#' onclick=search_addressbook('g',true);>G</a>&nbsp;<a href='#' onclick=search_addressbook('h',true);>H</a>&nbsp;<a href='#' onclick=search_addressbook('i',true);>I</a>&nbsp;<a href='#' onclick=search_addressbook('j',true);>J</a>&nbsp;<a href='#' onclick=search_addressbook('k',true);>K</a>&nbsp;<a href='#' onclick=search_addressbook('l',true);>L</a>&nbsp;<a href='#' onclick=search_addressbook('m',true);>M</a>&nbsp;<a href='#' onclick=search_addressbook('n',true);>N</a>&nbsp;<a href='#' onclick=search_addressbook('o',true);>O</a>&nbsp;<a href='#' onclick=search_addressbook('p',true);>P</a>&nbsp;<a href='#' onclick=search_addressbook('q',true);>Q</a>&nbsp;<a href='#' onclick=search_addressbook('r',true);>R</a>&nbsp;<a href='#' onclick=search_addressbook('s',true);>S</a>&nbsp;<a href='#' onclick=search_addressbook('t',true);>T</a>&nbsp;<a href='#' onclick=search_addressbook('u',true);>U</a>&nbsp;<a href='#' onclick=search_addressbook('v',true);>V</a>&nbsp;<a href='#' onclick=search_addressbook('w',true);>W</a>&nbsp;<a href='#' onclick=search_addressbook('x',true);>X</a>&nbsp;<a href='#' onclick=search_addressbook('y',true);>Y</a>&nbsp;<a href='#' onclick=search_addressbook('z',true);>Z</a>
            <button name="test" id="loadall" style="float: right; font-weight: normal; font-size: 10px; margin-left:4px; margin-top: 3px;" value="Load all" onclick="EditAddressBook('');">Load All</button>
            </div>
            
            <div class="address-list-table" id="address-list-div">
                
            	<table class="tablesorter" id="address-list-table">
					<thead>
                    	<tr>
                        	<!--<th>Select</th>-->
                            <th align="left"><input type="checkbox" class="checkallr" name="all"/></th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
					<tbody id="con-body">
                        <?php
                            foreach ($contacts as $contact) {
                                
                        ?>
                    	<tr>
                        	<td><input type="checkbox" name="addressID[]" id="addressID[]" value="<?php echo $contact->id;?>"  /></td>
                            <td><?php echo $contact->name;?></td>
                            <td><?php echo $contact->email;?></td>
                            <td><?php echo $contact->phonenumber;?></td>
                            <td><button class="editAddress" id="editAddress" name="edit_button_arr[]" value="<?php echo $contact->id.'&&'.$contact->name.'&&'.$contact->email.'&&'.$contact->phonenumber.'&&'.$contact->company.'&&'.$contact->street.'&&'.$contact->city.'&&'.$contact->zip.'&&'.$contact->cellphone.'&&'.$contact->webaddress;?>" style="background: none repeat scroll 0 0 transparent;border: 0 solid #FFFFFF;height: 25px;width: 25px;">&nbsp;</button></td>
                        </tr>
                        <?php }?>
                        <!--<tr style="margin-bottom: 20px;" class="avoid-sort">
                            <td colspan="5" align="right">
                                <?php echo $pagination_link_1; ?>
                            </td>
                        </tr> -->
                        <tbody class="tablesorter-no-sort">
                                <tr class="paginationFooter"><th colspan="5" align="right"><?php echo $pagination_link_1; ?></th></tr>
                    </tbody>            
                    </tbody>            
            	</table>
            </div>
            
            <div class="ui-widget-header listFooter">
            
            <!--<button name="allAddressbook" id="checkAll"/> Check All</button> -->
            <button name="export" id="export" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" /> Export Contacts</button>
            <button name="quick-send" class="quick-send" id="quick-send"/> Send E-mail</button>
            <button name="quick-list" class="quick-list" id="quick-list"/> Quick List </button>
            <button class ="delAddBook ui-state-error" name="delAddBook" style="float: right; margin-right: 12px;">Delete</button>
            
            </div><!-- END FOOTER LIST -->
            
            </div><!-- END ADDRESS LIST WIDGET -->
        
        </div><!-- END GRID 8 -->

	</div><!-- END GRID 11 -->

</div><!-- END 5 CONTAINER -->
<div class="quick-create-contact" title="Add Contact" style="display:none;">

<form class="quickForm">
	<table>
    	<tr>
        	<td><label for="contactName" />Name:</td>
        	<td><input name="contactName" /></td>
        </tr>
        <tr>
        	<td><label for="contactEmail" />E-mail:</td>
        	<td><input name="contactEmail" /></td>
        </tr>
    </table>
</form>
</div>
<div id="impGContactForm" title="Import Google Contacts" style="display:none;">
<form class="contactform" id="gmailLogin" method="post" action="<?php echo base_url(); ?>addressbook/importGContacts">

	
    <label>Gmail</label><input id="gmail_id" name="gmail_id" />
    <label>Password</label><input id="gmail_password" name="gmail_password" type="password" />
    
    <div style="padding-top:5px">
        <button id="contactSubmit" type="submit">Submit</button>
        <button id="gcontactCancel" name="gcontactCancel" type="reset">Cancel</button>
    </div>

</form>
</div>

<div id="addContactForm" title="Add Contact" style="display:none;">
<form class="contactform" method="post" action="<?php echo $action; ?>">

	<label>Name</label><input style="width: 250px;" id="contactName" name="contactName" />
    <label>Email</label><input style="width: 250px;" id="contactEmail" name="contactEmail" />
    <label>Phone Number</label><input id="contactPhone" name="contactPhone" maxlength="10" class="cphone" />
    <label>Company</label><input id="contactcompany" style="width: 250px;" name="contactcompany" />
    <label>Street</label><input id="contactstreet" style="width: 250px;" name="contactstreet" />
    <label>City</label><input id="contactcity" style="width: 250px;" name="contactcity" />
    <label>Zip</label><input id="contactzip" style="width: 250px;" name="contactzip" />
    <label>Cell Phone</label><input id="contactcellphone" name="contactcellphone" maxlength="10" class="cphone" />
    <label>Web Address</label><input id="contactwebaddress" style="width: 250px;" name="contactwebaddress" />    
    <div style="padding-top:5px">
        <button id="contactSubmit" type="submit">Submit</button>
        <button id="contactCancel" name="contactCancel" type="reset">Cancel</button>
    </div>

</form>
</div>
<div id="editContactForm" title="Edit Contact" style="display:none;">
<form class="editcontactform" method="post" action="<?php echo base_url(); ?>addressbook/updateContact">

	<label>Name</label><input id="editcontactName" style="width: 250px;" name="editcontactName" />
    <label>Email</label><input id="editcontactEmail" style="width: 250px;" name="editcontactEmail" />
    <label>Phone Number</label><input id="editcontactPhone1" name="editcontactPhone" maxlength="10" class="cphone" /> 
    <label>Company</label><input id="editcompany" style="width: 250px;" name="editcompany" />
    <label>Street</label><input id="editstreet" style="width: 250px;" name="editstreet" />
    <label>City</label><input id="editcity" style="width: 250px;" name="editcity" />
    <label>Zip</label><input id="editzip" style="width: 250px;" name="editzip" />
    <label>Cell Phone</label><input id="editcellphone1" name="editcellphone" maxlength="10" class="cphone"/>
    <label>Web Address</label><input id="editwebaddress" style="width: 250px;" name="editwebaddress" />
    <input type='hidden' id="editcontactId" name="editcontactId" />
    <div style="padding-top:5px">
        <button id="contactSubmit1" type="submit" name="contactSubmit1">Save</button>
    <button id="contactCancel1" name="contactCancel" type="button">Cancel</button>
    </div>

</form>
</div>
<div id="popUpMessageList" title="Message" style="display:none;">
      Test
</div>
</div>
<style>
.importListTable { width:300px; margin-top: 10px; }
.importListTable td { padding-bottom: 15px; }
</style>
<div id="importForm" title="Import List" style="display:none;">

	<div class="grid_3 alpha" >
    	<div class="ui-widget-header csvFile">
        Import List
        </div>
        <div class="ui-widget-content csvFile">        
        
<form id="importListFormSubmit" title="Import List" action="<?php echo base_url('addressbook/importContactCSV'); ?>" method="POST" enctype="multipart/form-data">
    <table class="importListTable">              
        <tr style="line-height: 40px;">            
            <td colspan="3">
                 <div id="csvUpload"></div>
                <input id="browseInput" type="file" name="importContactsCSV"  style="display:none;" onchange="document.getElementById('csvUpload').innerHTML=this.value.substring(this.value.lastIndexOf('\\')+1);$('#csvUpload').css('display','block');"/>
                <a id="upload" onclick="document.getElementById('browseInput').click();">Browse</a>
            </td>
        </tr>
        <tr style="line-height: 28px;">
            <td colspan="3" align="center">
                <input type="submit" name="Upload" value="Upload" id="buttonUploadCSVList"/>
                <!-- <button id="buttonUploadCSVList">Save</button> -->
            </td>
        </tr>
    </table>
</form>
</div>
<?php // Virtual Form For quick actions ?>
<form id="virtual-form" action="" method="post">
        <input type="hidden" name="virtual-form"/>
</form>
    </div><!-- end grid 3 -->
<div class="grid_6 alpha">
    	<div class="ui-widget-header csvExample">
        Example
        </div>
        <div class="ui-widget-content csvExample">
        <a href="http://sandbox.my.iboomerang.com/email15/iboomerang_example.csv" id="download">Download Example</a>
        <p>Please use Name and E-mail as the column titles: </p>
        <img src="<?=base_url();?>assets/img/csv-import.png" style="width: 200px; margin-top:10px; margin-bottom: 5px;" />
        </div>
    </div>
</div>

<script>
function getSelectedChbox(frm) {
 // JavaScript & jQuery Course - http://coursesweb.net/javascript/
  var selchbox = [];        // array that will store the value of selected checkboxes

  // gets all the input tags in frm, and their number
  var inpfields = document.getElementsByTagName('input');
  var nr_inpfields = inpfields.length;

  // traverse the inpfields elements, and adds the value of selected (checked) checkbox in selchbox
  for(var i=0; i<nr_inpfields; i++) {
    if(inpfields[i].type == 'checkbox' && inpfields[i].checked == true) selchbox.push(inpfields[i].value);
  }

  return selchbox;
}

$(function() {
//corners
    $('.importcontacts').corner();
    //$('.addContact').corner();
    //$('#search').corner();
    $('.ui-widget-header').corner("top");
    $('.ui-widget-header.recentadded').corner("top");
    $('.ui-widget-header.recentFooter').corner("bottom");
    $('.ui-widget-header.listFooter').corner("bottom");
    $("#loadall").button({ icons: { primary: 'ui-icon-person' }	});
    $("#checkAll").button({ icons: { primary: 'ui-icon-circle-check' }});
    $("#export").button({icons: {primary: 'ui-icon-document'}});
    $('#upload').button({ icons: { primary: 'ui-icon-folder-open' }	})
    $('#buttonUploadCSVList').button({ icons: { primary: 'ui-icon-disk' }	})
    $('#download').button();
    $('.quick-send').button({icons: { primary: 'ui-icon-mail-closed' }});
    $('.quick-list').button({icons: { primary: 'ui-icon-newwin'}});
    
//buttons
        $('#contactSubmit1').button({ icons: { primary: 'ui-icon-disk' }	})
	$('#import').button({ icons: { primary: 'ui-icon-person' }	})
	$('.edit').button({ icons: { primary: 'ui-icon-pencil' }	})
	$('.send-recent-added').button({ icons: { primary: 'ui-icon-mail-closed' }	})
	$('.quick-recent-added').button({ icons: { primary: 'ui-icon-newwin' }	})
	
	$('.goto-marketing').button({ icons: { primary: 'ui-icon-circle-triangle-e' }	})
	$('.editAddress').button({ icons: { primary: 'ui-icon-pencil' }	})
	$('#browseVcard').button({ icons: { primary: 'ui-icon-pencil' }	})
	$('#contactSubmit').button({ icons: { primary: 'ui-icon-plus' }	})
	
	
//tables
    if($("#recent-added").find("tbody").find("tr").size()>0){
        $("#recent-added").tablesorter({widgets: ['zebra'],  headers: { 0: { sorter: false }, 3: {sorter: false } }});
    }
    if($("#address-list-table").find("tbody").find("tr").size()>0){
        $("#address-list-table").tablesorter({widgets: ['zebra'],  headers: { 0: { sorter: false }, 4: {sorter: false } }});
    }
//import dialog
	$( "#importForm" ).dialog({
		autoOpen: false,
		modal: true,
                width: 760,
		height: 385
	});
	$( "#importContact" )
		.click(function() {
		$( "#importForm" ).dialog( "open" );
	});
        $('#ImportContacts').button({ icons: { primary: 'ui-icon-folder-open' }	}).click(function() {
		$( "#importForm" ).dialog( "open" );
	});
	$( ".quick-create-contact" ).dialog({
		autoOpen: false,
		modal: true
	});
	$( ".quick-recent-added" )
		.click(function() {
		$( "#addContactForm" ).dialog( "open" );
	});
	$( "#addContactForm" ).dialog({
		autoOpen: false,
		modal: true
	});
	$('#addContact').button({ icons: { primary: 'ui-icon-plus' }}).click(function() {
		$( "#addContactForm" ).dialog( "open" );
                $('#contactSubmit').button({ icons: { primary: 'ui-icon-plus' }	});
	});
	$( "#impGContactForm" ).dialog({
		autoOpen: false,
		modal: true
	});        
	        
        $('#google_contacts').button({ icons: { primary: 'ui-icon-plus' }}).click(function() {
		$( "#impGContactForm" ).dialog( "open" );
	});
       
        $( "#editContactForm" ).dialog({
		autoOpen: false,
		modal: true
	});
        $( "#popUpMessageList" ).dialog({            
            autoOpen: false,
            modal: true,
            width: 300,
            height: 150
        });
        $("#checkAll").click(function(){
            if($('.address-list-table input[name=\"addressID[]\"]').attr('checked')){
                $('.address-list-table input[name=\"addressID[]\"]').attr('checked', false);
            } else {
                $('.address-list-table input[name=\"addressID[]\"]').attr('checked', true);                
            }           
        });
        $(".checkallr").css('cursor', 'pointer').click(function(){
            var id = $(this).parents('table').attr('id');            
            if($('#'+id+' input[name=\"addressID[]\"]').attr('checked')){                
                $('#'+id+' input[name=\"addressID[]\"]').attr('checked', false);
            } else {
                $('#'+id+' input[name=\"addressID[]\"]').attr('checked', true);                
            }           
        });        
        $( ".editAddress" ).click(function() {
                str = $(this).val();
                var n=str.split("&&"); 
                //$('.redText').remove();
		$( "#editContactForm" ).dialog( "open" );
                $( "#editcontactName" ).val(n[1]);
                $( "#editcontactEmail" ).val(n[2]);
                $( "#editcontactPhone1" ).val(n[3]);
                $( "#editcompany" ).val(n[4]);
                $( "#editstreet" ).val(n[5]);
                $( "#editcity" ).val(n[6]);
                $( "#editzip" ).val(n[7]);
                $( "#editcellphone1" ).val(n[8]);
                $( "#editwebaddress" ).val(n[9]);
                $( "#editcontactId" ).val(n[0]);
	});
        
         $( "#export").click(function() {
                var bsURL = '<?php echo base_url(); ?>';
                var str = '';
                $.each($("input[name='addressID[]']:checked"), function() {
                  str += $(this).val()+'-';
                });    
                if(str==''){
                    str = 'all';
                }
                location.href = bsURL + 'addressbook/export/' + str;
	});       
        $('.delAddBook').button({ icons:{ primary: 'ui-icon-trash' }}).click(function() { 
                //alert('hi');
		var selchb = getSelectedChbox(this.form);     // gets the array returned by getSelectedChbox()
                //salert(selchb[1]);
                var base_url = '<?php echo base_url(); ?>';
                if (selchb!="")	{
			if(confirm("Are you sure you want to delete?")==true) {
                                //	alert(document.getElementById("browseInput").value);
                                //	//$('#LoadEditSenderInfo').show();
                                        $.ajax({

                                        cache: false,
                                        type: 'POST',
                                        url: base_url+'addressbook/deletecontacts',
                                        enctype: 'multipart/form-data',
                                        data:{
                                                                dellID: selchb

                                                        },
                                         success: function(data){
                                                location.reload();
                                                $('#popUpMessageList').html('Contact(s) deleted Successfully.');        
                                                $( "#popUpMessageList" ).dialog( "open" );
                                        }

                                 });
							 

                                    return false;
                            }
                }
        });
        $('.goto-marketing').click(function(){
            location.href = "<?php echo base_url('managelists');?>";
        });
              
        $("a.plink").live('click', function(e) { 
            e.preventDefault(); 
            var pagelns = $(this).attr('href').split('/');
            var byletter = ($('#searchedfor').val().length == 1)?true:false;
            search_addressbook($('#searchedfor').val(),byletter,pagelns[6] );
            return false;
        });

});
function showerrrmsg(msg){
    $("#search_msg").show().html(msg);
}
function search_addressbook(sval, by_letter, cur_page){
        sv = (by_letter)?'':encodeURIComponent('search');
        var searchID = sval?sval:$('#searchedfor').val();
        $('#searchedfor').val(searchID);
        if(!searchID){
            showerrrmsg("Please Enter some Text To Search");
            return false;
        }else if(searchID.length<3){
            showerrrmsg("Please Enter there or more characters");
            return false;
        }
        var cur_page = cur_page?cur_page:0;
        $.ajax({
                    cache: false,
                    type: 'POST',
                    url: '<?=base_url()?>addressbook/search_addressbook/',
                    data:{
                            rand: Math.random(),searchfor:encodeURIComponent(searchID),searchvalue:sv,curpage:cur_page
                        }, 
                    beforeSend: function () {
                            $('#address-list-div').html('Loading....');
                          },
                     success: function(data){
                            $("#search_msg").hide();
                            var data = JSON.parse(data);
                            if(data.data.length>0){
                                var ddata = '<table id="address-list-table" class="tablesorter">\n\
                            <thead><tr><th align="left"><input type="checkbox" class="checkallr" name="all"/></th><th>Name</th><th>Email</th><th>Phone</th><th>Edit</th></tr></thead>\n\
                            <tbody>';
                                $.each(data.data, function( index, value ) {
                                    ddata +='<tr><td><input type="checkbox" name="addressID[]" id="addressID[]" value="'+value.id+'" /></td>\n\
                                    <td>'+value.name+'</td><td>'+value.email+'</td><td>'+value.phone+'</td>\n\
                                    <td><button class="editAddress" id="editAddress" name="edit_button_arr[]" value="'+value.editdata+'" style="background: none repeat scroll 0 0 transparent;border: 0 solid #FFFFFF;height: 25px;width: 25px;"></button></td></tr>';
                                    });
                                     var nav_links = data.paging;
                                ddata +='<tr class="paginationFooter tablesorter-no-sort"><th align="right" colspan="5">'+nav_links+'</th></tr></tbody></table>';
                            }else{
                                ddata +='<tr><td colspan="5" align="center">No Records</td></tr>';
                            }
                            //$('#address-list-table > tbody').append(ddata);
                            $('#address-list-div').html(ddata);
                            if($("#address-list-table").find("tbody").find("tr").size()>0){
                                $("#address-list-table").tablesorter({widgets: ['zebra'],  headers: { 0: { sorter: false }, 4: {sorter: false } }});
                            }
                            $('.editAddress').button({ icons: { primary: 'ui-icon-pencil' }	})
                            $( ".editAddress" ).click(function() {
                                str = $(this).val();
                                var n=str.split("&&");
                                $( "#editContactForm" ).dialog( "open" );
                                $( "#editcontactName" ).val(n[1]);
                                $( "#editcontactEmail" ).val(n[2]);
                                $( "#editcontactPhone1" ).val(n[3]);
                                 $( "#editcompany" ).val(n[4]);
                                $( "#editstreet" ).val(n[5]);
                                $( "#editcity" ).val(n[6]);
                                $( "#editzip" ).val(n[7]);
                                $( "#editcellphone1" ).val(n[8]);
                                $( "#editwebaddress" ).val(n[9]);
                                $( "#editcontactId" ).val(n[0]);
                            });
                    }
                    
            });
            $(".ui-autocomplete").hide();
}
//Gives the proper data to autocomplete Search
function search_addressbook_data(data){
    var sugs = new Array(); 
            $.each(data, function( index, value ) {
                sugs[index] = {"label":value.name,"value":value.email};
            });
            return sugs;
}

$('.quick-send').click(function (e){
    e.preventDefault();
    $('#virtual-form').append();
    var str = '';
    $.each($("input[name='addressID[]']:checked"), function() {
        $('#virtual-form').append('<input type="text" name="addressID[]" value="'+$(this).val()+'">');
    });  
    $('#virtual-form').prop('action', '<?=  base_url()?>sendemail/index/contacts');
    $('#virtual-form').submit();
});
$('.quick-list').click(function (e){
    e.preventDefault();
    $('#virtual-form').append();
    var str = '';
    $.each($("input[name='addressID[]']:checked"), function() {
        $('#virtual-form').append('<input type="text" name="addressID[]" value="'+$(this).val()+'">');
    });  
    $('#virtual-form').prop('action', '<?=  base_url()?>managelists');
    $('#virtual-form').submit();
});
function EditAddressBook(se) {
	if($.trim(se) == ''){
		window.location.href='<?php echo base_url(); ?>'+'addressbook/index';
	}
	var number = (Math.random()+' ').substring(2,10);
        var base_url = '<?php echo base_url(); ?>';
        ajax.open("GET", base_url+"addressbook/sort_addressbook/"+number+'/'+se, true);
        ajax.send(null);
  
}
</script>
<?php
if($this->session->flashdata('importError')){
?>
<script type="text/javascript">
    $(document).ready(function(){
        $('#popUpMessageList').html('<?php echo $this->session->flashdata('importError'); ?>');        
        $( "#popUpMessageList" ).dialog( "open" );
    });
        
</script>
<?php
                }
?>
<script type="text/javascript" src="<?php echo base_url('assets/js/contacts.js'); ?>"></script>