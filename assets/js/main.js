/*
 * jQuery method to alpha numeric values with space
 * 
 * Allowed characters are : a-z, A-Z, 0-9 and spaces
 */
jQuery(function() {
	jQuery.validator.addMethod("alphanumericspace", function(value, element) {
		return this.optional(element) || value == value.match(/^[a-z0-9A-Z ]+$/);
	},"Only Characters, Numbers & Space Allowed.");
	jQuery.validator.addClassRules('alphanumericspace', {
	    'alphanumericspace': true
	});
});

/*
 * jQuery method to alpha numeric values with space and dot
 * 
 * Allowed characters are : a-z, A-Z, 0-9 and spaces
 */
jQuery(function() {
	jQuery.validator.addMethod("alphanumericspacedot", function(value, element) {
		return this.optional(element) || value == value.match(/^[a-z0-9A-Z .]+$/);
	},"Only Characters, Numbers & Space Allowed.");
	jQuery.validator.addClassRules('alphanumericspace', {
	    'alphanumericspace': true
	});
});

/*
 * jQuery method to alpha values with space
 * 
 * Allowed characters are : a-z, A-Z and spaces
 */
jQuery(function() {
	jQuery.validator.addMethod("alphaspace", function(value, element) {
		return this.optional(element) || value == value.match(/^[a-zA-Z ]+$/);
	},"Only Characters, Numbers & Space Allowed.");
	jQuery.validator.addClassRules('alphanumericspace', {
	    'alphanumericspace': true
	});
});

/*
 * jQuery method to alpha values with space and dot
 * 
 * Allowed characters are : a-z, A-Z and spaces
 */
jQuery(function() {
	jQuery.validator.addMethod("alphaspacedot", function(value, element) {
		return this.optional(element) || value == value.match(/^[a-zA-Z .]+$/);
	},"Only Characters, Numbers & Space Allowed.");
	jQuery.validator.addClassRules('alphanumericspace', {
	    'alphanumericspace': true
	});
});

/*
 * jQuery method to validate email structure
 * 
 * Allowed characters are : a-z, A-Z,.,_ and @
 */
jQuery(function() {
	jQuery.validator.addMethod("emailparse", function(value, element) {
		value = jQuery.trim(value);
                return this.optional(element) || value == value.match(/^[a-zA-Z0-9._@]+$/);
        },"Only Characters Allowed.");
        jQuery.validator.addClassRules('emailparse', {
            'emailparse': true
        });
});

/*
 * jQuery method to validate phone number with US format
 * 
 * Allowed characters are : 0-9 and -
 */
jQuery(function() {
    jQuery.validator.addMethod('customPhone', function (sphone, element) {
                sphone = sphone.replace(/\s+/g, "");
                return this.optional(element) || sphone.length > 9 && sphone.match(/^\d{3}-\d{3}-\d{4}$/);
            }, "Please Enter Valid Phone");
});