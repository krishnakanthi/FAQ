
    $(document).ready(function() {
        $("input[name^='saveListImportType']").change(function(){
            var listTypeOperation = $.trim($(this).val());
            if(listTypeOperation == 'newList'){
                $('#existingListUpdate').css('display', 'none');
                $('#newListCreate').css('display', '');
                //$('#newListCompanyCreate').css('display', '');
            }else if(listTypeOperation == 'updateList'){
                $('#existingListUpdate').css('display', '');
                $('#newListCreate').css('display', 'none');
                //$('#newListCompanyCreate').css('display', 'none');
            }
        });
        $("#addRows").button({icons: {primary: 'ui-icon-plus'}}).click(function(e){
            e.preventDefault();
            for(i=0; i<10; i++){
            var lastIndex = $('.listTable tr').size()-1;
            var appObj = $('.listTable tr:last').prev().clone();
            $('.listTable tr:eq(' + lastIndex + ')').before(appObj);
            $('.listTable tr:eq(' + lastIndex + ') td input').val('');
            }
        });
        
        $("#export").button({icons: {primary: 'ui-icon-document'}}).click(function(e){
            e.preventDefault();
            var listVal = $.trim($("input[name^='listId[]']").eq(0).val());
            if(!$.isNumeric(listVal)){
                $('#popUpMessageList').html('Please selecte a valid List to export');
                $( "#popUpMessageList" ).dialog( "open" );
                return false;
            }else if(listVal == 0){
                $('#popUpMessageList').html('Please selecte a valid List to export');
                $( "#popUpMessageList" ).dialog( "open" );
                return false;
            }
            var base = $('#baseUrl').html();
            $('#addListForm').attr('action', base + 'managelists/exportToCSV');
            $('#addListForm').submit();            
        });
        
        $( "#importList" ).click(function(e) {
            e.preventDefault();
		$( "#importListForm" ).dialog( "open" );
	});
        $( "#importListForm" ).dialog({
                autoOpen: false,
                modal: true,
                width: 735,
		height: 585
        });
        $('#buttonUploadCSVList').click(function(e){
            e.preventDefault();
            var selectField = $.trim($('#importListSelect option:selected').val());
            var insertField = $.trim($('#listImportName').val());
            var selectOptionList = $('#existingListUpdate').css('display');
            var insertOptionList = $('#newListCreate').css('display');
            var ext = $('#browseInput').val().split('.').pop().toLowerCase();
            var removeErrors = function(){
                if($('#errorUpload')){
                    $('#errorUpload').remove();
                }
                if($('#errorFileUpload')){
                    $('#errorFileUpload').remove();
                }
            };

             removeErrors();
            if(selectOptionList == 'table-row'){              
                if(selectField == 0 || selectField == ''){
                    $('#importListSelect').after('<div id="errorUpload" style="color: #af0000">Please select a list</div>');
                    return false;
                }else if($.trim($('#browseInput').val()) == '') {
                    $('#upload').after('<div id="errorFileUpload" style="color: #af0000">Please select a file to upload</div>');
                    return false;                
                }else if($.inArray(ext, ['csv']) == -1) {
                    $('#upload').after('<div id="errorFileUpload" style="color: #af0000">Please select a csv file to upload</div>');
                    return false;
                } else {
                    $('#importListForm').parent().css('z-index', '999');
                    $('#listImportName').val('');
                    $('#importListFormSubmit').submit();
                }
            } else if(insertOptionList == 'table-row'){
                if(insertField == ''){
                    $('#listImportName').after('<div id="errorUpload" style="color: #af0000">Please enter a list name</div>');
                    return false;
                }else if($.trim($('#browseInput').val()) == '') {
                    $('#upload').after('<div id="errorFileUpload" style="color: #af0000">Please select a file to upload</div>');
                    return false;                
                }else if($.inArray(ext, ['csv']) == -1) {
                    $('#upload').after('<div id="errorFileUpload" style="color: #af0000">Please select a csv file to upload</div>');
                    return false;
                } else {
                    $('#importListForm').parent().css('z-index', '999');
                    $('#importListSelect option:selected').val('0');
                    $('#importListFormSubmit').submit();
                }
            }
        });
        $('#saveList').button({icons: {primary: 'ui-icon-disk'}}).click(function(e){
            var value = $('#saveList .ui-button-text').text();
            e.preventDefault();
            var listName = $('#listName');
            if($.trim(listName.val()) == ''){
                $('.error').remove();
                listName.after('<div class="error">List Name should not be empty</div>');
                $('.error').css({'color' : '#FF0000', 'font-size' : '14px'});
            } else {
                $('.error').remove();
            }
            var i = 0;
            var count = 0;
            var inter = 0;
            $('.name').each(function(){
                var emailField = $(this).parents('tr').find('.email');
                var emailVal = emailField.val();                
                if($.trim(this.value) == '' && $.trim(emailVal) == ''){
                    $('.redText:eq(' + i + ')').remove();
                } else if($.trim(this.value) == '' && $.trim(emailVal) != ''){                    
                    $('.redText:eq(' + i + ')').remove();
                    $(this).parent().append('<div class="redText">Name should not be empty</div>');
                    if(!validEmail(emailVal)){
                        emailField.parent().append('<div class="redText">Enter proper Email</div>');
                    }
                    inter++;
                } else if($.trim(this.value) != '' && $.trim(emailVal) == ''){
                    $('.redText:eq(' + i + ')').remove();
                    emailField.parent().append('<div class="redText">Email should not be empty</div>');
                    inter++;
                } else if($.trim(this.value) != '' && $.trim(emailVal) != ''){
                    $('.redText:eq(' + i + ')').remove();
                    if(!validEmail(emailVal)){
                        emailField.parent().append('<div class="redText">Enter proper Email</div>');
                        inter++;
                    } else {
                        count++;
                    }
                }
                i++;
            });
            
            if(count == 0 && inter == 0){
                $('.redText:eq(0)').remove();
                $('.name:eq(0)').parent().append('<div class="redText">Name should not be empty</div>');
                $('.email:eq(0)').parent().append('<div class="redText">Email should not be empty</div>');
                return false;
            }
            if($.trim($('.error').text()) != '' || $.trim($('.redText').text()) != ''){
                return false;
            }
            if(value == 'Save List'){
                $('#addListForm').submit();
            } else {
                var burl = $('#baseUrl').html();
                $('#addListForm').attr('action',burl + 'managelists/updateList' );                
                $('#addListForm').submit();
            }
        });
        var validEmail = function(email){
            var emailPattern = /^[a-zA-Z0-9._]+@[a-zA-Z]+\.[a-zA-Z]{2,4}$/;
            return emailPattern.test(email); 
        }
    });  