/**
 * reCaptcha2 add-on
 * This add-ons shows and validates a Google reCAPTCHA v2
 *
 * @link        http://formvalidation.io/addons/reCaptcha2/
 * @license     http://formvalidation.io/license/
 * @author      https://twitter.com/formvalidation
 * @copyright   (c) 2013 - 2015 Nguyen Huu Phuoc
 */
/* global grecaptcha: false */
(function($) {
    FormValidation.AddOn.reCaptcha2 = {
        html5Attributes: {
            element: 'element',
            language: 'language',
            message: 'message',
            sitekey: '6LejEhkTAAAAAMjASQZs014Em6CgNKBn-28zAx3I',
            stoken: '6LejEhkTAAAAAA7QKuzqfW_ktaI988uP_4ikdusZ',
            theme: 'theme',
            timeout: 'timeout'
        },

        // The captcha field name, generated by Google reCAPTCHA
        CAPTCHA_FIELD: 'g-recaptcha-response',

        // The default session timeout (in seconds)
        CAPTCHA_TIMEOUT: 2 * 60,

        /**
         * @param {FormValidation.Base} validator The validator instance
         * @param {Object} options The add-on options. Consists of the following keys:
         * - element: The ID of element showing the captcha
         * - language: The language code defined by reCAPTCHA
         * See https://developers.google.com/recaptcha/docs/language
         * - theme: The theme name provided by Google. It can be light (default), dark
         * - siteKey: The site key provided by Google
         * - message: The invalid message that will be shown in case the captcha is not valid
         * You don't need to define it if the back-end URL above returns the message
         * - timeout: The number of seconds that session will expire
         * - sToken: The secure token
         */
        init: function(validator, options) {
            var that            = this,
                loadPrevCaptcha = (typeof window.reCaptchaLoaded === 'undefined')
                                ? function() {}
                                : window.reCaptchaLoaded;

            window.reCaptchaLoaded = function() {
                // Call the previous loaded function
                // to support multiple recaptchas on the same page
                loadPrevCaptcha();

	            // prepare options for captcha
	            var captchaOptions = {
	                sitekey: options.siteKey,
	                theme: options.theme || 'light',
	                callback: function(response) {
	                    validator.updateStatus(that.CAPTCHA_FIELD, validator.STATUS_VALID);

	                    // We might need to update the captcha status when session expires
	                    setTimeout(function() {
	                        validator.updateStatus(that.CAPTCHA_FIELD, validator.STATUS_INVALID);
	                    }, (options.timeout || that.CAPTCHA_TIMEOUT) * 1000);
	                }
	            };
                if (options.sToken) {
                    captchaOptions.stoken = options.sToken;
                }

	            // Render the captcha
                // Store the widget Id to reuse later
	            var widgetId = grecaptcha.render(options.element, captchaOptions);
                $('#' + options.element)
                    .data('fv.addon.recaptcha.id', widgetId)
                    .data('fv.validator', validator);

                setTimeout(function() {
                    that._addCaptcha(validator, options);
                }, 3000);
            };

            var src = '//www.google.com/recaptcha/api.js?onload=reCaptchaLoaded&render=explicit' + (options.language ? '&hl=' + options.language : '');
            if ($('body').find('script[src="' + src + '"]').length === 0) {
                var script = document.createElement('script');
                script.type  = 'text/javascript';
                script.async = true;
                script.defer = true;
                script.src   = src;
                document.getElementsByTagName('body')[0].appendChild(script);
            }
        },

        /**
         * Reset the captcha
         * It doesn't remove the feedback icon and validation message. To do that, you need to call the $(form).formValidation('resetField') method:
         *      $(form).formValidation('resetField', 'g-recaptcha-response');
         * @param {String} element The ID of element showing the captcha
         */
        reset: function(element) {
            var widgetId = $('#' + element).data('fv.addon.recaptcha.id');
            if (widgetId !== null) {
                grecaptcha.reset(widgetId);
            }
        },

        _addCaptcha: function(validator, options) {
            var that = this;

            validator
                .getForm()
                // Add new field after loading captcha
                .formValidation('addField', that.CAPTCHA_FIELD, {
                    excluded: false,
                    validators: {
                        callback: {
                            message: options.message,
                            callback: function(value, validator, $field) {
                                return (value !== '');
                            }
                        }
                    }
                });
        }
    };
}(jQuery));
